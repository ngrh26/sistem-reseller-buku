<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

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

            $quantity = min(
                (int) $quantity,
                (int) $product->stock
            );

            if ($quantity <= 0) {
                continue;
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

        return view('reseller.cart.index', compact(
            'items',
            'subtotal',
            'totalQuantity'
        ));
    }

    public function add(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if ($product->stock <= 0) {
            return back()->withErrors([
                'cart' => 'Produk sedang tidak tersedia.',
            ]);
        }

        $cart = session()->get('cart', []);

        $currentQuantity = isset($cart[$product->id])
            ? (int) $cart[$product->id]
            : 0;

        $newQuantity = $currentQuantity + $validated['quantity'];

        if ($newQuantity > $product->stock) {
            return back()->withErrors([
                'cart' => "Jumlah yang diminta melebihi stok. Stok tersedia: {$product->stock}.",
            ]);
        }

        $cart[$product->id] = $newQuantity;

        session()->put('cart', $cart);

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if ($product->stock <= 0) {
            return back()->withErrors([
                'cart' => 'Produk sedang tidak tersedia.',
            ]);
        }

        if ($validated['quantity'] > $product->stock) {
            return back()->withErrors([
                'cart' => "Jumlah melebihi stok. Stok tersedia: {$product->stock}.",
            ]);
        }

        $cart = session()->get('cart', []);

        if (!isset($cart[$product->id])) {
            return back()->withErrors([
                'cart' => 'Produk tidak ditemukan di keranjang.',
            ]);
        }

        $cart[$product->id] = $validated['quantity'];

        session()->put('cart', $cart);

        return back()->with('success', 'Jumlah produk berhasil diperbarui.');
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function clear()
    {
        session()->forget('cart');

        return back()->with('success', 'Keranjang berhasil dikosongkan.');
    }
}