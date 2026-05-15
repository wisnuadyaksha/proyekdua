<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// WAJIB TAMBAHKAN BARIS DI BAWAH INI
use Illuminate\Support\Facades\Auth; 

class DashboardController extends Controller
{
    public function admin()
    {
        // Sesuaikan jika filenya ada di resources/views/dashboard/admin.blade.php
        return view('admin.dashboard');
    }

    public function siswa()
    
    {
        // Sekarang Auth sudah dikenal karena sudah di-import di atas
        $user = Auth::user();
        
        // Memanggil file resources/views/siswa/dashboard.blade.php
        return view('siswa.dashboard', compact('user'));
    }
}