<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\Http\Request;

class TamuController extends Controller
{
    // Menampilkan form buku tamu (Bisa diakses siapa saja/Public)
    public function create()
    {
        return view('peminjaman.tamu');
    }

    // Menyimpan data tamu
    public function store(Request $request)
    {
        $request->validate([
            'nama_tamu' => 'required|string|max:100',
            'instansi'  => 'required|string|max:100',
            'keperluan' => 'required|string',
            'telepon'   => 'required|numeric',
        ]);

        Tamu::create([
            'nama_tamu'     => $request->nama_tamu,
            'instansi'      => $request->instansi,
            'keperluan'     => $request->keperluan,
            'telepon'       => $request->telepon,
            'tgl_kunjungan' => now(),
        ]);

        return redirect()->route('home')->with('success', 'Terima kasih telah mengisi buku tamu!');
    }

    // --- BAGIAN YANG DIPERBAIKI ---
    public function index()
    {
        // Ambil data tamu terbaru
        $tamus = Tamu::latest()->get();
        
        // Sesuaikan path view-nya: 'admin.tamu.index'
        return view('admin.tamu.index', compact('tamus'));
    }
}