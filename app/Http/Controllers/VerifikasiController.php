<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{

    public function getDetailByToken($token) {
        $pemesanan = Pemesanan::with('unitMobil.jenis_mobil')->where('verification_token', $token)->first();

        if (!$pemesanan) {
            return response()->json(['success' => false, 'message' => 'Token tidak valid.'], 404);
        }

        // Mengembalikan data lengkap sebagai JSON
        return response()->json([
            'success' => true,
            'pemesanan' => $pemesanan
        ]);
    }
}
