@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Riwayat Peminjaman Saya</h4>
                </div>
                <div class="card-body">
                    <p>Berikut adalah daftar alat yang pernah kamu pinjam, lay!</p>
                    
                    <table class="table table-bordered table-striped mt-3">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama Alat</th>
                                <th>Tanggal Pinjam</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Obeng Plus (+)</td>
                                <td>23 April 2026</td>
                                <td><span class="badge bg-success">Sudah Dikembalikan</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Tang Kombinasi</td>
                                <td>24 April 2026</td>
                                <td><span class="badge bg-warning text-dark">Masih Dipinjam</span></td>
                            </tr>
                        </tbody>
                    </table>

                    <a href="{{ route('dashboard.siswa') }}" class="btn btn-secondary mt-3">Kembali ke Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection