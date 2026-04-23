@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Tambah Alat Baru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('barang.store') }}" method="POST">
                    @csrf {{-- Keamanan wajib Laravel --}}

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kode Alat</label>
                            <input type="text" name="kode_barang" class="form-control" placeholder="Contoh: AL-001" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Alat</label>
                            <input type="text" name="nama_barang" class="form-control" placeholder="Nama alat lengkap" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="kategori" class="form-select">
                            <option value="Elektronika">Elektronika</option>
                            <option value="Alat Ukur">Alat Ukur</option>
                            <option value="Mesin">Mesin</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jumlah Stok</label>
                            <input type="number" name="stok" class="form-control" min="1" value="1">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kondisi Alat</label>
                            <select name="kondisi" class="form-select">
                                <option value="Baik">Baik</option>
                                <option value="Rusak Ringan">Rusak Ringan</option>
                                <option value="Perlu Perbaikan">Perlu Perbaikan</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi / Spesifikasi</label>
                        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Contoh: Solder 40W merk Dekko"></textarea>
                    </div>

                    <hr>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('barang.index') }}" class="btn btn-secondary me-2">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Data Alat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection