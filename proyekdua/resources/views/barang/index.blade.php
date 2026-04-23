@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold">Daftar Inventaris Alat Workshop</h3>
        <p class="text-muted">Manajemen stok dan status alat SMKN 1 Sindang</p>
    </div>
    <a href="{{ route('barang.create') }}" class="btn btn-primary shadow-sm">
        <i class="bi bi-plus-lg"></i> + Tambah Alat Baru
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th width="5%">No</th>
                    <th width="25%">Nama Alat</th>
                    <th width="20%">Kategori</th>
                    <th width="15%">Stok</th>
                    <th width="15%">Status</th>
                    <th width="20%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                {{-- Contoh Data 1 --}}
                <tr>
                    <td>1</td>
                    <td><strong>Multimeter Digital</strong></td>
                    <td>Elektronika</td>
                    <td>12 Unit</td>
                    <td><span class="badge bg-success">Tersedia</span></td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="{{ route('barang.edit', 1) }}" class="btn btn-sm btn-warning">Edit</a>
                            <button type="button" class="btn btn-sm btn-info text-white">Detail</button>
                            <form action="#" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus alat ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>

                {{-- Contoh Data 2 --}}
                <tr>
                    <td>2</td>
                    <td><strong>Solder Dekko 40W</strong></td>
                    <td>Elektronika</td>
                    <td>0 Unit</td>
                    <td><span class="badge bg-danger">Habis/Dipinjam</span></td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="#" class="btn btn-sm btn-warning">Edit</a>
                            <button type="button" class="btn btn-sm btn-info text-white">Detail</button>
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

{{-- Tambahan informasi total di bawah tabel agar lebih informatif --}}
<div class="mt-3">
    <small class="text-muted">Menampilkan 2 data alat workshop</small>
</div>
@endsection