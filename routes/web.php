<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\LaporanController;

// Halaman depan
Route::get('/', function () {
    return view('welcome');
});

// Route Dashboard untuk 3 User
Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('dashboard.admin');
Route::get('/siswa/dashboard', [DashboardController::class, 'siswa'])->name('dashboard.siswa');
Route::get('/tamu/dashboard', [DashboardController::class, 'tamu'])->name('dashboard.tamu');

// Route untuk fitur Barang (CRUD dasar)
Route::resource('barang', BarangController::class);

// Route untuk Tamu (sesuai struktur folder kamu)
Route::get('/tamu/form', [TamuController::class, 'create'])->name('tamu.create');

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::resource('peminjaman', PeminjamanController::class);
Route::get('/admin/persetujuan', [PersetujuanController::class, 'index'])->name('persetujuan.index');
Route::put('/admin/persetujuan/{id}', [PersetujuanController::class, 'update'])->name('persetujuan.update');
Route::get('/admin/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
Route::post('/admin/pengembalian/store', [PengembalianController::class, 'store'])->name('pengembalian.store');
Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('laporan.index');