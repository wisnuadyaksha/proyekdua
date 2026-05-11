@extends('layouts.app')

@section('sidebar-menu')
    <li class="nav-item">
        <a class="nav-link active-link" href="#">Dashboard Tamu</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('peminjaman.tamu') }}">Formulir Peminjaman</a>
    </li>
@endsection

@section('content')
<div class="container mt-4">
    <div class="alert alert-success">
        <h4>Selamat Datang, Tamu!</h4>
        <p>Anda dapat melihat ketersediaan alat di workshop kami.</p>
    </div>
    
    <div class="mt-3">
        <a href="{{ route('peminjaman.tamu') }}" class="btn btn-primary">
            Mulai Ajukan Peminjaman
        </a>
    </div>
</div>
@endsection