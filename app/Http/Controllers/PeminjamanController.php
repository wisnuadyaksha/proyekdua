<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    // 1. Fungsi untuk menampilkan halaman dashboard tamu (Opsional)
    public function indexTamu()
    {
        return view('peminjaman.tamu');
    }

    // 2. Fungsi untuk menampilkan FORMULIR pinjam buat TAMU
    public function createTamu()
    {
        // Pastikan kolomnya 'stok_total' atau sesuaikan dengan database lu
        $barangs = Barang::where('stok_total', '>', 0)->get();
        return view('peminjaman.create_tamu', compact('barangs'));
    }

    // 3. Fungsi untuk simpan data pinjam TAMU
    public function storeTamu(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'id_barang'     => 'required',
            'jumlah_pinjam' => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($request->id_barang);

        // Cek stok (sesuaikan nama kolom stok_total/stok_tersedia)
        if ($barang->stok_total < $request->jumlah_pinjam) {
            return back()->with('error', 'Stok barang tidak mencukupi!');
        }
        // Simpan ke database
           Peminjaman::create([
        'nama_tamu'     => $request->nama_peminjam,
        'id_barang'     => $request->id_barang,
        'jumlah_pinjam' => $request->jumlah_pinjam,
        'tgl_pinjam'    => now(),
        'status'        => 'Dipinjam',
        'catatan'       => "No. Telp: " . $request->no_telp . " | " . $request->catatan, // Simpan no telp ke catatan
    ]);

        // Kurangi stok barang
        $barang->decrement('stok_total', $request->jumlah_pinjam);

        return redirect()->route('login')->with('success', 'Peminjaman berhasil diajukan!');
    }
    

    // Form Pinjam untuk SISWA
    public function createSiswa()
    {
        // Mengambil barang yang stoknya tersedia
        $barangs = Barang::where('stok_total', '>', 0)->get();
        
        // Pastikan kamu punya file: resources/views/siswa/pinjam_alat.blade.php
        return view('peminjaman.create', compact('barangs'));
    }

    // Simpan Pinjam untuk SISWA
    public function storeSiswa(Request $request)
    {
        $request->validate([
            'id_barang'     => 'required|exists:barang,id_barang',
            'jumlah_pinjam' => 'required|integer|min:1',
        ]);

        $barang = Barang::findOrFail($request->id_barang);

        if ($barang->stok_total < $request->jumlah_pinjam) {
            return back()->with('error', 'Stok alat tidak mencukupi!');
        }

        Peminjaman::create([
    'id_siswa'      => auth()->id(), // Mengambil ID siswa yang sedang login
    'id_barang'     => $request->id_barang,
    'jumlah_pinjam' => $request->jumlah_pinjam,
    'tgl_pinjam'    => now(),
    'status'        => 'Menunggu Persetujuan',
    'nama_tamu'     => null, // Karena ini siswa, nama_tamu dikosongkan
    ]);

    
        
        return redirect()->route('dashboard.siswa')->with('success', 'Permintaan peminjaman berhasil dikirim!');
    }

    // ... (fungsi createTamu dan storeTamu kamu tetap biarkan di bawahnya)

    public function riwayatSiswa()
    {
        // Mengambil data peminjaman milik siswa yang sedang login
        $riwayats = Peminjaman::with('barang')
                    ->where('id_siswa', auth()->id())
                    ->latest()
                    ->get();

        // Pastikan variabel yang dikirim bernama 'riwayats'
        return view('peminjaman.riwayat', compact('riwayats'));
    }
} // Pastikan kurung kurawal penutup Class cuma ada SATU di paling bawah