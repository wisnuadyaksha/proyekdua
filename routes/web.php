<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;

// --- RUTE HALAMAN UTAMA & LOGIN ---
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// --- RUTE REGISTER ---
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// --- RUTE LUPA SANDI ---
Route::get('/forgot-password', [LoginController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [LoginController::class, 'resetPassword'])->name('password.update');

// --- RUTE PROFIL ---
Route::post('/profile/update-foto', [ProfileController::class, 'updateFoto'])->name('profile.foto.update')->middleware('auth');
Route::post('/profile/update-biodata', [ProfileController::class, 'updateProfile'])->name('profile.biodata.update')->middleware('auth');


// --- RUTE PEMINJAMAN TAMU (Tanpa Login) ---
Route::get('/peminjaman/tamu', [PeminjamanController::class, 'createTamu'])->name('peminjaman.tamu');
Route::post('/peminjaman/tamu', [PeminjamanController::class, 'storeTamu'])->name('peminjaman.storeTamu');


// --- RUTE KHUSUS ADMIN (Perlu Login & Role Admin) ---
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard.admin');

    Route::get('/persetujuan', [AdminController::class, 'indexPersetujuan'])->name('persetujuan.index');
    Route::post('/persetujuan/update-bulk', [AdminController::class, 'updateStatusBulk'])->name('persetujuan.update_bulk');
    Route::put('/persetujuan/{id}/update', [AdminController::class, 'updateStatus'])->name('persetujuan.update');

    Route::get('/barang', [AdminController::class, 'indexBarang'])->name('barang.index');
    Route::get('/barang/create', [AdminController::class, 'createBarang'])->name('barang.create');
    Route::post('/barang', [AdminController::class, 'storeBarang'])->name('barang.store');
    Route::get('/barang/{id}/edit', [AdminController::class, 'editBarang'])->name('barang.edit');
    Route::put('/barang/{id}', [AdminController::class, 'updateBarang'])->name('barang.update');
    Route::delete('/barang/{id}', [AdminController::class, 'destroyBarang'])->name('barang.destroy');

    Route::get('/tamu', [AdminController::class, 'indexTamu'])->name('tamu.index');

    Route::get('/pengembalian', [AdminController::class, 'indexPengembalian'])->name('pengembalian.index');
    Route::post('/pengembalian/proses-bulk', [AdminController::class, 'prosesPengembalianBulk'])->name('pengembalian.proses_bulk');
    Route::put('/pengembalian/{id}', [AdminController::class, 'prosesPengembalian'])->name('pengembalian.proses');
    
    // --- RUTE LAPORAN ADMIN ---
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export', [LaporanController::class, 'exportCsv'])->name('laporan.export');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');

    // Manajemen Siswa (AdminController)
    Route::get('/siswa', [AdminController::class, 'indexSiswa'])->name('siswa.index');
    Route::get('/siswa/create', [AdminController::class, 'createSiswa'])->name('siswa.create');
    Route::post('/siswa', [AdminController::class, 'storeSiswa'])->name('siswa.store');
    Route::get('/siswa/{id}/edit', [AdminController::class, 'editSiswa'])->name('siswa.edit');
    Route::put('/siswa/{id}', [AdminController::class, 'updateSiswa'])->name('siswa.update');
    Route::delete('/siswa/{id}', [AdminController::class, 'destroySiswa'])->name('siswa.destroy');
});


// --- RUTE KHUSUS SISWA (Perlu Login & Role Siswa) ---
Route::middleware(['auth'])->prefix('siswa')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('siswa.dashboard');
    })->name('dashboard.siswa');

    Route::get('/pinjam', [PeminjamanController::class, 'createSiswa'])->name('peminjaman.siswa');
    Route::post('/pinjam', [PeminjamanController::class, 'storeSiswa'])->name('peminjaman.siswa.store');
    Route::get('/riwayat', [PeminjamanController::class, 'riwayatSiswa'])->name('peminjaman.riwayat');
});


// --- RUTE KHUSUS GURU (Perlu Login & Role Guru) ---
Route::middleware(['auth'])->prefix('guru')->group(function () {
    
    // Halaman notifikasi verifikasi email (bisa diakses meski belum verified)
    Route::get('/dashboard', function () {
        return view('guru.dashboard');
    })->name('dashboard.guru')->middleware('verified');

    Route::get('/pinjam', [PeminjamanController::class, 'createGuru'])->name('peminjaman.guru')->middleware('verified');
    Route::post('/pinjam', [PeminjamanController::class, 'storeGuru'])->name('peminjaman.guru.store')->middleware('verified');
    Route::get('/riwayat', [PeminjamanController::class, 'riwayatGuru'])->name('peminjaman.riwayat.guru')->middleware('verified');
});

// --- RUTE VERIFIKASI EMAIL ---
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('dashboard.guru')->with('success', 'Email berhasil diverifikasi! Selamat datang, ' . auth()->user()->name . '!');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (\Illuminate\Http\Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('resent', 'Link verifikasi baru sudah dikirim ke email Anda!');
    })->middleware('throttle:6,1')->name('verification.send');
});