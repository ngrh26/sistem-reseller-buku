<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function create(Request $request, Order $order)
    {
        $this->authorizeOrder($request, $order);

        if ($order->payment_status === 'paid') {
            return redirect()
                ->route('reseller.orders.show', $order)
                ->with('success', 'Pesanan ini sudah dibayar.');
        }

        if ($order->status === 'cancelled') {
            return redirect()
                ->route('reseller.orders.show', $order)
                ->withErrors([
                    'payment' => 'Pesanan yang dibatalkan tidak dapat dibayar.',
                ]);
        }

        $payment = $order->payment;

        if ($payment && $payment->status === 'verified') {
            return redirect()
                ->route('reseller.orders.show', $order)
                ->withErrors([
                    'payment' => 'Pembayaran pesanan ini sudah diverifikasi.',
                ]);
        }

        return view('reseller.payment.create', compact(
            'order',
            'payment'
        ));
    }

    public function store(Request $request, Order $order)
    {
        $this->authorizeOrder($request, $order);

        if ($order->payment_status === 'paid') {
            return redirect()
                ->route('reseller.orders.show', $order)
                ->withErrors([
                    'payment' => 'Pesanan ini sudah dibayar.',
                ]);
        }

        if ($order->status === 'cancelled') {
            return back()->withErrors([
                'payment' => 'Pesanan yang dibatalkan tidak dapat dibayar.',
            ]);
        }

        $validated = $request->validate([
            'proof_file' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,webp,pdf',
                'max:5120',
            ],
        ], [
            'proof_file.required' => 'Bukti pembayaran wajib diunggah.',
            'proof_file.file' => 'File bukti pembayaran tidak valid.',
            'proof_file.mimes' => 'Bukti pembayaran harus berupa JPG, JPEG, PNG, WEBP, atau PDF.',
            'proof_file.max' => 'Ukuran bukti pembayaran maksimal 5 MB.',
        ]);

        $oldProofFile = null;
        $newProofFile = null;

        DB::transaction(function () use (
            $request,
            $order,
            $validated,
            &$oldProofFile,
            &$newProofFile
        ) {
            /*
             * Lock order agar dua request pembayaran
             * tidak diproses secara bersamaan.
             */
            $lockedOrder = Order::whereKey($order->id)
                ->lockForUpdate()
                ->firstOrFail();

            /*
             * Pastikan status terbaru tetap aman setelah
             * order berhasil dikunci.
             */
            if ($lockedOrder->payment_status === 'paid') {
                abort(409, 'Pesanan ini sudah dibayar.');
            }

            if ($lockedOrder->status === 'cancelled') {
                abort(409, 'Pesanan yang dibatalkan tidak dapat dibayar.');
            }

            $existingPayment = Payment::where('order_id', $lockedOrder->id)
                ->lockForUpdate()
                ->first();

            /*
             * Payment yang sudah verified tidak boleh
             * diganti oleh reseller.
             */
            if ($existingPayment && $existingPayment->status === 'verified') {
                abort(409, 'Pembayaran pesanan ini sudah diverifikasi.');
            }

            /*
             * Simpan path file lama untuk dihapus
             * setelah data baru berhasil disimpan.
             */
            if ($existingPayment && $existingPayment->proof_file) {
                $oldProofFile = $existingPayment->proof_file;
            }

            /*
             * Simpan bukti pembayaran ke private storage.
             *
             * Disk "local" menggunakan:
             * storage/app/private
             *
             * sehingga file tidak dapat diakses langsung
             * melalui URL public /storage.
             */
            $newProofFile = $validated['proof_file']
                ->store('payments', 'local');

            if ($existingPayment) {
                $existingPayment->update([
                    'reseller_id' => $request->user()->id,
                    'amount' => $lockedOrder->final_price,
                    'proof_file' => $newProofFile,
                    'status' => 'pending',
                    'verified_by' => null,
                    'verified_at' => null,
                ]);
            } else {
                Payment::create([
                    'order_id' => $lockedOrder->id,
                    'reseller_id' => $request->user()->id,
                    'amount' => $lockedOrder->final_price,
                    'proof_file' => $newProofFile,
                    'status' => 'pending',
                ]);
            }

            $lockedOrder->update([
                'payment_status' => 'pending',
            ]);
        });

        /*
         * Hapus file bukti pembayaran lama setelah
         * transaction database berhasil dilakukan.
         */
        if ($oldProofFile && $oldProofFile !== $newProofFile) {
            Storage::disk('local')->delete($oldProofFile);
        }

        return redirect()
            ->route('reseller.orders.show', $order)
            ->with(
                'success',
                'Bukti pembayaran berhasil diunggah dan sedang menunggu verifikasi admin.'
            );
    }

    private function authorizeOrder(
        Request $request,
        Order $order
    ): void {
        abort_unless(
            $order->reseller_id === $request->user()->id,
            403,
            'Anda tidak memiliki akses ke pesanan ini.'
        );
    }
}
