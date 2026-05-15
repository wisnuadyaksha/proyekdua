<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman laporan dengan relasi yang diperbaiki.
     */
    public function index(Request $request)
    {
        // PERBAIKAN: Memastikan relasi 'siswa' dan 'barang' dipanggil agar nama tidak kosong
        $query = Peminjaman::with(['siswa', 'barang']);

        // Filter berdasarkan tanggal jika ada input dari user
        if ($request->filled('tgl_mulai') && $request->filled('tgl_selesai')) {
            $query->whereBetween('tgl_pinjam', [$request->tgl_mulai, $request->tgl_selesai]);
        }

        $laporans = $query->latest()->get();

        // Statistik tambahan untuk laporan
        $total_pinjam = Peminjaman::count();
        $total_barang = Barang::sum('stok_total');

        return view('admin.laporan.index', compact('laporans', 'total_pinjam', 'total_barang'));
    }
}