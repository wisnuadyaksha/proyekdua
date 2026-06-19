@extends('layouts.app')

@section('content')
<div class="container">
    {{-- TOMBOL KEMBALI --}}
    <div class="mb-3">
        <a href="{{ route('dashboard.admin') }}" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
    </div>

    <div class="mb-4">
    <h3 class="fw-bold">Persetujuan Peminjaman Alat</h3>
    <p class="text-muted">Daftar permintaan peminjaman alat dari siswa dan tamu.</p>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-warning">
                <tr>
                    <th>Tgl Pengajuan</th>
                    <th>Nama Peminjam</th>
                    <th>Alat & Jumlah</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $groupedPinjamans = $pinjamans->groupBy(function($item) {
                        $identifier = $item->id_siswa ? 'siswa_'.$item->id_siswa : 'tamu_'.$item->nama_tamu;
                        return $identifier . '_' . \Carbon\Carbon::parse($item->tgl_pinjam)->format('Y-m-d');
                    });
                @endphp

                @forelse($groupedPinjamans as $key => $group)
                @php $first = $group->first(); @endphp
                <tr>
                    <td>{{ \Carbon\Carbon::parse($first->tgl_pinjam)->format('d F Y') }}</td>
                    <td>
                        @if($first->id_siswa && $first->siswa)
                            <strong>{{ $first->siswa->name }}</strong><br>
                            @if($first->siswa->role === 'guru')
                                <span class="badge bg-warning text-dark mt-1"><i class="bi bi-person-badge"></i> Guru</span>
                            @else
                                <span class="badge bg-primary mt-1"><i class="bi bi-person"></i> Siswa - {{ $first->siswa->class ?? '-' }}</span>
                            @endif
                        @elseif($first->id_siswa && !$first->siswa)
                            <strong class="text-danger">User Dihapus</strong><br>
                            <span class="badge bg-secondary mt-1">Akun Tidak Ditemukan</span>
                        @else
                            <strong>{{ $first->nama_tamu }}</strong><br>
                            <span class="badge bg-secondary mt-1"><i class="bi bi-person-fill"></i> Tamu</span>
                        @endif
                    </td>
                    <td>
                        <ul class="mb-0 ps-3">
                            @foreach($group as $p)
                                <li>{{ $p->barang->nama_barang ?? 'Alat Tidak Ditemukan' }} ({{ $p->jumlah_pinjam }} {{ $p->barang->satuan ?? '' }})</li>
                            @endforeach
                        </ul>
                    </td>
                    <td><span class="badge bg-info">Menunggu Persetujuan</span></td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            {{-- Form Aksi Massal --}}
                            <form action="{{ route('persetujuan.update_bulk') }}" method="POST" class="d-flex gap-2">
                                @csrf
                                @foreach($group as $p)
                                    <input type="hidden" name="id_peminjaman[]" value="{{ $p->id_peminjaman }}">
                                @endforeach
                                <button type="submit" name="status" value="Dipinjam" class="btn btn-sm btn-success"><i class="bi bi-check-all"></i> Setujui Semua</button>
                                <button type="submit" name="status" value="Ditolak" class="btn btn-sm btn-danger"><i class="bi bi-x-square"></i> Tolak Semua</button>
                            </form>

                            {{-- Tombol Modal Detail --}}
                            <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalDetail{{ Str::slug($key) }}">
                                <i class="bi bi-list-ul"></i> Detail
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">Tidak ada permintaan persetujuan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modals for Individual Actions --}}
@foreach($groupedPinjamans as $key => $group)
@php $first = $group->first(); @endphp
<div class="modal fade" id="modalDetail{{ Str::slug($key) }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Detail Alat - {{ $first->id_siswa ? ($first->siswa->name ?? 'User Dihapus') : $first->nama_tamu }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Alat</th>
                            <th>Jumlah</th>
                            <th>Status Stok</th>
                            <th class="text-center">Aksi Individual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($group as $p)
                        <tr>
                            <td>{{ $p->barang->nama_barang ?? 'Alat Tidak Ditemukan' }}</td>
                            <td>{{ $p->jumlah_pinjam }} {{ $p->barang->satuan ?? '' }}</td>
                            <td>
                                @if($p->barang)
                                    Sisa Stok: <strong>{{ $p->barang->stok_tersedia }}</strong>
                                    @if($p->barang->stok_tersedia < $p->jumlah_pinjam)
                                        <br><span class="text-danger small"><i class="bi bi-exclamation-triangle"></i> Stok Kurang!</span>
                                    @endif
                                @else
                                    <span class="text-danger">Alat Hilang/Dihapus</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <form action="{{ route('persetujuan.update', $p->id_peminjaman) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="Dipinjam">
                                        <button type="submit" class="btn btn-sm btn-success" @if(!$p->barang || $p->barang->stok_tersedia < $p->jumlah_pinjam) disabled @endif>Setujui</button>
                                    </form>
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
</div>
@endsection