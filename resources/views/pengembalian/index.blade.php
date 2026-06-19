@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold">Manajemen Pengembalian Alat</h3>
    <p class="text-muted">Proses pengecekan alat yang telah selesai digunakan.</p>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-info">
                <tr>
                    <th>Tgl Pinjam</th>
                    <th>Nama Peminjam</th>
                    <th>Alat & Jumlah</th>
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
                    <td>{{ \Carbon\Carbon::parse($first->tgl_pinjam)->format('d M Y') }}</td>
                    <td>
                        @if($first->id_siswa && $first->siswa)
                            <strong>{{ $first->siswa->name }}</strong><br>
                            <span class="badge bg-secondary">Siswa/Guru</span>
                        @else
                            <strong>{{ $first->nama_tamu }}</strong><br>
                            <span class="badge bg-secondary">Tamu</span>
                        @endif
                    </td>
                    <td>
                        <ul class="mb-0 ps-3">
                            @foreach($group as $p)
                                <li>{{ $p->barang->nama_barang ?? 'Alat Dihapus' }} ({{ $p->jumlah_pinjam }})</li>
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
                                <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-box-arrow-in-down"></i> Kembalikan Semua</button>
                            </form>
                            <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#modalKembali{{ Str::slug($key) }}">
                                <i class="bi bi-list"></i> Detail
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">Tidak ada alat yang sedang dipinjam.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modals Individual Pengembalian --}}
@foreach($groupedPengembalian as $key => $group)
@php $first = $group->first(); @endphp
<div class="modal fade" id="modalKembali{{ Str::slug($key) }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-dark">
                <h5 class="modal-title">Detail Pengembalian - {{ $first->id_siswa ? ($first->siswa->name ?? 'User Dihapus') : $first->nama_tamu }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                    <button type="submit" class="btn btn-sm btn-success">Proses Kembali</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection