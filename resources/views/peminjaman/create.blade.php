@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="mb-3">
        <a href="{{ route('dashboard.siswa') }}" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
    </div>
    <div class="card shadow-sm border-0" style="border-radius: 15px;">
        <div class="card-header bg-dark text-white" style="border-radius: 15px 15px 0 0;">
            <h5 class="mb-0 py-1"><i class="bi bi-file-earmark-text me-2"></i>Formulir Peminjaman Alat</h5>
        
        </div>
        <div class="card-body p-0">
            <div class="row g-0">
                {{-- KOLOM GAMBAR --}}
                <div class="col-md-4 bg-light d-flex align-items-center justify-content-center p-3" style="border-radius: 15px 0 0 15px;">
                    <div class="text-center" id="img-placeholder">
                        <i class="bi bi-image" style="font-size: 3rem; color: #ccc;"></i>
                        <p class="small text-muted">Pilih alat untuk melihat gambar</p>
                    </div>
                    <img id="preview-img" src="" class="img-fluid rounded shadow-sm" style="max-height: 250px; object-fit: contain; display: none;">
                </div>

                {{-- KOLOM FORMULIR --}}
                <div class="col-md-8 p-4">
                    <form action="{{ route('peminjaman.siswa.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Peminjam</label>
                            <input type="text" name="nama_peminjam" class="form-control" value="{{ auth()->user()->name }}" required readonly>
                        </div>
                        
                        <div class="mb-3">
                            <label for="id_barang" class="form-label fw-bold">Pilih Alat</label>
                            <select name="id_barang" id="id_barang" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Alat --</option>
                                @foreach($barangs as $barang)
                                    <option value="{{ $barang->id_barang }}" data-foto="{{ $barang->foto_barang }}">
                                        {{ $barang->nama_barang }} (Tersedia: {{ $barang->stok_total }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Jumlah Pinjam</label>
                                <input type="number" name="jumlah_pinjam" class="form-control" min="1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tanggal Pinjam</label>
                                <input type="date" name="tgl_pinjam" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Catatan / Tujuan Peminjaman</label>
                            <textarea name="catatan" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dashboard.siswa') }}" class="btn btn-outline-secondary px-4 rounded-pill">Batal</a>
                            <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">Ajukan Peminjaman</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.getElementById('id_barang').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const fotoPath = selectedOption.getAttribute('data-foto'); // Isinya: "alat/AF6p..."
        const imgElement = document.getElementById('preview-img');
        const placeholder = document.getElementById('img-placeholder');

        if (fotoPath && fotoPath !== "NULL") {
            placeholder.style.display = 'none';
            // Menghapus "/alat" karena di database sudah ada kata "alat/"
            imgElement.src = "{{ asset('storage') }}/" + fotoPath; 
            imgElement.style.display = 'block';
        } else {
            placeholder.style.display = 'block';
            imgElement.style.display = 'none';
        }
    });
</script>