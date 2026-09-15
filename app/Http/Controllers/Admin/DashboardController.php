<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalReseller = User::where('role', 'reseller')->where('status', 'active')->count();
        $totalPesanan = Order::count();
        $totalPendapatan = Order::where('payment_status', 'paid')->sum('final_price');
        $totalProduk = Product::count();

        $pesananTerbaru = Order::with('reseller')->latest()->take(5)->get();
        $pendingReseller = User::where('role', 'reseller')->where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalReseller',
            'totalPesanan',
            'totalPendapatan',
            'totalProduk',
            'pesananTerbaru',
            'pendingReseller'
        ));
    }
}