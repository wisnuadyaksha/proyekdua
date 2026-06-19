@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        {{-- Header Welcome --}}
        <div class="col-12 mb-4">
            <div class="card shadow-sm border-0 p-4 bg-white">
                <h2 class="fw-bold text-dark mb-1">Selamat Datang, Admin!</h2>
                <p class="text-muted mb-0">Panel Kendali Workshop Teknik Otomasi Industri (TOI) SMKN 1 SINDANG.</p>
            </div>
        </div>

        {{-- Baris Menu Atas --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 p-4 text-center h-100">
                <i class="bi bi-check2-square text-primary mb-3" style="font-size: 2.5rem;"></i>
                <h5 class="fw-bold">Persetujuan</h5>
                <p class="small text-muted">Konfirmasi permintaan pinjaman alat dari siswa.</p>
                <a href="{{ route('persetujuan.index') }}" class="btn btn-primary mt-auto rounded-pill">Kelola Pinjaman</a>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 p-4 text-center h-100">
                <i class="bi bi-box-seam text-success mb-3" style="font-size: 2.5rem;"></i>
                <h5 class="fw-bold">Stok Barang</h5>
                <p class="small text-muted">Atur dan update data alat laboratorium.</p>
                <a href="{{ route('barang.index') }}" class="btn btn-success mt-auto rounded-pill">Lihat Stok</a>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 p-4 text-center h-100">
                <i class="bi bi-arrow-left-right text-warning mb-3" style="font-size: 2.5rem;"></i>
                <h5 class="fw-bold">Pengembalian</h5>
                <p class="small text-muted">Proses alat yang telah dikembalikan oleh siswa.</p>
                <a href="{{ route('pengembalian.index') }}" class="btn btn-warning text-white mt-auto rounded-pill">Input Kembali</a>
            </div>
        </div>

        {{-- Baris Menu Bawah --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 p-4 text-center h-100">
                <i class="bi bi-people text-info mb-3" style="font-size: 2.5rem;"></i>
                <h5 class="fw-bold">Data Siswa</h5>
                <p class="small text-muted">Manajemen akun dan data peminjam (Siswa).</p>
                <a href="{{ route('siswa.index') }}" class="btn btn-info text-white mt-auto rounded-pill">Manajemen Siswa</a>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 p-4 text-center h-100">
                <i class="bi bi-person-vcard text-secondary mb-3" style="font-size: 2.5rem;"></i>
                <h5 class="fw-bold">Data Tamu</h5>
                <p class="small text-muted">Lihat riwayat pinjaman dari pengguna luar/tamu.</p>
                <a href="{{ route('tamu.index') }}" class="btn btn-secondary mt-auto rounded-pill">Lihat Tamu</a>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0 p-4 text-center h-100">
                <i class="bi bi-file-earmark-bar-graph text-danger mb-3" style="font-size: 2.5rem;"></i>
                <h5 class="fw-bold">Laporan & Rekap</h5>
                <p class="small text-muted">Laporan peminjaman & rekap bulanan.</p>
                <a href="{{ route('laporan.index') }}" class="btn btn-danger mt-auto rounded-pill">Buka Laporan</a>
            </div>
        </div>
    </div>
</div>
@endsection