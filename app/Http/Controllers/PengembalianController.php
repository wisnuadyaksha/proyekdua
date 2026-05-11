<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    /**
     * Menampilkan daftar alat yang sedang dipinjam (untuk Admin)
     */
    public function index()
    {
        $pinjamans = Peminjaman::with(['barang', 'siswa'])
                                ->where('status', 'Dipinjam')
                                ->get();
        return view('admin.pengembalian.index', compact('pinjamans'));
    }

    /**
     * Proses Pengembalian Alat
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pinjam' => 'required'
        ]);

        // 1. Cari data peminjaman
        $pinjaman = Peminjaman::findOrFail($request->id_pinjam);

        // 2. Update status jadi Kembali
        $pinjaman->update([
            'status' => 'Kembali',
            'tgl_kembali' => now() // Mencatat tanggal asli pengembalian
        ]);

        // 3. Tambahkan kembali stok_tersedia di tabel barang
        $barang = Barang::findOrFail($pinjaman->id_barang);
        $barang->increment('stok_tersedia', $pinjaman->jumlah_pinjam);

        return redirect()->back()->with('success', 'Alat telah berhasil dikembalikan dan stok diperbarui!');
    }
}