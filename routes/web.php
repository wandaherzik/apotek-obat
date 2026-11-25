<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Master\KategoriObatController;
use App\Http\Controllers\Master\ObatController;
use App\Http\Controllers\Master\KonversiSatuanController;
use App\Http\Controllers\Inventory\RestokController;
use App\Http\Controllers\Transaction\TransaksiController;
use App\Http\Controllers\Report\LaporanController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Master\SatuanController;
use App\Http\Controllers\Inventory\BatchObatController;
use App\Http\Controllers\Master\UserController;

Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
});

Route::middleware('auth')->group(function () {
    Route::resource('user', UserController::class);

    Route::get('/dashboard',[DashboardController::class,'index'])
        ->name('dashboard');

    Route::post('/logout',[AuthController::class,'logout'])
        ->name('logout');
Route::get(
    '/transaksi/{id}/sukses',
    [TransaksiController::class,'sukses']
)->name('transaksi.sukses');

Route::get(
    '/transaksi/{id}/cetak',
    [TransaksiController::class,'cetak']
)->name('transaksi.cetak');

Route::get(
    '/laporan/penjualan',
    [LaporanController::class,'penjualan']
)->name('laporan.penjualan');
Route::get(
    '/laporan/penjualan/pdf',
    [LaporanController::class,'exportPdf']
)->name('laporan.penjualan.pdf');

Route::resource('user', UserController::class);
Route::resource('laporan', LaporanController::class);
    Route::resource('kategori-obat',KategoriObatController::class);

    Route::resource('satuan',SatuanController::class);

    Route::resource('obat',ObatController::class);

    Route::resource('konversi-satuan',KonversiSatuanController::class);

    Route::resource('batch-obat',BatchObatController::class);

    Route::resource('restok',RestokController::class);

    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/transaksi/cari-obat',
        [TransaksiController::class,'cariObat']
    )->name('transaksi.cariObat');

    Route::get(
        '/transaksi/riwayat',
        [TransaksiController::class,'riwayat']
    )->name('transaksi.riwayat');

    Route::resource('transaksi', TransaksiController::class);

});




Route::get('/laporan/penjualan', [LaporanController::class, 'penjualan']);
Route::get('/laporan/laba', [LaporanController::class, 'laba']);
Route::get('/laporan/pdf', [LaporanController::class, 'exportPdf']);