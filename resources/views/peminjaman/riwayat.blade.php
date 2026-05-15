@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="mb-3">
        <a href="{{ route('dashboard.siswa') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>
    <h4>Riwayat Peminjaman Alat</h4>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Nama Alat</th>
                <th>Jumlah</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            {{-- Pastikan variabelnya $riwayats sesuai dengan compact di Controller --}}
            @forelse($riwayats as $row)
            <tr>
                <td>{{ $row->barang->nama_barang ?? 'Alat Dihapus' }}</td>
                <td>{{ $row->jumlah_pinjam }}</td>
                <td>{{ \Carbon\Carbon::parse($row->tgl_pinjam)->format('d/m/Y') }}</td>
                <td>
                    {{-- Penambahan logika warna badge sesuai status --}}
                    @if($row->status == 'Menunggu Persetujuan')
                        <span class="badge bg-info text-dark">{{ $row->status }}</span>
                    @elseif($row->status == 'Dipinjam')
                        <span class="badge bg-warning text-dark">{{ $row->status }}</span>
                    @elseif($row->status == 'Dikembalikan')
                        <span class="badge bg-success">{{ $row->status }}</span>
                    @elseif($row->status == 'Ditolak')
                        <span class="badge bg-danger">{{ $row->status }}</span>
                    @else
                        <span class="badge bg-secondary">{{ $row->status }}</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center text-muted">Belum ada riwayat peminjaman.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection