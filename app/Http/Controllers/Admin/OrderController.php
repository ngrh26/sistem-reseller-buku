<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with([
            'reseller',
            'items.product',
            'payment',
        ])
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('id', 'like', "%{$search}%")
                        ->orWhereHas('reseller', function ($resellerQuery) use ($search) {
                            $resellerQuery
                                ->where('name', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                        });
                });
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->payment_status, function ($query, $paymentStatus) {
                $query->where('payment_status', $paymentStatus);
            })
            ->latest('order_date')
            ->paginate(10)
            ->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load([
            'reseller.reseller.package',
            'items.product',
            'payment',
        ]);

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                Rule::in([
                    'pending',
                    'processed',
                    'shipped',
                    'completed',
                    'cancelled',
                ]),
            ],
        ]);

        $newStatus = $validated['status'];

        if ($order->status === $newStatus) {
            return back()->with(
                'success',
                'Status pesanan tidak mengalami perubahan.'
            );
        }

        if (!$this->isValidStatusTransition($order->status, $newStatus)) {
            return back()->withErrors([
                'status' => "Status pesanan tidak dapat diubah dari {$order->status} menjadi {$newStatus}.",
            ]);
        }

        /*
         * Pembatalan pesanan membutuhkan perlakuan khusus
         * karena stok harus dikembalikan dan pembayaran
         * harus disinkronkan.
         */
        if ($newStatus === 'cancelled') {
            $this->cancelOrder($order);

            return back()->with(
                'success',
                "Pesanan #{$order->id} berhasil dibatalkan dan stok telah dikembalikan."
            );
        }

        $order->update([
            'status' => $newStatus,
        ]);

        return back()->with(
            'success',
            'Status pesanan berhasil diperbarui.'
        );
    }

    private function cancelOrder(Order $order): void
    {
        DB::transaction(function () use ($order) {
            /*
             * Kunci order agar dua request Admin tidak dapat
             * membatalkan order yang sama secara bersamaan.
             */
            $lockedOrder = Order::whereKey($order->id)
                ->lockForUpdate()
                ->firstOrFail();

            /*
             * Pastikan status masih dapat dibatalkan setelah
             * mendapatkan database lock.
             */
            if (!in_array($lockedOrder->status, [
                'pending',
                'processed',
            ], true)) {
                abort(
                    409,
                    "Pesanan #{$lockedOrder->id} tidak dapat dibatalkan dari status {$lockedOrder->status}."
                );
            }

            /*
             * Pesanan yang sudah dibayar tidak dibatalkan
             * melalui mekanisme ini karena sistem belum memiliki
             * mekanisme refund.
             */
            if ($lockedOrder->payment_status === 'paid') {
                abort(
                    409,
                    'Pesanan yang sudah dibayar tidak dapat dibatalkan melalui sistem karena mekanisme refund belum tersedia.'
                );
            }

            /*
             * Ambil seluruh item pesanan.
             */
            $items = $lockedOrder->items()->get();

            /*
             * Jika satu produk muncul beberapa kali dalam order,
             * quantity dijumlahkan terlebih dahulu agar stok
             * dikembalikan secara tepat.
             */
            $productQuantities = $items
                ->groupBy('product_id')
                ->map(function ($productItems) {
                    return $productItems->sum('quantity');
                })
                ->sortKeys();

            /*
             * Kunci setiap produk sebelum mengembalikan stok
             * untuk mencegah race condition dengan transaksi lain.
             */
            foreach ($productQuantities as $productId => $quantity) {
                $product = Product::whereKey($productId)
                    ->lockForUpdate()
                    ->firstOrFail();

                $product->increment('stock', $quantity);
            }

            /*
             * Jika terdapat pembayaran yang masih pending,
             * tandai sebagai rejected karena order telah dibatalkan.
             */
            Payment::where('order_id', $lockedOrder->id)
                ->where('status', 'pending')
                ->lockForUpdate()
                ->update([
                    'status' => 'rejected',
                    'verified_by' => null,
                    'verified_at' => null,
                ]);

            /*
             * Setelah order dibatalkan:
             * - status order = cancelled
             * - payment status = failed
             *
             * Karena pada titik ini payment_status dipastikan
             * bukan paid.
             */
            $lockedOrder->update([
                'status' => 'cancelled',
                'payment_status' => 'failed',
            ]);
        });
    }

    private function isValidStatusTransition(
        string $currentStatus,
        string $newStatus
    ): bool {
        $transitions = [
            'pending' => [
                'processed',
                'cancelled',
            ],

            'processed' => [
                'shipped',
                'cancelled',
            ],

            'shipped' => [
                'completed',
            ],

            'completed' => [],

            'cancelled' => [],
        ];

        return in_array(
            $newStatus,
            $transitions[$currentStatus] ?? [],
            true
        );
    }
}