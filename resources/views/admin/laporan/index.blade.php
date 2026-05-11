@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">Laporan Peminjaman Alat</h3>
        {{-- Tombol cetak hanya muncul di layar, tidak saat di-print --}}
        <button onclick="window.print()" class="btn btn-secondary shadow-sm d-print-none">
            <i class="bi bi-printer"></i> Cetak Laporan
        </button>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
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
                        {{-- Menggunakan null coalescing (??) agar tidak error jika relasi kosong --}}
                        <td>{{ $item->siswa->nama_siswa ?? 'Umum/Tamu' }}</td>
                        <td>{{ $item->barang->nama_barang ?? 'Alat Dihapus' }}</td>
                        <td>{{ $item->jumlah_pinjam }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d-m-Y') }}</td>
                        <td>
                            <span class="badge {{ $item->status == 'Kembali' ? 'bg-success' : 'bg-warning text-dark' }}">
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
@endsection