@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- Card Header --}}
        <div class="col-md-11 mb-4">
            <div class="card shadow-sm border-0 p-4" style="border-radius: 15px; background: white;">
                <h2 class="fw-bold text-primary mb-1">Halo Siswa {{ Auth::user()->name }}!</h2>
                <p class="text-muted mb-0">Selamat datang di sistem peminjaman alat praktik TOI.</p>
            </div>
        </div>

        {{-- Menu Utama --}}
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm border-0 h-100 p-4 text-center" style="border-radius: 15px;">
                <div class="card-body d-flex flex-column">
                    <i class="bi bi-tools text-primary mb-3" style="font-size: 3rem;"></i>
                    <h4 class="fw-bold">Pinjam Alat</h4>
                    <p class="text-muted small">Cari alat laboratorium yang tersedia untuk dipinjam.</p>
                    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary w-100 rounded-pill mt-auto">Mulai Pinjam</a>
                </div>
            </div>
        </div>

        <div class="col-md-5 mb-4">
            <div class="card shadow-sm border-0 h-100 p-4 text-center" style="border-radius: 15px;">
                <div class="card-body d-flex flex-column">
                    <i class="bi bi-clock-history text-success mb-3" style="font-size: 3rem;"></i>
                    <h4 class="fw-bold">Riwayat Saya</h4>
                    <p class="text-muted small">Pantau status persetujuan dan history peminjaman Anda.</p>
                    <a href="{{ route('peminjaman.riwayat') }}" class="btn btn-success w-100 rounded-pill mt-auto">Cek Riwayat</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection