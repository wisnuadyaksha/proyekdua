<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::all(); 
        return view('admin.barang.index', compact('barangs'));
    }

    public function create()
    {
        return view('admin.barang.create');
    }

  public function store(Request $request)
{
    // Validasi sesuai kolom di image_1616da.jpg
    $request->validate([
        'nama_barang' => 'required|string|max:100',
        'spesifikasi' => 'nullable|string',
        'stok_total'  => 'required|numeric|min:1',
        'kategori'    => 'required|string|max:50',
        'foto_barang' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = $request->all();

    // Inisialisasi stok_tersedia sama dengan stok_total saat pertama kali input
    $data['stok_tersedia'] = $request->stok_total;

    if ($request->hasFile('foto_barang')) {
        // Simpan ke storage/app/public/alat
        $data['foto_barang'] = $request->file('foto_barang')->store('alat', 'public');
    }

    Barang::create($data);

    return redirect()->route('barang.index')->with('success', 'Alat berhasil ditambahkan!');
}

    // ... method lainnya tetap sama ...

    public function show($id)
    {
        // Menggunakan id_barang (sesuai primary key di database kamu biasanya)
        $barang = Barang::findOrFail($id);
        return view('admin.barang.show', compact('barang'));
    }

    public function edit($id)
{
    // Pastikan mencari berdasarkan id_barang jika itu primary key-nya
    $barang = Barang::where('id_barang', $id)->firstOrFail(); 
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