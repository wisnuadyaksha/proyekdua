@extends('layouts.app')

@section('content')
<div class="mb-4">
    <h3 class="fw-bold text-danger">Laporan Ganti Rugi Alat</h3>
    <p class="text-muted">Daftar alat rusak atau hilang yang memerlukan tindak lanjut ganti rugi.</p>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <table class="table table-bordered align-middle">
            <thead class="table-danger">
                <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
                    <th>Nama Alat</th>
                    <th>Keterangan Masalah</th>
                    <th>Status Ganti Rugi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Contoh Data --}}
                <tr>
                    <td>1</td>
                    <td><strong>Siti Anisah</strong></td>
                    <td>Solder Dekko 40W</td>
                    <td><span class="text-danger">Kabel Putus / Rusak</span></td>
                    <td><span class="badge bg-secondary">Belum Diganti</span></td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-success">Selesaikan</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4 p-3 bg-light border rounded">
    <h5>Ringkasan Inventaris:</h5>
    <ul>
        <li>Total Alat Layak: <strong>48</strong></li>
        <li>Alat Sedang Diperbaiki: <strong>2</strong></li>
    </ul>
</div>
@endsection