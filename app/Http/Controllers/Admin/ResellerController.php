<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResellerController extends Controller
{
    public function index()
    {
        $pending = User::where('role', 'reseller')
            ->where('status', 'pending')
            ->with('reseller.package')
            ->latest()
            ->get();

        $active = User::where('role', 'reseller')
            ->where('status', 'active')
            ->with('reseller.package')
            ->latest()
            ->get();

        return view('admin.resellers.index', compact(
            'pending',
            'active'
        ));
    }

    public function pending()
    {
        $pending = User::where('role', 'reseller')
            ->where('status', 'pending')
            ->with('reseller.package')
            ->latest()
            ->get();

        return view('admin.resellers.pending', compact('pending'));
    }

    public function approve(User $user, Request $request)
    {
        abort_unless($user->role === 'reseller', 404);

        if ($user->status !== 'pending') {
            return back()->withErrors([
                'reseller' => 'Reseller ini sudah tidak berstatus pending dan tidak dapat disetujui kembali.',
            ]);
        }

        DB::transaction(function () use ($user, $request) {
            $lockedUser = User::whereKey($user->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($lockedUser->role !== 'reseller') {
                abort(404);
            }

            if ($lockedUser->status !== 'pending') {
                abort(
                    409,
                    'Status reseller sudah berubah. Silakan muat ulang halaman.'
                );
            }

            $lockedUser->update([
                'status' => 'active',
            ]);

            if ($lockedUser->reseller) {
                $lockedUser->reseller->update([
                    'approved_by' => $request->user()->id,
                    'approved_at' => now(),
                ]);
            }
        });

        return back()->with(
            'success',
            "Reseller {$user->name} telah disetujui."
        );
    }

    public function reject(User $user)
    {
        abort_unless($user->role === 'reseller', 404);

        if ($user->status !== 'pending') {
            return back()->withErrors([
                'reseller' => 'Reseller ini sudah tidak berstatus pending dan tidak dapat ditolak sebagai pendaftaran baru.',
            ]);
        }

        DB::transaction(function () use ($user) {
            $lockedUser = User::whereKey($user->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($lockedUser->role !== 'reseller') {
                abort(404);
            }

            if ($lockedUser->status !== 'pending') {
                abort(
                    409,
                    'Status reseller sudah berubah. Silakan muat ulang halaman.'
                );
            }

            $lockedUser->update([
                'status' => 'inactive',
            ]);
        });

        return back()->with(
            'success',
            "Pendaftaran {$user->name} ditolak."
        );
    }
}