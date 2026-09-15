<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $orders = Order::with([
            'items.product',
            'payment',
        ])
            ->where('reseller_id', $user->id)
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->when($request->filled('payment_status'), function ($query) use ($request) {
                $query->where('payment_status', $request->payment_status);
            })
            ->latest('order_date')
            ->paginate(10)
            ->withQueryString();

        return view('reseller.orders.index', compact('orders'));
    }

    public function show(Request $request, Order $order)
    {
        $this->authorizeOrder($request, $order);

        $order->load([
            'items.product',
            'payment',
        ]);

        return view('reseller.orders.show', compact('order'));
    }

    public function cancel(Request $request, Order $order)
    {
        $this->authorizeOrder($request, $order);

        DB::transaction(function () use ($order) {
            /*
             * Lock order terlebih dahulu agar dua request tidak dapat
             * membatalkan order yang sama secara bersamaan.
             */
            $lockedOrder = Order::whereKey($order->id)
                ->lockForUpdate()
                ->firstOrFail();

            /*
             * Pastikan order masih pending setelah mendapatkan lock.
             */
            if ($lockedOrder->status !== 'pending') {
                abort(
                    409,
                    'Pesanan hanya dapat dibatalkan saat masih berstatus menunggu.'
                );
            }

            /*
             * Ambil item order.
             */
            $items = $lockedOrder->items()->get();

            /*
             * Kelompokkan quantity berdasarkan product_id.
             *
             * Ini memastikan setiap produk cukup dikunci satu kali
             * meskipun secara tidak sengaja terdapat lebih dari satu
             * order item untuk produk yang sama.
             */
            $productQuantities = $items
                ->groupBy('product_id')
                ->map(function ($productItems) {
                    return $productItems->sum('quantity');
                })
                ->sortKeys();

            /*
             * Lock setiap produk sebelum mengembalikan stok.
             */
            foreach ($productQuantities as $productId => $quantity) {
                $product = Product::whereKey($productId)
                    ->lockForUpdate()
                    ->firstOrFail();

                $product->increment('stock', $quantity);
            }

            /*
             * Jika terdapat pembayaran yang masih pending,
             * tandai sebagai rejected karena order dibatalkan.
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
             * Order dibatalkan dan status pembayaran dibuat failed.
             *
             * Semua perubahan di atas berada dalam transaction yang sama.
             */
            $lockedOrder->update([
                'status' => 'cancelled',
                'payment_status' => 'failed',
            ]);
        });

        return back()->with(
            'success',
            "Pesanan #{$order->id} berhasil dibatalkan."
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