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
        }

        return redirect()->back()->with('success', 'Status peminjaman berhasil diperbarui!');
    }
}