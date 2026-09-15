<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Reseller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        $packages = Package::orderBy('discount_percentage')->get();
        return view('auth.register', compact('packages'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'package_id' => ['required', 'exists:packages,id'],
        ]);

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'password' => Hash::make($validated['password']),
                'role' => 'reseller',
                'status' => 'pending',
            ]);

            Reseller::create([
                'user_id' => $user->id,
                'package_id' => $validated['package_id'],
                'join_date' => now(),
                'total_purchase' => 0,
            ]);
        });

        return redirect()->route('login')->with('status',
            'Pendaftaran berhasil! Akun Anda sedang menunggu verifikasi admin.');
    }
}