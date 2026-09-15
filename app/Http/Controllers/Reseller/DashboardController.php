<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $user->load('reseller.package');

        $reseller = $user->reseller;
        $package = $reseller?->package;

        $ordersQuery = Order::where('reseller_id', $user->id);

        $totalPesanan = (clone $ordersQuery)->count();

        $pesananPending = (clone $ordersQuery)
            ->where('status', 'pending')
            ->count();

        $pesananSelesai = (clone $ordersQuery)
            ->where('status', 'completed')
            ->count();

        $totalBelanja = (clone $ordersQuery)
            ->where('payment_status', 'paid')
            ->sum('final_price');

        $totalBuku = (clone $ordersQuery)
            ->where('payment_status', 'paid')
            ->withSum('items', 'quantity')
            ->get()
            ->sum('items_sum_quantity');

        $pesananTerbaru = Order::with([
            'items.product',
            'payment',
        ])
            ->where('reseller_id', $user->id)
            ->latest('order_date')
            ->take(5)
            ->get();

        $produkTerbaru = Product::latest()
            ->take(8)
            ->get();

        $currentLevel = match ($package?->name) {
            'Starter' => 1,
            'Profesional' => 2,
            'Distributor' => 3,
            default => 0,
        };

        $nextPackage = match ($currentLevel) {
            1 => [
                'name' => 'Profesional',
                'target' => 20,
            ],
            2 => [
                'name' => 'Distributor',
                'target' => 40,
            ],
            default => null,
        };

        if ($nextPackage) {
            $progressTarget = $nextPackage['target'];

            $progressPercentage = min(
                100,
                ($totalBuku / $progressTarget) * 100
            );

            $sisaBuku = max(
                0,
                $progressTarget - $totalBuku
            );
        } else {
            $progressTarget = $currentLevel === 3 ? 40 : 0;
            $progressPercentage = 100;
            $sisaBuku = 0;
        }

        return view('reseller.dashboard', compact(
            'user',
            'reseller',
            'package',
            'totalPesanan',
            'pesananPending',
            'pesananSelesai',
            'totalBelanja',
            'totalBuku',
            'pesananTerbaru',
            'produkTerbaru',
            'nextPackage',
            'progressTarget',
            'progressPercentage',
            'sisaBuku'
        ));
    }
}