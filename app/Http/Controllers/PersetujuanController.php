<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;

class PersetujuanController extends Controller
{
    public function index()
    {
        // Mengambil data pinjaman yang statusnya masih 'Dipinjam' (menunggu persetujuan)
        $peminjamans = Peminjaman::with(['barang', 'siswa'])->latest()->get();
        return view('admin.persetujuan.index', compact('peminjamans'));
    }

    public function update(Request $request, $id)
    {
        $pinjaman = Peminjaman::findOrFail($id);
        
        // Update status berdasarkan tombol yang diklik (Disetujui / Ditolak)
        $pinjaman->update([
            'status' => $request->status 
        ]);

        // Jika ditolak, kembalikan stok barang yang tadi sudah terpotong
        if ($request->status == 'Ditolak') {
            $barang = Barang::findOrFail($pinjaman->id_barang);
            $barang->increment('stok_tersedia', $pinjaman->jumlah_pinjam);

            // Pastikan stok_tersedia tidak melebihi stok_total
            if ($barang->stok_tersedia > $barang->stok_total) {
                $barang->stok_tersedia = $barang->stok_total;
                $barang->save();
            }
        }

        return redirect()->back()->with('success', 'Status peminjaman berhasil diperbarui!');
    }

    public function indexTamu()
    {
        return view('peminjaman.tamu');
    }

    public function createTamu()
    {
        $barangs = Barang::where('stok_total', '>', 0)->get();
        return view('peminjaman.create_tamu', compact('barangs'));
    }

    // SIMPAN PINJAM TAMU
    public function storeTamu(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'id_barang'     => 'required',
            'jumlah_pinjam' => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($request->id_barang);

        if ($barang->stok_tersedia < $request->jumlah_pinjam) {
            return back()->with('error', 'Stok barang tidak mencukupi!');
        }
}

}