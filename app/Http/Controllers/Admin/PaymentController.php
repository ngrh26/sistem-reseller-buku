<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Reseller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $payments = Payment::with([
            'order',
            'reseller',
            'verifier',
        ])
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('reseller', function ($resellerQuery) use ($search) {
                        $resellerQuery
                            ->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    })
                    ->orWhereHas('order', function ($orderQuery) use ($search) {
                        $orderQuery->where('id', 'like', "%{$search}%");
                    });
                });
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.payments.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        $payment->load([
            'order.items.product',
            'reseller',
            'verifier',
        ]);

        return view('admin.payments.show', compact('payment'));
    }

    public function verify(Payment $payment, Request $request)
    {
        if ($payment->status !== 'pending') {
            return back()->withErrors([
                'payment' => 'Pembayaran ini sudah diproses sebelumnya.',
            ]);
        }

        DB::transaction(function () use ($payment, $request) {

            /*
             * Lock payment agar dua admin tidak dapat
             * memverifikasi pembayaran yang sama secara bersamaan.
             */
            $lockedPayment = Payment::whereKey($payment->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($lockedPayment->status !== 'pending') {
                abort(
                    409,
                    'Pembayaran ini sudah diproses oleh admin lain.'
                );
            }

            /*
             * Pastikan bukti pembayaran tersedia.
             */
            if (!$lockedPayment->proof_file) {
                abort(
                    409,
                    'Pembayaran tidak dapat diverifikasi karena bukti pembayaran tidak tersedia.'
                );
            }

            /*
             * Bukti pembayaran harus benar-benar ada
             * di private storage.
             */
            if (!Storage::disk('local')->exists($lockedPayment->proof_file)) {
                abort(
                    409,
                    'Pembayaran tidak dapat diverifikasi karena file bukti pembayaran tidak ditemukan.'
                );
            }

            /*
             * Lock order yang berkaitan dengan payment.
             */
            $order = Order::with('items')
                ->whereKey($lockedPayment->order_id)
                ->lockForUpdate()
                ->firstOrFail();

            /*
             * Order yang sudah dibatalkan tidak boleh
             * menerima verifikasi pembayaran.
             */
            if ($order->status === 'cancelled') {
                abort(
                    409,
                    'Pembayaran tidak dapat diverifikasi karena pesanan sudah dibatalkan.'
                );
            }

            /*
             * Order yang sudah paid tidak boleh diverifikasi ulang.
             */
            if ($order->payment_status === 'paid') {
                abort(
                    409,
                    'Pesanan ini sudah berstatus dibayar.'
                );
            }

            /*
             * Pastikan nilai pembayaran sesuai dengan
             * nilai akhir pesanan.
             */
            if ((float) $lockedPayment->amount !== (float) $order->final_price) {
                abort(
                    409,
                    'Nilai pembayaran tidak sesuai dengan total akhir pesanan.'
                );
            }

            /*
             * Lock reseller karena total_purchase dan
             * package_id akan diperbarui.
             */
            $reseller = Reseller::where('user_id', $order->reseller_id)
                ->lockForUpdate()
                ->firstOrFail();

            /*
             * Hitung jumlah buku pada transaksi ini.
             */
            $jumlahBuku = $order->items->sum('quantity');

            if ($jumlahBuku <= 0) {
                abort(
                    409,
                    'Pesanan tidak memiliki jumlah buku yang valid.'
                );
            }

            /*
             * Verifikasi pembayaran.
             */
            $lockedPayment->update([
                'status' => 'verified',
                'verified_by' => $request->user()->id,
                'verified_at' => now(),
            ]);

            /*
             * Tandai order sebagai sudah dibayar.
             */
            $order->update([
                'payment_status' => 'paid',
            ]);

            /*
             * Tambahkan jumlah buku transaksi ini
             * ke total pembelian kumulatif reseller.
             */
            $totalPurchaseBaru = $reseller->total_purchase + $jumlahBuku;

            $reseller->update([
                'total_purchase' => $totalPurchaseBaru,
            ]);

            /*
             * =====================================================
             * OTOMATISASI KENAIKAN PAKET RESELLER
             * =====================================================
             *
             * Starter     : minimal 5 buku
             * Profesional : minimal 20 buku
             * Distributor : minimal 40 buku
             *
             * Paket hanya boleh naik dan tidak pernah turun.
             */

            $currentPackage = $reseller->package;

            $currentLevel = match ($currentPackage?->name) {
                'Starter' => 1,
                'Profesional' => 2,
                'Distributor' => 3,
                default => 0,
            };

            $newLevel = $currentLevel;

            if ($totalPurchaseBaru >= 40) {
                $newLevel = 3;
            } elseif ($totalPurchaseBaru >= 20) {
                $newLevel = 2;
            } elseif ($totalPurchaseBaru >= 5) {
                $newLevel = 1;
            }

            /*
             * Hanya lakukan update jika level paket
             * lebih tinggi daripada level sebelumnya.
             */
            if ($newLevel > $currentLevel) {

                $newPackageName = match ($newLevel) {
                    1 => 'Starter',
                    2 => 'Profesional',
                    3 => 'Distributor',
                    default => null,
                };

                if ($newPackageName) {
                    $newPackage = Package::where(
                        'name',
                        $newPackageName
                    )->firstOrFail();

                    $reseller->update([
                        'package_id' => $newPackage->id,
                    ]);
                }
            }
        });

        return back()->with(
            'success',
            'Pembayaran berhasil diverifikasi dan progres paket reseller telah diperbarui.'
        );
    }

    public function reject(Payment $payment, Request $request)
    {
        if ($payment->status !== 'pending') {
            return back()->withErrors([
                'payment' => 'Pembayaran ini sudah diproses sebelumnya.',
            ]);
        }

        DB::transaction(function () use ($payment, $request) {

            /*
             * Lock payment agar tidak dapat diverifikasi
             * atau ditolak secara bersamaan.
             */
            $lockedPayment = Payment::whereKey($payment->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($lockedPayment->status !== 'pending') {
                abort(
                    409,
                    'Pembayaran ini sudah diproses oleh admin lain.'
                );
            }

            /*
             * Lock order yang berkaitan dengan payment.
             */
            $order = Order::whereKey($lockedPayment->order_id)
                ->lockForUpdate()
                ->firstOrFail();

            /*
             * Order yang sudah dibayar tidak boleh
             * diubah menjadi failed.
             */
            if ($order->payment_status === 'paid') {
                abort(
                    409,
                    'Pembayaran tidak dapat ditolak karena pesanan sudah berstatus dibayar.'
                );
            }

            /*
             * Tolak pembayaran.
             */
            $lockedPayment->update([
                'status' => 'rejected',
                'verified_by' => $request->user()->id,
                'verified_at' => now(),
            ]);

            /*
             * Tandai status pembayaran order sebagai gagal.
             */
            $order->update([
                'payment_status' => 'failed',
            ]);
        });

        return back()->with(
            'success',
            'Pembayaran berhasil ditolak.'
        );
    }

    public function downloadProof(Payment $payment)
    {
        if (!$payment->proof_file) {
            abort(404, 'Bukti pembayaran tidak ditemukan.');
        }

        /*
         * Bukti pembayaran berada di private storage.
         * File hanya dapat diakses melalui method ini,
         * yang berada di route admin dan dilindungi
         * middleware auth + admin.
         */
        if (!Storage::disk('local')->exists($payment->proof_file)) {
            abort(404, 'File bukti pembayaran tidak ditemukan.');
        }

        return Storage::disk('local')->download(
            $payment->proof_file
        );
    }

    public function previewProof(Payment $payment)
    {
        if (!$payment->proof_file) {
            abort(404, 'Bukti pembayaran tidak ditemukan.');
        }

        /*
         * Gunakan local disk karena bukti pembayaran
         * disimpan di storage/app/private.
         */
        $disk = Storage::disk('local');

        /*
         * Pastikan file benar-benar tersedia.
         */
        if (!$disk->exists($payment->proof_file)) {
            abort(404, 'File bukti pembayaran tidak ditemukan.');
        }

        /*
         * Ambil lokasi fisik file.
         */
        $path = $disk->path($payment->proof_file);

        /*
         * Tentukan MIME type file.
         */
        $mimeType = $disk->mimeType($payment->proof_file);

        /*
         * Hanya izinkan format yang memang digunakan
         * untuk bukti pembayaran.
         */
        if (!in_array($mimeType, [
            'image/jpeg',
            'image/png',
            'image/webp',
            'application/pdf',
        ], true)) {
            abort(404, 'Format bukti pembayaran tidak didukung.');
        }

        /*
         * Tampilkan file secara inline.
         *
         * Dengan Content-Disposition: inline:
         * - gambar dapat ditampilkan langsung di browser
         * - PDF dapat dibuka langsung oleh browser
         * - file tidak dipaksa untuk di-download
         */
        return response()->file($path, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . basename($payment->proof_file) . '"',
            'X-Content-Type-Options' => 'nosniff',
        ]);
    }
}
