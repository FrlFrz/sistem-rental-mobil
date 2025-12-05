<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UnitMobilController;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\JenisMobilController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\VerifikasiController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/verifikasi-pelanggan', function () {
    return view('admin.verifikasi.verifikasi-pelanggan');
})->middleware(['auth', 'verified'])->name('verifikasi-pelanggan');

Route::get('/order-summaries', function () {
    return view('order-summaries');
})->middleware(['auth', 'verified'])->name('order-summaries');

Route::get('/katalog', function (Request $request) {
    return view('layouts.katalog');
})->name('katalog.index');

Route::get('/histori-pemesanan', [PemesananController::class, 'historiRental'])
    ->name('histori');

Route::get('/search', [SearchController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     Route::get('/qr/konversi/{token}', [PemesananController::class, 'downloadQrCode'])
        ->name('pemesanan.qr.konversi');

    Route::get('/api/riwayat/detail/{id}', [PemesananController::class, 'getDetailRiwayat'])
    ->name('api.riwayat.detail');

    Route::get('/api/verifikasi/detail/{token}', [VerifikasiController::class, 'getDetailByToken'])
    ->name('api.verifikasi.detail');

    Route::patch('/pemesanan/konfirmasi/{pemesanan}', [PemesananController::class, 'konfirmasiAksi'])
        ->name('pemesanan.serah_terima');

    Route::patch('/pemesanan/pengembalian/{pemesanan}', [PemesananController::class, 'konfirmasiAksi'])
        ->name('pemesanan.pengembalian');


    // Route CRUD
    Route::resource('/jenis_mobil', JenisMobilController::class);
    Route::resource('/akun_user', UserController::class);
    Route::resource('/unit_mobil', UnitMobilController::class);
    Route::resource('/pemesanan', PemesananController::class);

});

require __DIR__.'/auth.php';

