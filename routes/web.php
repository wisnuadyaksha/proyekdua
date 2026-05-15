<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\LaporanController;

// --- RUTE HALAMAN UTAMA & LOGIN ---
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// --- RUTE PEMINJAMAN TAMU (Tanpa Login) ---
// Ini yang tadi error karena method createTamu belum ada di Controller
Route::get('/peminjaman/tamu', [PeminjamanController::class, 'createTamu'])->name('peminjaman.tamu');
Route::post('/peminjaman/tamu', [PeminjamanController::class, 'storeTamu'])->name('peminjaman.storeTamu');


// --- RUTE KHUSUS ADMIN (Perlu Login & Role Admin) ---
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard.admin');

    Route::get('/persetujuan', [AdminController::class, 'indexPersetujuan'])->name('persetujuan.index');
    Route::put('/persetujuan/{id}/update', [AdminController::class, 'updateStatus'])->name('persetujuan.update');

    Route::get('/barang', [AdminController::class, 'indexBarang'])->name('barang.index');
    Route::get('/barang/create', [AdminController::class, 'createBarang'])->name('barang.create');
    Route::post('/barang', [AdminController::class, 'storeBarang'])->name('barang.store');
    Route::get('/barang/{id}/edit', [AdminController::class, 'editBarang'])->name('barang.edit');
    Route::put('/barang/{id}', [AdminController::class, 'updateBarang'])->name('barang.update');
    Route::delete('/barang/{id}', [AdminController::class, 'destroyBarang'])->name('barang.destroy');

    Route::get('/tamu', [AdminController::class, 'indexTamu'])->name('tamu.index');

    Route::get('/pengembalian', [AdminController::class, 'indexPengembalian'])->name('pengembalian.index');
    Route::put('/pengembalian/{id}', [AdminController::class, 'prosesPengembalian'])->name('pengembalian.proses');
    
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');


    // Manajemen Siswa (AdminController)
    Route::get('/siswa', [AdminController::class, 'indexSiswa'])->name('siswa.index');
    Route::get('/siswa/create', [AdminController::class, 'createSiswa'])->name('siswa.create');
    Route::post('/siswa', [AdminController::class, 'storeSiswa'])->name('siswa.store');
    Route::get('/siswa/{id}/edit', [AdminController::class, 'editSiswa'])->name('siswa.edit');
    Route::put('/siswa/{id}', [AdminController::class, 'updateSiswa'])->name('siswa.update');
    Route::delete('/siswa/{id}', [AdminController::class, 'destroySiswa'])->name('siswa.destroy');

    // Laporan (LaporanController)
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
});


// --- RUTE KHUSUS SISWA (Perlu Login & Role Siswa) ---
Route::middleware(['auth'])->prefix('siswa')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('siswa.dashboard');
    })->name('dashboard.siswa');

    // Rute peminjaman alat untuk siswa yang sudah login
    Route::get('/pinjam', [PeminjamanController::class, 'createSiswa'])->name('peminjaman.siswa');
    Route::post('/pinjam', [PeminjamanController::class, 'storeSiswa'])->name('peminjaman.siswa.store');
    // Rute untuk Tabel Riwayat (Riwayat)
    Route::get('/riwayat', [PeminjamanController::class, 'riwayatSiswa'])->name('peminjaman.riwayat');
});