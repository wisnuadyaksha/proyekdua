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

        // Pastikan stok_tersedia tidak melebihi stok_total
        if ($barang->stok_tersedia > $barang->stok_total) {
            $barang->stok_tersedia = $barang->stok_total;
            $barang->save();
        }

        return redirect()->back()->with('success', 'Alat telah berhasil dikembalikan dan stok diperbarui!');
    }

    /**
     * Proses Pengembalian Massal (Semua alat sekaligus)
     */
    public function storeBulk(Request $request)
    {
        $ids = $request->id_peminjaman;
        if (!$ids) {
            return back()->with('error', 'Tidak ada data yang dipilih.');
        }

        foreach ($ids as $id) {
            $pinjaman = Peminjaman::find($id);
            if (!$pinjaman || $pinjaman->status !== 'Dipinjam') {
                continue;
            }

            $pinjaman->update([
                'status' => 'Kembali',
                'tgl_kembali' => now()
            ]);

            // Kembalikan stok
            $barang = Barang::find($pinjaman->id_barang);
            if ($barang) {
                $barang->increment('stok_tersedia', $pinjaman->jumlah_pinjam);
                if ($barang->stok_tersedia > $barang->stok_total) {
                    $barang->stok_tersedia = $barang->stok_total;
                    $barang->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Semua alat berhasil dikembalikan!');
    }
}