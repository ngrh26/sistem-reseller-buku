<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $user->load('reseller.package');

        return view('reseller.profile.index', compact('user'));
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'phone' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:1000'],
            'profile_photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email tersebut sudah digunakan.',
            'phone.required' => 'Nomor HP wajib diisi.',
            'phone.max' => 'Nomor HP maksimal 20 karakter.',
            'address.required' => 'Alamat wajib diisi.',
            'address.max' => 'Alamat maksimal 1000 karakter.',
            'profile_photo.image' => 'File foto profil harus berupa gambar.',
            'profile_photo.mimes' => 'Foto profil harus berupa JPG, JPEG, PNG, atau WEBP.',
            'profile_photo.max' => 'Ukuran foto profil maksimal 2 MB.',
        ]);

        /*
        |--------------------------------------------------------------------------
        | UPLOAD FOTO PROFIL
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('profile_photo')) {

            // Hapus foto lama jika ada
            if ($user->profile_photo) {
                Storage::disk('public')->delete(
                    $user->profile_photo
                );
            }

            // Simpan foto baru
            $validated['profile_photo'] = $request
                ->file('profile_photo')
                ->store('profile', 'public');
        }

        $user->update($validated);

        return back()->with(
            'success',
            'Profil berhasil diperbarui.'
        );
    }

    public function removePhoto(Request $request)
    {
        $user = $request->user();

        if ($user->profile_photo) {

            Storage::disk('public')->delete(
                $user->profile_photo
            );

            $user->update([
                'profile_photo' => null,
            ]);
        }

        return back()->with(
            'success',
            'Foto profil berhasil dihapus.'
        );
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => [
                'required',
                'current_password',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ], [
            'current_password.required' => 'Password lama wajib diisi.',
            'current_password.current_password' => 'Password lama tidak sesuai.',
            'password.required' => 'Password baru wajib diisi.',
            'password.min' => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $request->user()->update([
            'password' => Hash::make(
                $validated['password']
            ),
        ]);

        return back()->with(
            'success',
            'Password berhasil diubah. Gunakan password baru saat login berikutnya.'
        );
    }
}