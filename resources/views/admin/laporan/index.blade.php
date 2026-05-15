@extends('layouts.app')

@section('content')
<div class="container mt-4">
    {{-- TOMBOL KEMBALI --}}
    <div class="mb-3 d-print-none">
        <a href="{{ route('dashboard.admin') }}" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Laporan Peminjaman Alat</h3>
        {{-- Tombol cetak --}}
        <button onclick="window.print()" class="btn btn-secondary shadow-sm d-print-none">
            <i class="bi bi-printer"></i> Cetak Laporan
        </button>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Peminjam</th>
                            <th>Alat</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pinjam</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($laporans as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                {{-- 
                                   PENJELASAN PERBAIKAN:
                                   1. Cek apakah ada relasi 'siswa' (User)
                                   2. Jika ada, tampilkan '$item->siswa->name' (bukan nama_siswa)
                                   3. Jika tidak ada relasi, tampilkan 'nama_tamu' dari tabel peminjaman
                                --}}
                                @if($item->id_siswa && $item->siswa)
                                    <span class="fw-bold text-primary">{{ $item->siswa->name }}</span>
                                    <br><small class="text-muted">{{ $item->siswa->class }}</small>
                                @else
                                    {{ $item->nama_tamu ?? 'Umum/Tamu' }}
                                @endif
                            </td>
                            <td>{{ $item->barang->nama_barang ?? 'Alat Dihapus' }}</td>
                            <td>{{ $item->jumlah_pinjam }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d-m-Y') }}</td>
                            <td>
                                @php
                                    $badgeClass = 'bg-warning text-dark';
                                    if($item->status == 'Kembali') $badgeClass = 'bg-success';
                                    if($item->status == 'Ditolak') $badgeClass = 'bg-danger';
                                    if($item->status == 'Dipinjam') $badgeClass = 'bg-info text-dark';
                                @endphp
                                <span class="badge {{ $badgeClass }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Belum ada data laporan tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- CSS Tambahan agar cetakan rapi --}}
<style>
    @media print {
        .btn, .d-print-none, .mb-3 { display: none !important; }
        .card { shadow: none; border: none; }
        body { background-color: white !important; }
    }
</style>
@endsection