<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman; // WAJIB ADA
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function indexSiswa()
    {
        // Menampilkan semua user yang memiliki NIS (termasuk Admin jika ada NIS-nya)
        $users = User::whereNotNull('nis')->get(); 
        return view('admin.siswa.index', compact('users'));
    }

    public function createSiswa()
    {
        return view('admin.siswa.create');
    }

    public function storeSiswa(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nis'  => 'required|unique:users,nis',
            'class'=> 'required',
        ]);

        User::create([
            'name'     => $request->name,
            'nis'      => $request->nis,
            'class'    => $request->class,
            'email'    => $request->nis . '@siswa.com',
            'password' => bcrypt('password123'),
            'role'     => 'siswa',
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil disimpan!');
    }

    public function editSiswa($id)
    {
        // Menggunakan variabel $siswa agar cocok dengan form di edit.blade.php
        $siswa = User::findOrFail($id);
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function updateSiswa(Request $request, $id)
    {
        $siswa = User::findOrFail($id);
        
        $request->validate([
            'name' => 'required',
            'nis'  => 'required|unique:users,nis,'.$id,
            'class'=> 'required',
        ]);

        // Mengupdate kolom name dan class sesuai struktur tabel users
        $siswa->update([
            'name'  => $request->name,
            'nis'   => $request->nis,
            'class' => $request->class,
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroySiswa($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }

   public function indexPersetujuan()
{
    // Cari data yang statusnya masih menunggu konfirmasi admin
   $pinjamans = Peminjaman::with(['siswa', 'barang'])
            ->where('status', 'like', '%Menunggu%') // Pakai LIKE agar lebih aman
            ->latest()
            ->get();
    return view('persetujuan.index', compact('pinjamans'));
}

        // Menampilkan daftar barang
    public function indexBarang() {
        $barangs = Barang::all(); 
        return view('admin.barang.index', compact('barangs'));
    }

    // Menampilkan form tambah
    public function createBarang() {
        return view('admin.barang.create');
    }

    // Menyimpan barang baru
    public function storeBarang(Request $request) {
        $request->validate([
            'nama_barang' => 'required',
            'stok_total'  => 'required|integer|min:0',
        ]);

        Barang::create([
        'nama_barang'   => $request->nama_barang,
        'stok_total'    => $request->stok_total,
        'stok_tersedia' => $request->stok_total, // TAMBAHKAN BARIS INI
    ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambah!');
    }

    // Menampilkan form edit
    public function editBarang($id) {
        $barang = Barang::findOrFail($id);
        return view('admin.barang.edit', compact('barang'));
    }

    // Mengupdate data barang
    public function updateBarang(Request $request, $id) {
        $barang = Barang::findOrFail($id);
        $barang->update($request->all());
        return redirect()->route('barang.index')->with('success', 'Data barang diperbarui!');
    }

    // Menghapus barang
    public function destroyBarang($id) {
        Barang::findOrFail($id)->delete();
        return redirect()->route('barang.index')->with('success', 'Barang dihapus!');
    }

    public function indexTamu()
{
    // Mengambil data peminjaman yang peminjamnya adalah TAMU (nama_tamu tidak null)
    $tamus = Peminjaman::with('barang')
                ->whereNotNull('nama_tamu')
                ->latest()
                ->get();

    return view('admin.tamu.index', compact('tamus'));
}

   public function prosesPengembalian($id)
    {
        // PERBAIKAN: Gunakan $peminjaman (tanpa 's') agar konsisten ke bawah
        $peminjaman = Peminjaman::findOrFail($id); 
        $barang = Barang::findOrFail($peminjaman->id_barang);

        // Menambah stok saat barang dikembalikan
        $barang->increment('stok_total', $peminjaman->jumlah_pinjam);

        $peminjaman->update([ 
            'status' => 'Dikembalikan',
            'tgl_kembali' => now() 
        ]);

        return back()->with('success', 'Barang telah berhasil dikembalikan!');
    }

   public function updateStatus(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        if ($request->status == 'Dipinjam') {
            $barang = Barang::findOrFail($peminjaman->id_barang);
            
            // PERBAIKAN: Kurangi stok di kedua kolom (total & tersedia) agar sisa barang berkurang
            $barang->decrement('stok_total', $peminjaman->jumlah_pinjam);
            $barang->decrement('stok_tersedia', $peminjaman->jumlah_pinjam);
        }

        $peminjaman->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status berhasil diubah menjadi ' . $request->status);
    }
    // Tambahkan method ini di dalam AdminController
    public function indexPengembalian()
    {
        // Mengambil data yang statusnya masih 'Dipinjam'
        $pinjamans = Peminjaman::with(['siswa', 'barang'])
                    ->where('status', 'Dipinjam')
                    ->latest()
                    ->get();
        
        // Pastikan Anda sudah membuat folder admin/pengembalian dan file index.blade.php
        return view('admin.pengembalian.index', compact('pinjamans')); 
    }

    }

