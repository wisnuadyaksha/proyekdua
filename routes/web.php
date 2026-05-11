<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\User; // Menggunakan Model User untuk semua (Admin & Siswa)
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TamuController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/pinjam-tamu', [PeminjamanController::class, 'createTamu'])->name('peminjaman.tamu');
Route::post('/pinjam-tamu/store', [PeminjamanController::class, 'storeTamu'])->name('peminjaman.storeTamu');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Routes (Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::get('/siswa/dashboard', [DashboardController::class, 'siswa'])->name('dashboard.siswa');

    // Manajemen Barang
    Route::resource('barang', BarangController::class);

    // Peminjaman
    Route::get('/peminjaman/riwayat', [PeminjamanController::class, 'riwayat'])->name('peminjaman.riwayat');
    Route::resource('peminjaman', PeminjamanController::class);

    /*
    |--------------------------------------------------------------------------
    | Fitur Khusus Admin
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->group(function () {
        
        // Data Tamu
        Route::get('/tamu', [TamuController::class, 'index'])->name('tamu.index');

        // Persetujuan Peminjaman
        Route::get('/persetujuan', [PeminjamanController::class, 'persetujuan'])->name('persetujuan.index');
        Route::put('/persetujuan/{id}', [PeminjamanController::class, 'update'])->name('persetujuan.update');

        // Pengembalian & Laporan
        Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
        Route::post('/pengembalian/store', [PengembalianController::class, 'store'])->name('pengembalian.store');
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

        /* |--------------------------------------------------------------------------
        | Manajemen Siswa (CRUD menggunakan tabel Users)
        |--------------------------------------------------------------------------
        */
        
        // 1. Menampilkan Tabel Siswa (Filter user yang rolenya 'siswa')
        Route::get('/siswa-manajemen', function() {
            $users = User::where('role', 'siswa')->get();
            return view('admin.siswa.index', compact('users'));
        })->name('siswa.index');

        // 2. Menampilkan Form Tambah Siswa
        Route::get('/siswa-manajemen/tambah', function() {
            return view('admin.siswa.create');
        })->name('siswa.create');

        // 3. Proses Simpan Data Siswa Baru ke tabel 'users'
        Route::post('/siswa-manajemen/tambah', function(Request $request) {
            $request->validate([
                'name' => 'required',
                'nis'  => 'required|unique:users,nis',
                'class'=> 'required',
            ]);

            User::create([
                'name'     => $request->name,
                'nis'      => $request->nis,
                'class'    => $request->class,
                'email'    => $request->nis . '@siswa.com', // Buat email dummy otomatis
                'password' => bcrypt('password123'),        // Password default
                'role'     => 'siswa',
            ]);

            return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil disimpan!');
        })->name('siswa.store');

        // 4. Menampilkan Form Edit Siswa
        Route::get('/siswa-manajemen/{id}/edit', function($id) {
            $siswa = User::findOrFail($id);
            return view('admin.siswa.edit', compact('siswa'));
        })->name('siswa.edit');

        // 5. Proses Update Data Siswa
        Route::put('/siswa-manajemen/{id}', function(Request $request, $id) {
            $siswa = User::findOrFail($id);
            
            $request->validate([
                'name' => 'required',
                'nis'  => 'required|unique:users,nis,'.$id,
                'class'=> 'required',
            ]);

            $siswa->update([
                'name'  => $request->name,
                'nis'   => $request->nis,
                'class' => $request->class,
            ]);

            return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
        })->name('siswa.update');

        // 6. Proses Hapus Data Siswa
        Route::delete('/siswa-manajemen/{id}', function($id) {
            $siswa = User::findOrFail($id);
            $siswa->delete();

            return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus!');
        })->name('siswa.destroy');

    });
});