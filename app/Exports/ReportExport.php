<?php

namespace App\Exports;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ReportExport implements FromQuery, WithHeadings, WithMapping
{
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function query(): Builder
    {
        return Order::query()
            ->with([
                'reseller',
                'items.product',
                'payment',
            ])
            ->when($this->request->filled('start_date'), function ($query) {
                $query->whereDate(
                    'order_date',
                    '>=',
                    $this->request->start_date
                );
            })
            ->when($this->request->filled('end_date'), function ($query) {
                $query->whereDate(
                    'order_date',
                    '<=',
                    $this->request->end_date
                );
            })
            ->when($this->request->filled('status'), function ($query) {
                $query->where(
                    'status',
                    $this->request->status
                );
            })
            ->when($this->request->filled('payment_status'), function ($query) {
                $query->where(
                    'payment_status',
                    $this->request->payment_status
                );
            })
            ->latest('order_date');
    }

    public function headings(): array
    {
        return [
            'ID Pesanan',
            'Nama Reseller',
            'Email Reseller',
            'Tanggal Pesanan',
            'Jumlah Buku',
            'Total Sebelum Diskon',
            'Diskon',
            'Total Akhir',
            'Status Pembayaran',
            'Status Pesanan',
        ];
    }

    public function map($order): array
    {
        $paymentLabel = match ($order->payment_status) {
            'paid' => 'Sudah Dibayar',
            'pending' => 'Belum Dibayar',
            'failed' => 'Gagal',
            default => ucfirst($order->payment_status),
        };

        $statusLabel = match ($order->status) {
            'pending' => 'Menunggu',
            'processed' => 'Diproses',
            'shipped' => 'Dikirim',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan',
            default => ucfirst($order->status),
        };

        return [
            $order->id,
            $order->reseller?->name ?? '-',
            $order->reseller?->email ?? '-',
            $order->order_date?->format('d/m/Y H:i') ?? '-',
            $order->items->sum('quantity'),
            $order->total_price,
            $order->discount_amount,
            $order->final_price,
            $paymentLabel,
            $statusLabel,
        ];
    }
}