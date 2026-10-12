<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\CartController;

Route::get('/index', [TokoController::class, 'index'])
    ->name('barang.index');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'tampilLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);
});

Route::get('/', [CartController::class, 'index'])
    ->name('shop');

Route::post('/cart/add', [CartController::class, 'add'])
    ->name('cart.add');

Route::post('/cart/update', [CartController::class, 'update'])
    ->name('cart.update');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/keranjang', [TokoController::class, 'keranjang'])
        ->name('keranjang.index');

    Route::post('/keranjang/tambah/{id}', [TokoController::class, 'tambah'])
        ->name('keranjang.tambah');

    Route::post('/keranjang/kurang/{id}', [TokoController::class, 'kurang'])
        ->name('keranjang.kurang');

    Route::post('/keranjang/hapus/{id}', [TokoController::class, 'hapus'])
        ->name('keranjang.hapus');

    Route::post('/keranjang/kosongkan', [TokoController::class, 'kosongkan'])
        ->name('keranjang.kosongkan');
    
    Route::post('/checkout', [CheckoutController::class, 'checkout'])
    ->name('checkout'); 
    
    Route::get('/riwayat', [RiwayatController::class, 'index'])
    ->name('riwayat.index');
    
});