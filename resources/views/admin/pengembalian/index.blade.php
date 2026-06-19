@extends('layouts.app')

@section('content')
<div class="container">
    {{-- TOMBOL KEMBALI --}}
    <div class="mb-3">
        <a href="{{ route('dashboard.admin') }}" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
    </div>
    <div class="card shadow-sm border-0 p-4">
        <h3 class="fw-bold"><i class="bi bi-arrow-left-right me-2"></i> Manajemen Pengembalian Alat</h3>
        <p class="text-muted">Daftar alat yang sedang dipinjam dan perlu dikembalikan.</p>
        <hr>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Peminjam</th>
                        <th>Rincian Alat & Jumlah</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $groupedPengembalian = $pinjamans->groupBy(function($item) {
                            $identifier = $item->id_siswa ? 'siswa_'.$item->id_siswa : 'tamu_'.$item->nama_tamu;
                            return $identifier . '_' . \Carbon\Carbon::parse($item->tgl_pinjam)->format('Y-m-d');
                        });
                    @endphp

                    @forelse($groupedPengembalian as $key => $group)
                    @php $first = $group->first(); @endphp
                    <tr>
                        <td>
                            @if($first->id_siswa && $first->siswa)
                                <div class="fw-bold">{{ $first->siswa->name }}</div>
                                @if($first->siswa->role === 'guru')
                                    <span class="badge bg-warning text-dark mt-1"><i class="bi bi-person-badge"></i> Guru</span>
                                @else
                                    <span class="badge bg-primary mt-1"><i class="bi bi-person"></i> Siswa - {{ $first->siswa->class ?? '-' }}</span>
                                @endif
                            @elseif($first->id_siswa && !$first->siswa)
                                <div class="fw-bold text-danger">User Dihapus</div>
                                <span class="badge bg-secondary mt-1">Akun Tidak Ditemukan</span>
                            @else
                                <div class="fw-bold">{{ $first->nama_tamu }}</div>
                                <span class="badge bg-secondary mt-1"><i class="bi bi-person-fill"></i> Tamu</span>
                            @endif
                            <div class="text-muted small mt-1">Tgl Pinjam: {{ \Carbon\Carbon::parse($first->tgl_pinjam)->format('d M Y') }}</div>
                        </td>
                        <td>
                            <ul class="mb-0 ps-3">
                                @foreach($group as $p)
                                    <li>{{ $p->barang->nama_barang ?? 'Barang Telah Dihapus' }} ({{ $p->jumlah_pinjam }})</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <form action="{{ route('pengembalian.proses_bulk') }}" method="POST">
                                    @csrf
                                    @foreach($group as $p)
                                        <input type="hidden" name="id_peminjaman[]" value="{{ $p->id_peminjaman }}">
                                    @endforeach
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="bi bi-check-all"></i> Kembalikan Semua
                                    </button>
                                </form>
                                <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalKembali{{ Str::slug($key) }}">
                                    <i class="bi bi-list"></i> Detail Sebagian
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-muted">Tidak ada barang yang sedang dipinjam.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modals Individual Pengembalian --}}
@foreach($groupedPengembalian as $key => $group)
@php $first = $group->first(); @endphp
<div class="modal fade" id="modalKembali{{ Str::slug($key) }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Detail Pengembalian - {{ $first->id_siswa ? ($first->siswa->name ?? 'User Dihapus') : $first->nama_tamu }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Alat</th>
                            <th>Jumlah</th>
                            <th class="text-center">Aksi Individual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($group as $p)
                        <tr>
                            <td>{{ $p->barang->nama_barang ?? 'Alat Dihapus' }}</td>
                            <td>{{ $p->jumlah_pinjam }}</td>
                            <td class="text-center">
                                <form action="{{ route('pengembalian.proses', $p->id_peminjaman) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-arrow-repeat"></i> Sudah Dikembalikan</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
    </div>
</div>
@endsection