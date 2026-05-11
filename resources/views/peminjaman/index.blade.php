@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Seluruh Peminjaman</h3>
        {{-- Admin biasanya tidak menambah pinjaman dari sini, tapi jika perlu tetap ada --}}
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
                        <th>Peminjam</th> {{-- Kolom baru --}}
                        <th>Alat</th>
                        <th>Jumlah</th>
                        <th>Tanggal Pinjam</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($peminjamans as $peminjaman)
                    <tr>
                        {{-- Logika untuk membedakan Siswa dan Tamu --}}
                        <td>
                            @if($peminjaman->id_siswa)
                                <span class="fw-bold">{{ $peminjaman->siswa->nama ?? 'Siswa Terhapus' }}</span> 
                                <br><small class="text-muted">(Siswa)</small>
                            @else
                                <span class="fw-bold text-primary">{{ $peminjaman->nama_tamu }}</span> 
                                <br><small class="text-muted">(Tamu)</small>
                            @endif
                        </td>
                        
                        <td>{{ $peminjaman->barang->nama_barang }}</td>
                        <td>{{ $peminjaman->jumlah_pinjam }}</td>
                        <td>{{ \Carbon\Carbon::parse($peminjaman->tgl_pinjam)->format('d M Y') }}</td>
                        <td>
                            @if($peminjaman->status == 'Menunggu Persetujuan')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif($peminjaman->status == 'Dipinjam')
                                <span class="badge bg-info text-dark">Dipinjam</span>
                            @else
                                <span class="badge bg-success">Selesai</span>
                            @endif
                        </td>
                        <td>
                            {{-- Jika status masih menunggu, tampilkan tombol aksi --}}
                            @if($peminjaman->status == 'Menunggu Persetujuan')
                                <a href="{{ route('persetujuan.index') }}" class="btn btn-sm btn-outline-primary">Proses</a>
                            @else
                                <span class="text-muted small">No Action</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Belum ada data peminjaman.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="mt-3">
        <a href="{{ route('dashboard.admin') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>
</div>
@endsection