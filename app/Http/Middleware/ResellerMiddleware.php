<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ResellerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user || !$user->isReseller()) {
            abort(403, 'Akses ditolak. Halaman ini khusus Reseller.');
        }

        if ($user->status !== 'active') {
            auth()->logout();
            return redirect()->route('login')->withErrors([
                'email' => $user->status === 'pending'
                    ? 'Akun Anda masih menunggu verifikasi admin.'
                    : 'Akun Anda tidak aktif. Hubungi admin.',
            ]);
        }

        return $next($request);
    }
}