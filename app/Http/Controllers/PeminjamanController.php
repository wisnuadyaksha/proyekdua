<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use App\Models\Tamu;
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
        $barangs = Barang::where('stok_tersedia', '>', 0)->get();
        return view('peminjaman.create_tamu', compact('barangs'));
    }

    // 3. Fungsi untuk simpan data pinjam TAMU
    public function storeTamu(Request $request)
    {
        $request->validate([
            'nama_peminjam'   => 'required|string|max:255',
            'jurusan'         => 'required|string|max:255',
            'no_telp'         => 'required|numeric',
            'id_barang'       => 'required|array',
            'id_barang.*'     => 'required|exists:barang,id_barang',
            'jumlah_pinjam'   => 'required|array',
            'jumlah_pinjam.*' => 'required|integer|min:1',
            'foto_ktp'        => 'required|image|mimes:jpeg,png,jpg|max:2048', // Wajib upload foto KTP max 2MB
            'catatan'         => 'required|string',
        ]);

        // Cek stok semua barang terlebih dahulu
        foreach ($request->id_barang as $index => $id_barang) {
            $barang = Barang::findOrFail($id_barang);
            $qty = $request->jumlah_pinjam[$index];
            if ($barang->stok_tersedia < $qty) {
                return back()->with('error', "Stok alat {$barang->nama_barang} tidak mencukupi!");
            }
        }

        // Proses Upload Foto KTP (Hanya 1 KTP per sesi tamu)
        $fotoKtpPath = null;
        if ($request->hasFile('foto_ktp')) {
            $file = $request->file('foto_ktp');
            $fileName = time() . '_ktp_' . $file->getClientOriginalName();
            $file->move(public_path('img/ktp'), $fileName);
            $fotoKtpPath = 'ktp/' . $fileName;
        }

        // Ambil nama barang untuk keperluan Tamu
        $namaAlatList = [];
        foreach ($request->id_barang as $id_barang) {
            $namaAlatList[] = Barang::findOrFail($id_barang)->nama_barang;
        }
        $alatStr = implode(", ", $namaAlatList);

        // Otomatis catat juga ke Buku Tamu
        Tamu::create([
            'nama_tamu'     => $request->nama_peminjam,
            'instansi'      => $request->jurusan,
            'keperluan'     => "Meminjam alat: " . $alatStr . ($request->catatan ? " | " . $request->catatan : ""),
            'telepon'       => $request->no_telp,
            'tgl_kunjungan' => now(),
        ]);

        // Simpan semua peminjaman
        foreach ($request->id_barang as $index => $id_barang) {
            Peminjaman::create([
                'nama_tamu'     => $request->nama_peminjam,
                'id_barang'     => $id_barang,
                'jumlah_pinjam' => $request->jumlah_pinjam[$index],
                'tgl_pinjam'    => now(),
                'tgl_kembali'   => $request->tgl_kembali, // Simpan tanggal kembali
                'status'        => 'Menunggu Persetujuan',
                'catatan'       => "No. Telp: " . $request->no_telp . " | " . $request->catatan,
                'foto_ktp'      => $fotoKtpPath,
            ]);
        }

        return redirect()->route('home')->with('success', 'Peminjaman berhasil diajukan! Harap tunggu persetujuan dari Admin.');
    }
    

    // Form Pinjam untuk SISWA
    public function createSiswa()
    {
        // Mengambil barang yang stoknya tersedia
        $barangs = Barang::where('stok_tersedia', '>', 0)->get();
        
        // Pastikan kamu punya file: resources/views/siswa/pinjam_alat.blade.php
        return view('peminjaman.create', compact('barangs'));
    }

    public function storeSiswa(Request $request)
    {
        $request->validate([
            'id_barang'       => 'required|array',
            'id_barang.*'     => 'required|exists:barang,id_barang',
            'jumlah_pinjam'   => 'required|array',
            'jumlah_pinjam.*' => 'required|integer|min:1',
            'catatan'         => 'required|string',
        ]);

        // Cek stok semua barang terlebih dahulu
        foreach ($request->id_barang as $index => $id_barang) {
            $barang = Barang::findOrFail($id_barang);
            $qty = $request->jumlah_pinjam[$index];
            if ($barang->stok_tersedia < $qty) {
                return back()->with('error', "Stok alat {$barang->nama_barang} tidak mencukupi!");
            }
        }

        // Simpan semua peminjaman
        foreach ($request->id_barang as $index => $id_barang) {
            Peminjaman::create([
                'id_siswa'      => auth()->id(),
                'id_barang'     => $id_barang,
                'jumlah_pinjam' => $request->jumlah_pinjam[$index],
                'tgl_pinjam'    => $request->tgl_pinjam ?? now(),
                'tgl_kembali'   => $request->tgl_kembali,
                'status'        => 'Menunggu Persetujuan',
                'nama_tamu'     => null,
                'catatan'       => $request->catatan,
            ]);
        }

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

        return view('peminjaman.riwayat', compact('riwayats'));
    }

    // Form Pinjam untuk GURU
    public function createGuru()
    {
        $barangs = Barang::where('stok_tersedia', '>', 0)->get();
        return view('peminjaman.create', compact('barangs'));
    }

    // Simpan Pinjam untuk GURU
    public function storeGuru(Request $request)
    {
        $request->validate([
            'id_barang'       => 'required|array',
            'id_barang.*'     => 'required|exists:barang,id_barang',
            'jumlah_pinjam'   => 'required|array',
            'jumlah_pinjam.*' => 'required|integer|min:1',
            'catatan'         => 'required|string',
        ]);

        // Cek stok semua barang terlebih dahulu
        foreach ($request->id_barang as $index => $id_barang) {
            $barang = Barang::findOrFail($id_barang);
            $qty = $request->jumlah_pinjam[$index];
            if ($barang->stok_tersedia < $qty) {
                return back()->with('error', "Stok alat {$barang->nama_barang} tidak mencukupi!");
            }
        }

        // Simpan semua peminjaman
        foreach ($request->id_barang as $index => $id_barang) {
            Peminjaman::create([
                'id_siswa'      => auth()->id(),
                'id_barang'     => $id_barang,
                'jumlah_pinjam' => $request->jumlah_pinjam[$index],
                'tgl_pinjam'    => $request->tgl_pinjam ?? now(),
                'tgl_kembali'   => $request->tgl_kembali,
                'status'        => 'Menunggu Persetujuan',
                'nama_tamu'     => null,
                'catatan'       => $request->catatan,
            ]);
        }

        return redirect()->route('dashboard.guru')->with('success', 'Permintaan peminjaman berhasil dikirim!');
    }

    // Riwayat peminjaman guru
    public function riwayatGuru()
    {
        $riwayats = Peminjaman::with('barang')
                    ->where('id_siswa', auth()->id())
                    ->latest()
                    ->get();

        return view('peminjaman.riwayat', compact('riwayats'));
    }
}