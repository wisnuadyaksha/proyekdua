<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin() {
        return view('dashboard.admin'); // Merujuk ke dashboard/admin.blade.php
    }

    public function siswa() {
        return view('dashboard.siswa'); // Merujuk ke dashboard/siswa.blade.php
    }

    public function tamu() {
        return view('dashboard.tamu'); // Merujuk ke dashboard/tamu.blade.php
    }
}