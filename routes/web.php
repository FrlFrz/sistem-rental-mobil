<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisMobilController;
use App\Http\Controllers\UnitMobilController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/verifikasi-pelanggan', function () {
    return view('admin.verifikasi-pelanggan');
})->middleware(['auth', 'verified'])->name('verifikasi-pelanggan');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route CRUD
    Route::resource('/jenis_mobil', JenisMobilController::class);
    Route::resource('/akun_user', UserController::class);
    Route::resource('/unit_mobil', UnitMobilController::class);
});

require __DIR__.'/auth.php';
