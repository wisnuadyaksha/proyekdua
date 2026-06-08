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
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Peminjam</th>
                        <th>Alat</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pinjamans as $p)
                    <tr>
                        <td>{{ $p->id_siswa ? ($p->siswa->name ?? 'User Dihapus') : $p->nama_tamu }}</td>
                        <td>{{ $p->barang->nama_barang ?? 'Barang Telah Dihapus' }}</td>
                        <td>{{ $p->jumlah_pinjam }}</td>
                        <td>
                            <form action="{{ route('pengembalian.proses', $p->id_peminjaman) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="bi bi-arrow-repeat"></i> Sudah Dikembalikan
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada barang yang sedang dipinjam.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection