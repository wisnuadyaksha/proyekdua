@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-white pt-4">
                    <h4 class="fw-bold">Edit Data Barang / Alat</h4>
                </div>
                <div class="card-body">
                    {{-- PENTING: enctype wajib ada untuk upload foto --}}
                    <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control" value="{{ $barang->nama_barang }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Kategori</label>
                                <input type="text" name="kategori" class="form-control" value="{{ $barang->kategori }}" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Spesifikasi</label>
                            <textarea name="spesifikasi" class="form-control" rows="3">{{ $barang->spesifikasi }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Stok Total</label>
                                <input type="number" name="stok_total" class="form-control" value="{{ $barang->stok_total }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Foto Barang (Opsional)</label>
                                <input type="file" name="foto_barang" class="form-control">
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                            </div>
                        </div>

                        @if($barang->foto_barang)
                        <div class="mb-4">
                            <label class="d-block mb-2 small fw-bold">Foto Saat Ini:</label>
                            <img src="{{ asset('storage/' . $barang->foto_barang) }}" width="150" class="rounded border">
                        </div>
                        @endif

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Update Data Barang</button>
                            <a href="{{ route('barang.index') }}" class="btn btn-link text-muted text-decoration-none">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection