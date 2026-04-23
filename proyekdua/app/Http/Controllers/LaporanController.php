<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        // Menampilkan data alat rusak/hilang yang butuh ganti rugi
        return view('laporan.index');
    }
}