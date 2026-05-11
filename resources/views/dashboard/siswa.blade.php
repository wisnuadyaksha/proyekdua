@extends('layouts.app')

@section('sidebar-menu')
    <li class="nav-item"><a class="nav-link active-link" href="#">Dashboard Siswa</a></li>
  <li class="nav-item">
    <a class="nav-link" href="#">Pinjam Alat</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="#">Riwayat Saya</a>
</li>

@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="alert alert-primary">
        <h4>Halo, Siswa!</h4>
        <p>Silakan pilih alat yang ingin Anda pinjam hari ini.</p>
    </div>
</div>
@endsection

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif