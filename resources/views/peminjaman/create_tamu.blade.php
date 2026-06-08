@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="mb-3">
        <a href="{{ url('/') }}" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
        </a>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow border-0">
                <div class="card-header bg-warning text-dark text-center">
                    <h5 class="mb-0 font-weight-bold">Formulir Peminjaman Alat (Tamu)</h5>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger m-3">{{ session('error') }}</div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success m-3">{{ session('success') }}</div>
                @endif
                <div class="card-body p-0">
                    <div class="row g-0">
                        {{-- KOLOM GAMBAR --}}
                        <div class="col-md-5 bg-light d-flex align-items-center justify-content-center p-3">
                            <div class="text-center" id="img-placeholder-tamu">
                                <i class="bi bi-camera" style="font-size: 3rem; color: #ccc;"></i>
                                <p class="small text-muted">Gambar alat akan muncul di sini</p>
                            </div>
                            <img id="preview-img-tamu" src="" class="img-fluid rounded shadow-sm" style="max-height: 300px; object-fit: contain; display: none;">
                        </div>

                        {{-- KOLOM FORMULIR --}}
                        <div class="col-md-7 p-4">
                            <form action="{{ route('peminjaman.storeTamu') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label font-weight-bold">Nama Lengkap</label>
                                    <input type="text" name="nama_peminjam" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label font-weight-bold">Nomor Telepon / WhatsApp</label>
                                    <input type="number" name="no_telp" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label font-weight-bold">Pilih Alat</label>
                                    <select name="id_barang" id="id_barang_tamu" class="form-control shadow-sm" required>
                                        <option value="" disabled selected>-- Pilih Alat --</option>
                                        @foreach($barangs as $b)
                                            <option value="{{ $b->id_barang }}" data-foto="{{ $b->foto_barang }}">
                                                {{ $b->nama_barang }} (Stok: {{ $b->stok_total }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label font-weight-bold">Jumlah Pinjam</label>
                                        <input type="number" name="jumlah_pinjam" class="form-control" min="1" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label font-weight-bold">Rencana Kembali</label>
                                        <input type="date" name="tgl_kembali" class="form-control" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label font-weight-bold">Catatan/Tujuan</label>
                                    <textarea name="catatan" class="form-control" rows="2"></textarea>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-warning font-weight-bold text-dark">Kirim Permohonan Pinjam</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const idBarangTamu = document.getElementById('id_barang_tamu');
        if (idBarangTamu) {
            idBarangTamu.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const fotoPath = selectedOption.getAttribute('data-foto');
                const imgElement = document.getElementById('preview-img-tamu');
                const placeholder = document.getElementById('img-placeholder-tamu');

                if (fotoPath && fotoPath !== "NULL" && fotoPath !== "") {
                    placeholder.style.display = 'none';
                    const filename = fotoPath.replace(/^alat\//, '');
                    imgElement.src = "{{ asset('img/alat') }}/" + filename;
                    imgElement.style.display = 'block';
                } else {
                    placeholder.style.display = 'block';
                    imgElement.style.display = 'none';
                }
            });
        }
    });
</script>
@endsection