<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        // Menampilkan daftar alat yang sedang dipinjam (status: dipinjam)
        return view('pengembalian.index');
    }

    public function store(Request $request)
    {
        // Logic untuk mencatat pengembalian dan cek kondisi
        return redirect()->route('pengembalian.index')->with('success', 'Alat berhasil dikembalikan!');
    }
}