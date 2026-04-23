<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersetujuanController extends Controller
{
    public function index()
    {
        return view('persetujuan.index');
    }

    public function update(Request $request, $id)
    {
        // Logic untuk setuju/tolak nanti di sini
        return redirect()->route('persetujuan.index')->with('success', 'Status peminjaman berhasil diperbarui!');
    }
}