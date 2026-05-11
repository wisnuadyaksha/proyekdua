<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman laporan dengan filter tanggal
     */
    public function index(Request $request)
    {
        // Query dasar dengan relasi
        $query = Peminjaman::with(['barang', 'siswa']);

        // Filter berdasarkan tanggal jika diinput
        if ($request->has('tgl_mulai') && $request->has('tgl_selesai')) {
            $query->whereBetween('tgl_pinjam', [$request->tgl_mulai, $request->tgl_selesai]);
        }

        $laporans = $query->latest()->get();

        // Statistik ringkas untuk dashboard laporan
        $total_pinjam = Peminjaman::count();
        $total_barang = Barang::sum('stok_total');

        return view('admin.laporan.index', compact('laporans', 'total_pinjam', 'total_barang'));
    }
}