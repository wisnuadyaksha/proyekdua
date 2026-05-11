@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0" style="border-radius: 15px;">
                <div class="card-header bg-primary text-white" style="border-radius: 15px 15px 0 0;">
                    <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Data Alat</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('barang.update', $barang->id_barang) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_barang" class="form-label font-weight-bold">Nama Barang</label>
                            <input type="text" 
                                   class="form-control @error('nama_barang') is-invalid @enderror" 
                                   id="nama_barang" 
                                   name="nama_barang" 
                                   value="{{ old('nama_barang', $barang->nama_barang) }}" 
                                   required>
                            @error('nama_barang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="spesifikasi" class="form-label font-weight-bold">Spesifikasi (Deskripsi)</label>
                            <textarea class="form-control @error('spesifikasi') is-invalid @enderror" 
                                      id="spesifikasi" 
                                      name="spesifikasi" 
                                      rows="4" 
                                      required>{{ old('spesifikasi', $barang->spesifikasi) }}</textarea>
                            @error('spesifikasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="foto_barang" class="form-label font-weight-bold">Foto Alat</label>
                            <div class="mb-2">
                                <small class="text-muted d-block mb-1">Foto Saat Ini:</small>
                                @if($barang->foto_barang)
                                    <img src="{{ asset('storage/' . $barang->foto_barang) }}" 
                                         alt="Preview" 
                                         class="img-thumbnail" 
                                         style="height: 100px;">
                                @else
                                    <span class="badge bg-secondary">Tidak ada foto</span>
                                @endif
                            </div>
                            <input type="file" class="form-control @error('foto_barang') is-invalid @enderror" id="foto_barang" name="foto_barang">
                            <small class="text-muted">Pilih file baru jika ingin mengganti foto (Format: JPG, PNG. Maks: 2MB).</small>
                        </div>

                        <div class="d-flex justify-content-between border-top pt-3">
                            <a href="{{ route('barang.index') }}" class="btn btn-light px-4">
                                <i class="fas fa-arrow-left me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection