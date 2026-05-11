<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin.dashboard'); // Pastikan file resources/views/admin/dashboard.blade.php ADA
    }

    public function siswa()
    {
        // Ambil data user yang sedang login untuk ditampilkan di dashboard
        $user = Auth::user();
        
        // Pastikan folder 'resources/views/siswa/' ada filenya 'dashboard.blade.php'
        return view('siswa.dashboard', compact('user'));
    }
}