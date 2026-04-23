@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="text-center mb-4">
            <h4 class="fw-bold">FORM KUNJUNGAN TAMU</h4>
            <p class="text-muted">Workshop SMKN 1 Sindang</p>
        </div>

        <div class="card shadow border-0">
            <div class="card-header bg-success text-white text-center py-3">
                <h5 class="mb-0">Identitas Peminjam (Tamu)</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('dashboard.tamu') }}" method="GET">
                    {{-- Nama Tamu --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama instansi atau pribadi" required>
                    </div>

                    {{-- Jurusan atau Bagian --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jurusan / Bagian / Asal</label>
                        <input type="text" name="jurusan" class="form-control" placeholder="Contoh: Teknik Otomasi Industri" required>
                    </div>

                    <div class="alert alert-warning small">
                        <i class="bi bi-info-circle"></i> Data ini digunakan untuk pendataan inventaris workshop selama masa kunjungan/peminjaman.
                    </div>

                    <button type="submit" class="btn btn-success w-100 py-2 shadow-sm">
                        Masuk Dashboard Tamu
                    </button>
                </form>
            </div>
            <div class="card-footer bg-white border-0 text-center pb-4">
                <a href="/" class="text-decoration-none small text-muted">
                    <i class="bi bi-arrow-left"></i> Kembali ke Login Utama
                </a>
            </div>
        </div>
    </div>
</div>
@endsection