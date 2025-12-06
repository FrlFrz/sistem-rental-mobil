<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // Cek apakah user sudah login DAN memiliki role admin
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cek apakah user adalah admin
        // Sesuaikan dengan struktur database Anda
        if (Auth::user()->roles !== 'admin') {
            return redirect('/')->with('error', 'Akses ditolak. Anda bukan administrator.');
        }

        // Jika semua pengecekan lolos, lanjutkan request
        return $next($request);
    }
}
