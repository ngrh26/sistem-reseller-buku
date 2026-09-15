<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\ReportExport;
use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $baseQuery = Order::query()
            ->when($request->filled('start_date'), function ($query) use ($request) {
                $query->whereDate('order_date', '>=', $request->start_date);
            })
            ->when($request->filled('end_date'), function ($query) use ($request) {
                $query->whereDate('order_date', '<=', $request->end_date);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            });

        /*
         * Daftar pesanan mengikuti filter yang dipilih Admin,
         * termasuk filter payment_status.
         */
        $orders = (clone $baseQuery)
            ->with([
                'reseller',
                'items.product',
                'payment',
            ])
            ->when($request->filled('payment_status'), function ($query) use ($request) {
                $query->where('payment_status', $request->payment_status);
            })
            ->latest('order_date')
            ->paginate(20)
            ->withQueryString();

        /*
         * Total pesanan mengikuti filter tabel,
         * termasuk filter payment_status.
         */
        $totalPesanan = $orders->total();

        /*
         * Pendapatan hanya berasal dari pesanan
         * yang pembayarannya sudah terverifikasi/paid.
         */
        $totalPendapatan = (clone $baseQuery)
            ->where('payment_status', 'paid')
            ->sum('final_price');

        /*
         * Total diskon hanya dihitung dari pesanan paid.
         */
        $totalDiskon = (clone $baseQuery)
            ->where('payment_status', 'paid')
            ->sum('discount_amount');

        return view('admin.reports.index', compact(
            'orders',
            'totalPesanan',
            'totalPendapatan',
            'totalDiskon'
        ));
    }

    /**
     * Export laporan pesanan ke Excel.
     */
    public function exportExcel(Request $request)
    {
        return Excel::download(
            new ReportExport($request),
            'laporan-pesanan-' . now()->format('Y-m-d-His') . '.xlsx'
        );
    }

    /**
     * Export laporan pesanan ke PDF.
     */
    public function exportPdf(Request $request)
    {
        /*
         * Query dasar laporan.
         */
        $baseQuery = Order::query()
            ->when($request->filled('start_date'), function ($query) use ($request) {
                $query->whereDate('order_date', '>=', $request->start_date);
            })
            ->when($request->filled('end_date'), function ($query) use ($request) {
                $query->whereDate('order_date', '<=', $request->end_date);
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            });

        /*
         * Ambil seluruh data laporan.
         *
         * Berbeda dengan halaman index yang menggunakan pagination,
         * PDF harus mengambil seluruh data sesuai filter.
         */
        $orders = (clone $baseQuery)
            ->with([
                'reseller',
                'items.product',
                'payment',
            ])
            ->when($request->filled('payment_status'), function ($query) use ($request) {
                $query->where('payment_status', $request->payment_status);
            })
            ->latest('order_date')
            ->get();

        /*
         * Total pesanan mengikuti filter laporan.
         */
        $totalPesanan = $orders->count();

        /*
         * Pendapatan hanya dari pesanan paid.
         */
        $totalPendapatan = (clone $baseQuery)
            ->where('payment_status', 'paid')
            ->sum('final_price');

        /*
         * Total diskon hanya dari pesanan paid.
         */
        $totalDiskon = (clone $baseQuery)
            ->where('payment_status', 'paid')
            ->sum('discount_amount');

        /*
         * Label tanggal.
         */
        $startDate = $request->filled('start_date')
            ? date('d/m/Y', strtotime($request->start_date))
            : null;

        $endDate = $request->filled('end_date')
            ? date('d/m/Y', strtotime($request->end_date))
            : null;

        /*
         * Label status pesanan.
         */
        $statusLabel = match ($request->status) {
            'pending' => 'Menunggu',
            'processed' => 'Diproses',
            'shipped' => 'Dikirim',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => 'Semua Status',
        };

        /*
         * Label status pembayaran.
         */
        $paymentStatusLabel = match ($request->payment_status) {
            'pending' => 'Belum Dibayar',
            'paid' => 'Sudah Dibayar',
            'failed' => 'Gagal',
            default => 'Semua Status',
        };

        /*
         * Generate PDF.
         */
        $pdf = Pdf::loadView('admin.reports.pdf', compact(
            'orders',
            'totalPesanan',
            'totalPendapatan',
            'totalDiskon',
            'startDate',
            'endDate',
            'statusLabel',
            'paymentStatusLabel'
        ));

        /*
         * Ukuran kertas dan orientasi.
         */
        $pdf->setPaper('a4', 'landscape');

        /*
         * Download PDF.
         */
        return $pdf->download(
            'laporan-pesanan-' . now()->format('Y-m-d-His') . '.pdf'
        );
    }
}