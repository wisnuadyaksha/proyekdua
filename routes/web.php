<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\LaporanController;

// --- HALAMAN UTAMA (HOME) ---
// Ini akan memanggil file welcome.blade.php yang baru kita buat
Route::get('/', function () {
    return view('welcome');
})->name('home');

// --- LOGIN ---
// Rute login diubah ke URL '/login' agar tidak bentrok dengan Home
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']); // Pastikan ada rute POST untuk proses login

// --- DASHBOARD ---
Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('dashboard.admin');
Route::get('/siswa/dashboard', [DashboardController::class, 'siswa'])->name('dashboard.siswa');
Route::get('/tamu/dashboard', [DashboardController::class, 'tamu'])->name('dashboard.tamu');

// --- FITUR PEMINJAMAN (SOLUSI ERROR BARIS 5 & 6) ---
// Ini untuk peminjaman.create
Route::resource('peminjaman', PeminjamanController::class);

// Ini untuk peminjaman.riwayat (WAJIB ADA INI)
Route::get('/peminjaman-riwayat', [PeminjamanController::class, 'riwayat'])->name('peminjaman.riwayat');

// --- FITUR LAINNYA ---
Route::resource('barang', BarangController::class);
Route::get('/tamu/form', [TamuController::class, 'create'])->name('tamu.create');

// --- ADMIN FEATURES ---
Route::get('/admin/persetujuan', [PersetujuanController::class, 'index'])->name('persetujuan.index');
Route::put('/admin/persetujuan/{id}', [PersetujuanController::class, 'update'])->name('persetujuan.update');
Route::get('/admin/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
Route::post('/admin/pengembalian/store', [PengembalianController::class, 'store'])->name('pengembalian.store');
Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('laporan.index');