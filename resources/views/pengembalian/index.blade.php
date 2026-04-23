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
                    <th>Nama Peminjam</th>
                    <th>Alat & Jumlah</th>
                    <th>Tgl Pinjam</th>
                    <th>Status Kondisi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Contoh Data 1 --}}
                <tr>
                    <td><strong>Wisnu Adyaksa</strong></td>
                    <td>Multimeter Digital (1)</td>
                    <td>23 April 2026</td>
                    <td>
                        <select class="form-select form-select-sm">
                            <option value="baik">Baik</option>
                            <option value="rusak">Rusak</option>
                            <option value="hilang">Hilang</option>
                        </select>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-primary">Proses Kembali</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="alert alert-warning mt-4">
    <strong>Catatan:</strong> Jika alat dikembalikan dalam kondisi <strong>Rusak</strong> atau <strong>Hilang</strong>, sistem akan otomatis mengarahkan ke halaman <em>Laporan Ganti Rugi</em>.
</div>
@endsection