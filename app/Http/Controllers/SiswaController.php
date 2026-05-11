<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Menampilkan Dashboard Siswa dengan daftar alat.
     */
    public function index()
    {
        // Menggunakan data array (dummy) agar tidak perlu akses database dulu
        $alats = [
            [
                'id' => 1,
                'nama_alat' => 'Solder Listrik 60W',
                'deskripsi' => 'Alat pemanas untuk menyambung komponen elektronika.',
                'foto' => 'solder.png', // Pastikan file ini ada di public/images/alat/
                'status' => 'Tersedia'
            ],
            [
                'id' => 2,
                'nama_alat' => 'Multimeter Digital',
                'deskripsi' => 'Alat ukur tegangan, arus, dan hambatan listrik.',
                'foto' => 'multimeter.png',
                'status' => 'Tersedia'
            ],
            [
                'id' => 3,
                'nama_alat' => 'Tang Potong',
                'deskripsi' => 'Digunakan untuk memotong kabel atau kaki komponen.',
                'foto' => 'tang.png',
                'status' => 'Dipinjam'
            ],
            [
                'id' => 4,
                'nama_alat' => 'Breadboard',
                'deskripsi' => 'Papan proyek untuk merangkai sirkuit sementara.',
                'foto' => 'breadboard.png',
                'status' => 'Tersedia'
            ]
        ];

        // Mengirimkan data $alats ke view siswa/dashboard.blade.php
        return view('siswa.dashboard', compact('alats'));
    }

    /**
     * Contoh fungsi untuk melihat detail alat (jika diperlukan nanti)
     */
    public function detailAlat($id)
    {
        return "Detail alat dengan ID: " . $id;
    }
}