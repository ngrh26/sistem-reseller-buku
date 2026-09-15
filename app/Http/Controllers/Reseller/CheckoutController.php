<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('reseller.catalog.index')
                ->withErrors([
                    'cart' => 'Keranjang Anda masih kosong.',
                ]);
        }

        if (!$user->reseller || !$user->reseller->package) {
            return back()->withErrors([
                'checkout' => 'Data paket reseller Anda belum tersedia.',
            ]);
        }

        $productIds = array_keys($cart);

        $products = Product::whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        $items = [];
        $subtotal = 0;
        $totalQuantity = 0;

        foreach ($cart as $productId => $quantity) {
            if (!isset($products[$productId])) {
                continue;
            }

            $product = $products[$productId];
            $quantity = (int) $quantity;

            if ($quantity <= 0) {
                continue;
            }

            if ($quantity > $product->stock) {
                return redirect()
                    ->route('reseller.cart.index')
                    ->withErrors([
                        'cart' => "Stok {$product->title} tidak mencukupi. Stok tersedia: {$product->stock}.",
                    ]);
            }

            $itemTotal = $product->price * $quantity;

            $items[] = [
                'product' => $product,
                'quantity' => $quantity,
                'item_total' => $itemTotal,
            ];

            $subtotal += $itemTotal;
            $totalQuantity += $quantity;
        }

        if (empty($items)) {
            session()->forget('cart');

            return redirect()
                ->route('reseller.catalog.index')
                ->withErrors([
                    'cart' => 'Tidak ada produk valid di dalam keranjang.',
                ]);
        }

        $package = $user->reseller->package;

        $minimumPurchase = (int) $package->min_purchase;
        $discountPercentage = (float) $package->discount_percentage;

        $minimumPurchaseMet = $totalQuantity >= $minimumPurchase;

        /*
         * Diskon hanya diberikan apabila minimum pembelian
         * paket terpenuhi.
         */
        $discountAmount = $minimumPurchaseMet
            ? $subtotal * ($discountPercentage / 100)
            : 0;

        $finalPrice = $subtotal - $discountAmount;

        return view('reseller.checkout.index', compact(
            'user',
            'items',
            'subtotal',
            'totalQuantity',
            'package',
            'minimumPurchase',
            'discountPercentage',
            'minimumPurchaseMet',
            'discountAmount',
            'finalPrice'
        ));
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'shipping_address' => ['required', 'string', 'max:1000'],
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('reseller.catalog.index')
                ->withErrors([
                    'cart' => 'Keranjang Anda masih kosong.',
                ]);
        }

        if (!$user->reseller || !$user->reseller->package) {
            return back()->withErrors([
                'checkout' => 'Data paket reseller Anda belum tersedia.',
            ]);
        }

        try {
            $order = DB::transaction(function () use (
                $user,
                $cart,
                $validated
            ) {
                $productIds = array_keys($cart);

                $products = Product::whereIn('id', $productIds)
                    ->lockForUpdate()
                    ->get()
                    ->keyBy('id');

                $subtotal = 0;
                $totalQuantity = 0;
                $orderItems = [];

                foreach ($cart as $productId => $quantity) {
                    if (!isset($products[$productId])) {
                        throw new \RuntimeException(
                            'Salah satu produk di keranjang sudah tidak tersedia.'
                        );
                    }

                    $product = $products[$productId];
                    $quantity = (int) $quantity;

                    if ($quantity <= 0) {
                        continue;
                    }

                    if ($quantity > $product->stock) {
                        throw new \RuntimeException(
                            "Stok {$product->title} tidak mencukupi. Stok tersedia: {$product->stock}."
                        );
                    }

                    $itemTotal = $product->price * $quantity;

                    $orderItems[] = [
                        'product' => $product,
                        'quantity' => $quantity,
                        'price_per_unit' => $product->price,
                        'total_price' => $itemTotal,
                    ];

                    $subtotal += $itemTotal;
                    $totalQuantity += $quantity;
                }

                if (empty($orderItems)) {
                    throw new \RuntimeException(
                        'Tidak ada produk yang dapat diproses.'
                    );
                }

                /*
                 * Ambil paket reseller terbaru.
                 */
                $package = $user->reseller->package;

                $minimumPurchase = (int) $package->min_purchase;

                /*
                 * BLOKIR CHECKOUT DARI BACKEND
                 * apabila jumlah buku belum memenuhi minimum paket.
                 */
                if ($totalQuantity < $minimumPurchase) {
                    throw new \RuntimeException(
                        "Minimum pembelian paket {$package->name} adalah {$minimumPurchase} buku. " .
                        "Jumlah buku di keranjang Anda baru {$totalQuantity}."
                    );
                }

                $discountPercentage = (float) $package->discount_percentage;

                $discountAmount = $subtotal * (
                    $discountPercentage / 100
                );

                $finalPrice = $subtotal - $discountAmount;

                $order = Order::create([
                    'reseller_id' => $user->id,
                    'order_date' => now(),
                    'total_price' => $subtotal,
                    'discount_amount' => $discountAmount,
                    'final_price' => $finalPrice,
                    'status' => 'pending',
                    'payment_status' => 'pending',
                    'shipping_address' => $validated['shipping_address'],
                ]);

                foreach ($orderItems as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['product']->id,
                        'quantity' => $item['quantity'],
                        'price_per_unit' => $item['price_per_unit'],
                        'total_price' => $item['total_price'],
                    ]);

                    $item['product']->decrement(
                        'stock',
                        $item['quantity']
                    );
                }

                return $order;
            });
        } catch (\RuntimeException $e) {
            return redirect()
                ->route('reseller.cart.index')
                ->withErrors([
                    'checkout' => $e->getMessage(),
                ]);
        }

        session()->forget('cart');

        return redirect()
            ->route('reseller.orders.show', $order)
            ->with(
                'success',
                "Pesanan #{$order->id} berhasil dibuat. Silakan lakukan pembayaran."
            );
    }
}