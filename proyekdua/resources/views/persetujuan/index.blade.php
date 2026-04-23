@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold">Persetujuan Peminjaman Alat</h3>
    <p class="text-muted">Daftar permintaan peminjaman alat dari siswa dan tamu.</p>
</div>

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
                {{-- Contoh data yang masuk --}}
                <tr>
                    <td>23 April 2026</td>
                    <td><strong>Wisnu Adyaksa</strong> <br><small class="text-muted">Siswa - SIKC 2D</small></td>
                    <td>Multimeter Digital</td>
                    <td>1</td>
                    <td><span class="badge bg-info">Menunggu</span></td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-success">Setujui</button>
                        <button class="btn btn-sm btn-danger">Tolak</button>
                    </td>
                </tr>
                <tr>
                    <td>23 April 2026</td>
                    <td><strong>Syekha Nabila</strong> <br><small class="text-muted">Siswa - SIKC 2D</small></td>
                    <td>Solder Dekko</td>
                    <td>2</td>
                    <td><span class="badge bg-info">Menunggu</span></td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-success">Setujui</button>
                        <button class="btn btn-sm btn-danger">Tolak</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection