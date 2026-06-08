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
                    <th>Alat</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pinjamans as $p)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d F Y') }}</td>
                    <td>
                        <strong>{{ $p->siswa->name ?? $p->nama_tamu }}</strong> 
                        <br>
                        <small class="text-muted">
                            {{ $p->id_siswa ? 'Siswa - ' . ($p->siswa->class ?? '-') : 'Tamu' }}
                        </small>
                    </td>
                    <td>{{ $p->barang->nama_barang ?? 'Alat Tidak Ditemukan' }}</td>
                    <td>{{ $p->jumlah_pinjam }}</td>
                    <td><span class="badge bg-info">{{ $p->status }}</span></td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">
                            {{-- Tombol Setujui --}}
                            <form action="{{ route('persetujuan.update', $p->id_peminjaman) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Dipinjam">
                                <button type="submit" class="btn btn-sm btn-success">Setujui</button>
                            </form>

                            {{-- Tombol Tolak --}}
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
@endsection