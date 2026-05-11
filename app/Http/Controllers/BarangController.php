<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        // Variabel diganti jadi $barangs supaya cocok dengan file Blade kamu
        $barangs = Barang::all(); 
        
        return view('admin.barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('admin.barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:100',
            'spesifikasi' => 'nullable|string',
            'stok_total'  => 'required|numeric|min:0',
            'kategori'    => 'required|string|max:50',
            'foto_barang' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        // Stok tersedia otomatis sama dengan stok total saat input awal
        $data['stok_tersedia'] = $request->stok_total;

        if ($request->hasFile('foto_barang')) {
            $data['foto_barang'] = $request->file('foto_barang')->store('alat', 'public');
        }

        Barang::create($data);

        return redirect()->route('barang.index')->with('success', 'Alat berhasil ditambahkan!');
    }

    public function show($id)
    {
        // Menggunakan id_barang (sesuai primary key di database kamu biasanya)
        $barang = Barang::findOrFail($id);
        return view('admin.barang.show', compact('barang'));
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id); 
        return view('admin.barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'nama_barang' => 'required|string|max:100',
            'stok_total'  => 'required|numeric|min:0',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto_barang')) {
            // Hapus foto lama jika ada
            if ($barang->foto_barang) {
                Storage::disk('public')->delete($barang->foto_barang);
            }
            $data['foto_barang'] = $request->file('foto_barang')->store('alat', 'public');
        }

        $barang->update($data);

        return redirect()->route('barang.index')->with('success', 'Data alat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        // Hapus file fisik dari storage
        if ($barang->foto_barang) {
            Storage::disk('public')->delete($barang->foto_barang);
        }

        $barang->delete();

        return redirect()->route('barang.index')->with('success', 'Alat berhasil dihapus!');
    }
}