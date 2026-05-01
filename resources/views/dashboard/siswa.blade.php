@extends('layouts.app')

@section('sidebar-menu')
    <li class="nav-item"><a class="nav-link active-link" href="#">Dashboard Siswa</a></li>
  <li class="nav-item">
    <a class="nav-link" href="#">Pinjam Alat</a>
</li>

<li class="nav-item">
    <a class="nav-link" href="#">Riwayat Saya</a>
</li>

@section('content')
    <h2>Halo, Siswa!</h2>
    <p>Silakan pilih alat yang ingin kamu gunakan di Workshop hari ini.</p>
    <div class="card mt-3">
        <div class="card-body">
            <h5>Status Peminjaman Aktif: <span class="badge bg-success">Tidak Ada</span></h5>
        </div>
    </div>
@endsection