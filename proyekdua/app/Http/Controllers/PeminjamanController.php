<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    // Menampilkan riwayat peminjaman
    public function index()
    {
        return view('peminjaman.index');
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