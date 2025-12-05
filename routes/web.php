<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UnitMobilController;
use Symfony\Component\HttpFoundation\Request;
use App\Http\Controllers\JenisMobilController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/verifikasi-pelanggan', function () {
    return view('admin.verifikasi-pelanggan');
})->middleware(['auth', 'verified'])->name('verifikasi-pelanggan');

Route::get('/order-summaries', function () {
    return view('order-summaries');
})->middleware(['auth', 'verified'])->name('order-summaries');

Route::get('/katalog', function (Request $request) {
    return view('layouts.katalog');
})->name('katalog');

Route::get('/checkout-form', function (Request $request){
    return view('layouts.checkout-form');
})->name('checkout-form');

Route::get('/search', [SearchController::class, 'index']);

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

