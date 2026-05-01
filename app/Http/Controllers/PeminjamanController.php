<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    // Menampilkan daftar peminjaman (Bisa juga jadi halaman riwayat)
    public function index()
    {
        return view('peminjaman.index');
    }

    // --- INI YANG KURANG DAN HARUS DITAMBAHKAN ---
    public function riwayat()
    {
        // Pastikan kamu punya file resources/views/peminjaman/riwayat.blade.php
        // Kalau belum ada filenya, sementara bisa return teks dulu:
        // return "Ini Halaman Riwayat";
        
        return view('peminjaman.riwayat');
    }

    // Menampilkan form peminjaman baru
    public function create()
    {
        return view('peminjaman.create');
    }

    // Menyimpan data peminjaman
    public function store(Request $request)
    {
        // Simulasi berhasil pinjam
        return redirect()->route('peminjaman.index')->with('success', 'Pengajuan peminjaman berhasil dikirim!');
    }
}