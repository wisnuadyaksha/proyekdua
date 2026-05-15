@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow border-0">
            <div class="card-header bg-white pt-4"><h4 class="fw-bold text-dark">Tambah Barang Baru</h4></div>
            <div class="card-body">
                {{-- WAJIB: Atribut enctype agar gambar bisa terkirim --}}
                <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control" placeholder="Contoh: Obeng Kembang" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kategori</label>
                        <input type="text" name="kategori" class="form-control" placeholder="Contoh: Alat Tangan / Alat Ukur" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Spesifikasi</label>
                        <textarea name="spesifikasi" class="form-control" rows="2" placeholder="Contoh: Ukuran 10 Inch, Bahan Chrome Vanadium"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jumlah Stok</label>
                            <input type="number" name="stok_total" class="form-control" min="1" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Foto Alat</label>
                            <input type="file" name="foto_barang" id="foto_barang" class="form-control" accept="image/*">
                        </div>
                    </div>

                    {{-- Syntax Preview Gambar --}}
                    <div class="mb-3 text-center border rounded p-2 bg-light">
                        <img id="preview-foto" src="#" alt="Pratinjau" class="img-fluid rounded" style="max-height: 150px; display: none;">
                        <p id="placeholder-text" class="text-muted small mb-0">Foto akan muncul di sini setelah dipilih</p>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary fw-bold">Simpan Barang</button>
                        <a href="{{ route('barang.index') }}" class="btn btn-link text-muted">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Script untuk Preview Gambar --}}
<script>
    document.getElementById('foto_barang').onchange = evt => {
        const [file] = document.getElementById('foto_barang').files
        if (file) {
            const preview = document.getElementById('preview-foto');
            const text = document.getElementById('placeholder-text');
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
            text.style.display = 'none';
        }
    }
</script>
@endsection