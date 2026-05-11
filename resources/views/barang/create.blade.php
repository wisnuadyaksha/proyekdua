@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Tambah Alat Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Spesifikasi</label>
                            <textarea name="spesifikasi" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kategori</label>
                                <input type="text" name="kategori" class="form-control" placeholder="Contoh: Elektronik" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Stok Total</label>
                                <input type="number" name="stok_total" class="form-control" min="1" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Foto Alat (Opsional)</label>
                            <input type="file" name="foto_barang" class="form-control">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('barang.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection