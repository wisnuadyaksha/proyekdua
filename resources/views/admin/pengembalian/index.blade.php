@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm border-0 p-4">
        <h3 class="fw-bold"><i class="bi bi-arrow-left-right me-2"></i> Manajemen Pengembalian Alat</h3>
        <p class="text-muted">Daftar alat yang sedang dipinjam dan perlu dikembalikan.</p>
        <hr>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Peminjam</th>
                        <th>Alat</th>
                        <th>Tanggal Pinjam</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Data akan muncul di sini nanti --}}
                    <tr>
                        <td colspan="5" class="text-center">Belum ada data peminjaman yang perlu dikembalikan.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection