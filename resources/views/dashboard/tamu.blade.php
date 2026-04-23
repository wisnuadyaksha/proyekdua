@extends('layouts.app')

@section('sidebar-menu')
    <li class="nav-item"><a class="nav-link active-link" href="#">Dashboard Tamu</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('tamu.create') }}">Formulir Peminjaman</a></li>
@endsection

@section('content')
    <h2>Layanan Tamu</h2>
    <p>Selamat datang di Workshop SMKN 1 Sindang. Silakan isi formulir untuk peminjaman alat bagi pihak luar.</p>
@endsection