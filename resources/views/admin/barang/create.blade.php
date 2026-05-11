@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow border-0">
            <div class="card-header bg-white pt-4"><h4 class="fw-bold">Tambah Barang Baru</h4></div>
            <div class="card-body">
                <form action="{{ route('barang.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" placeholder="Contoh: Multimeter Digital" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kode Barang</label>
                        <input type="text" name="kode_barang" class="form-control" placeholder="BRG-001" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jumlah Stok</label>
                            <input type="number" name="stok" class="form-control" min="1" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Kondisi</label>
                            <select name="kondisi" class="form-select">
                                <option value="Baik">Baik</option>
                                <option value="Rusak Ringan">Rusak Ringan</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Simpan Barang</button>
                        <a href="{{ route('barang.index') }}" class="btn btn-link text-muted">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection