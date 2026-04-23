<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Menampilkan daftar alat (Halaman Index)
     */
    public function index()
    {
        // Nantinya kita ambil data dari database di sini
        return view('barang.index');
    }

    /**
     * Menampilkan form tambah alat (Halaman Create)
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Menyimpan data alat baru
     */
    public function store(Request $request)
    {
        // Sementara kita buat redirect balik ke index dulu
        // Nanti kalau sudah ada database, logic simpan taruh di sini
        return redirect()->route('barang.index')->with('success', 'Alat berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail alat
     */
    public function show($id)
    {
        return view('barang.detail');
    }

    /**
     * Menampilkan form edit alat
     */
    public function edit($id)
    {
        return view('barang.edit');
    }

    /**
     * Memperbarui data alat
     */
    public function update(Request $request, $id)
    {
        return redirect()->route('barang.index')->with('success', 'Data alat berhasil diupdate!');
    }

    /**
     * Menghapus data alat
     */
    public function destroy($id)
    {
        return redirect()->route('barang.index')->with('success', 'Alat berhasil dihapus!');
    }
}