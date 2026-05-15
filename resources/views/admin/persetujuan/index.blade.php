@extends('layouts.app')

@section('content')
<div class="container mt-4">
    {{-- TOMBOL KEMBALI --}}
    <div class="mb-3">
        <a href="{{ route('dashboard.admin') }}" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
    </div>
    <h3 class="fw-bold mb-4">Persetujuan Peminjaman Alat</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Peminjam</th>
                        <th>Alat</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
   <tbody>
    @foreach($pinjamans as $p)
    <tr>
        <td>{{ $p->tgl_pinjam }}</td>
        <td>
            <div class="fw-bold">{{ $p->siswa->name ?? $p->nama_tamu }}</div>
            <small class="text-muted">
                {{ $p->id_siswa ? 'Siswa' : 'Tamu' }} | {{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d M Y') }}
            </small>
        </td>
        <td>{{ $p->barang->nama_barang ?? 'Alat Tidak Ditemukan' }}</td>
        <td>{{ $p->jumlah_pinjam }}</td>
        <td>
            <span class="badge {{ $p->status == 'Menunggu Persetujuan' ? 'bg-warning' : 'bg-info' }}">
                {{ $p->status }}
            </span>
        </td>
        <td class="text-center">
            <div class="d-flex justify-content-center gap-2">
                {{-- Form Setujui --}}
                <form action="{{ route('persetujuan.update', $p->id_peminjaman) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="Dipinjam">
                    <button type="submit" class="btn btn-sm btn-success">Setujui</button>
                </form>

                {{-- Form Tolak --}}
                <form action="{{ route('persetujuan.update', $p->id_peminjaman) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="Ditolak">
                    <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                </form>
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .table thead th {
        border-top: none;
        padding: 15px 10px;
        font-weight: 600;
    }
    .table tbody td {
        padding: 15px 10px;
    }
</style>
@endsection