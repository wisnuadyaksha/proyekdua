@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Peminjaman Aktif</h3>
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">Tambah Pinjaman Baru</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Alat</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Obeng Plus (+)</td>
                        <td>{{ date('d M Y') }}</td>
                        <td><span class="badge bg-info text-dark">Menunggu Persetujuan</span></td>
                        <td>
                            <button class="btn btn-sm btn-danger">Batalkan</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-3">
        <a href="{{ route('dashboard.siswa') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>
</div>
@endsection