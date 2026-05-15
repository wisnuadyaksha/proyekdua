@extends('layouts.app')

@section('sidebar-menu')
    <li class="nav-item">
        <a class="nav-link active-link" href="{{ route('dashboard.siswa') }}">
            <i class="fa-solid fa-gauge me-2"></i> Dashboard Siswa
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fa-solid fa-toolbox me-2"></i> Pinjam Alat
        </a>
    </li>
@endsection

@section('content')
<div class="container mt-4">
    <div class="alert alert-primary shadow-sm">
        <h4>Halo, {{ Auth::user()->name }}!</h4>
        <p>Anda berhasil masuk sebagai Siswa Kelas {{ Auth::user()->class }}.</p>
    </div>
</div>
@endsection