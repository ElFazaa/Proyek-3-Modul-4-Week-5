<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeranjangController;

Route::get('/', function () {
    return redirect('/index');
});

Route::get('/index', [KeranjangController::class, 'index'])
    ->name('barang.index');

Route::get('/keranjang', [KeranjangController::class, 'keranjang'])
    ->name('keranjang.index');

Route::post('/keranjang/tambah/{id}', [KeranjangController::class, 'tambah'])
    ->name('keranjang.tambah');

Route::post('/keranjang/kurang/{id}', [KeranjangController::class, 'kurang'])
    ->name('keranjang.kurang');

Route::post('/keranjang/hapus/{id}', [KeranjangController::class, 'hapus'])
    ->name('keranjang.hapus');

Route::post('/keranjang/kosongkan', [KeranjangController::class, 'kosongkan'])
    ->name('keranjang.kosongkan');