<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResellerController extends Controller
{
    /**
     * Menampilkan daftar reseller pending dan aktif.
     */
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

    /**
     * Menampilkan daftar reseller yang masih pending.
     */
    public function pending()
    {
        $pending = User::where('role', 'reseller')
            ->where('status', 'pending')
            ->with('reseller.package')
            ->latest()
            ->get();

        return view('admin.resellers.pending', compact('pending'));
    }

    /**
     * Menyetujui pendaftaran reseller.
     */
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

    /**
     * Menolak pendaftaran reseller.
     */
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

    /**
     * Menampilkan halaman edit reseller.
     */
    public function edit(User $user)
    {
        abort_unless($user->role === 'reseller', 404);

        $user->load('reseller.package');

        if (!$user->reseller) {
            return back()->withErrors([
                'reseller' => 'Data reseller untuk akun ini tidak ditemukan.',
            ]);
        }

        $packages = Package::orderBy('min_purchase')
            ->get();

        return view('admin.resellers.edit', compact(
            'user',
            'packages'
        ));
    }

    /**
     * Memperbarui data reseller.
     */
    public function update(Request $request, User $user)
    {
        abort_unless($user->role === 'reseller', 404);

        $user->load('reseller');

        if (!$user->reseller) {
            return back()->withErrors([
                'reseller' => 'Data reseller untuk akun ini tidak ditemukan.',
            ]);
        }

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . $user->id,
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'package_id' => [
                'required',
                'exists:packages,id',
            ],

            'status' => [
                'required',
                'in:active,inactive,pending',
            ],
        ]);

        DB::transaction(function () use ($user, $validated) {
            $user->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'address' => $validated['address'] ?? null,
                'status' => $validated['status'],
            ]);

            $user->reseller->update([
                'package_id' => $validated['package_id'],
            ]);
        });

        return redirect()
            ->route('admin.resellers.index')
            ->with(
                'success',
                "Data reseller {$user->name} berhasil diperbarui."
            );
    }

    /**
     * Reset password reseller oleh admin.
     */
    public function resetPassword(Request $request, User $user)
    {
        abort_unless($user->role === 'reseller', 404);

        $validated = $request->validate([
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with(
            'success',
            "Password reseller {$user->name} berhasil direset."
        );
    }

    /**
     * Menghapus reseller.
     *
     * Reseller yang sudah memiliki transaksi tidak boleh dihapus
     * untuk menjaga riwayat transaksi.
     */
    public function destroy(User $user)
    {
        abort_unless($user->role === 'reseller', 404);

        $hasOrders = Order::where('reseller_id', $user->id)
            ->exists();

        if ($hasOrders) {
            return back()->withErrors([
                'reseller' =>
                    "Reseller {$user->name} tidak dapat dihapus karena sudah memiliki riwayat transaksi. Silakan nonaktifkan reseller tersebut.",
            ]);
        }

        DB::transaction(function () use ($user) {
            /*
             * Hapus data reseller terlebih dahulu agar relasi
             * reseller -> user tidak bermasalah.
             */
            if ($user->reseller) {
                $user->reseller->delete();
            }

            $user->delete();
        });

        return back()->with(
            'success',
            "Reseller {$user->name} berhasil dihapus."
        );
    }
}