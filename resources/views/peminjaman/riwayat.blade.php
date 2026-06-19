@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="mb-3">
        <a href="{{ auth()->user() && auth()->user()->role === 'guru' ? route('dashboard.guru') : route('dashboard.siswa') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>
    <h4>Riwayat Peminjaman Alat</h4>
    <table class="table table-striped mt-3 align-middle">
        <thead>
            <tr>
                <th>Tanggal Pinjam</th>
                <th>Rincian Alat & Status</th>
            </tr>
        </thead>
        <tbody>
            @php
                $groupedRiwayats = $riwayats->groupBy(function($item) {
                    return \Carbon\Carbon::parse($item->tgl_pinjam)->format('Y-m-d');
                });
            @endphp

            @forelse($groupedRiwayats as $date => $group)
            @php $first = $group->first(); @endphp
            <tr>
                <td>{{ \Carbon\Carbon::parse($first->tgl_pinjam)->format('d F Y') }}</td>
                <td>
                    <ul class="mb-0 ps-3">
                        @foreach($group as $row)
                            @php
                                $badgeClass = 'bg-secondary';
                                if($row->status == 'Menunggu Persetujuan') $badgeClass = 'bg-info text-dark';
                                if($row->status == 'Dipinjam') $badgeClass = 'bg-warning text-dark';
                                if($row->status == 'Dikembalikan') $badgeClass = 'bg-success';
                                if($row->status == 'Ditolak') $badgeClass = 'bg-danger';
                                
                                $tglKembali = $row->status == 'Habis Pakai' ? '' : ($row->tgl_kembali ? ' (Kembali: ' . \Carbon\Carbon::parse($row->tgl_kembali)->format('d/m/Y') . ')' : '');
                            @endphp
                            <li class="mb-1">
                                {{ $row->barang->nama_barang ?? 'Alat Dihapus' }} 
                                <strong>({{ $row->jumlah_pinjam }} {{ $row->barang->satuan ?? '' }})</strong>
                                <span class="badge {{ $badgeClass }} ms-1">{{ $row->status }}</span>
                                <span class="text-muted small ms-1">{{ $tglKembali }}</span>
                            </li>
                        @endforeach
                    </ul>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="2" class="text-center text-muted py-4">Belum ada riwayat peminjaman.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection