<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['barang', 'siswa'])->latest()->get();
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function persetujuan()
    {
        // Nama variabel WAJIB $peminjamans agar cocok dengan Blade
        $peminjamans = Peminjaman::with(['siswa', 'barang'])
                        ->where('status', 'Menunggu Persetujuan')
                        ->latest()
                        ->get();

        return view('admin.persetujuan.index', compact('peminjamans'));
    }

    public function update(Request $request, $id)
    {
        // Menggunakan findOrFail agar jika ID tidak ketemu langsung lari ke 404, bukan error crash
        $peminjaman = Peminjaman::findOrFail($id);
        
        $peminjaman->status = $request->status;
        $peminjaman->save();

        if ($request->status == 'Dipinjam' || $request->status == 'Kembali') {
            $barang = Barang::find($peminjaman->id_barang);
            if ($barang) {
                $barang->decrement('stok_tersedia', $peminjaman->jumlah_pinjam);
            }
        }

        return redirect()->route('persetujuan.index')->with('success', 'Status berhasil diperbarui!');
    }

    // Fungsi lainnya (riwayat, create, store) tetap sama seperti sebelumnya
    public function riwayat()
    {
        $riwayats = Peminjaman::where('id_siswa', Auth::user()->id_siswa)->with('barang')->latest()->get();
        return view('peminjaman.riwayat', compact('riwayats'));
    }

    public function create() {
        $barangs = Barang::where('stok_tersedia', '>', 0)->get();
        return view('peminjaman.create', compact('barangs'));
    }

    public function createTamu() {
        $barangs = Barang::where('stok_tersedia', '>', 0)->get();
        return view('peminjaman.create_tamu', compact('barangs'));
    }

    public function store(Request $request) {
        $request->validate([
            'id_barang' => 'required',
            'jumlah_pinjam' => 'required|numeric|min:1',
            'tgl_pinjam' => 'required|date',
        ]);
        $barang = Barang::findOrFail($request->id_barang);
        if ($barang->stok_tersedia < $request->jumlah_pinjam) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }
        Peminjaman::create([
            'id_siswa' => Auth::user()->id_siswa,
            'id_barang' => $request->id_barang,
            'jumlah_pinjam' => $request->jumlah_pinjam,
            'tgl_pinjam' => $request->tgl_pinjam ?? now(),
            'status' => 'Menunggu Persetujuan',
        ]);
        return redirect()->route('dashboard.siswa')->with('success', 'Peminjaman diajukan!');
    }

    public function storeTamu(Request $request) {
        $request->validate([
            'nama_peminjam' => 'required|string|max:100',
            'id_barang' => 'required',
            'jumlah_pinjam' => 'required|numeric|min:1',
            'tgl_kembali' => 'required|date|after_or_equal:today',
        ]);
        Peminjaman::create([
            'nama_tamu' => $request->nama_peminjam,
            'id_barang' => $request->id_barang,
            'jumlah_pinjam' => $request->jumlah_pinjam,
            'tgl_pinjam' => now(),
            'tgl_kembali' => $request->tgl_kembali,
            'status' => 'Menunggu Persetujuan',
            'catatan' => $request->catatan,
        ]);
        return redirect()->route('home')->with('success', 'Peminjaman tamu terkirim!');
    }
}