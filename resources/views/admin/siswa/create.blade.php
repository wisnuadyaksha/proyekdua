@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            {{-- Tombol Kembali --}}
            <div class="mb-3">
                <a href="{{ route('siswa.index') }}" class="text-decoration-none text-muted small">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Siswa
                </a>
            </div>

            <div class="card shadow border-0 overflow-hidden" style="border-radius: 15px;">
                {{-- Header Card dengan gradien tipis --}}
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                            <i class="bi bi-person-plus-fill text-primary fs-4"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0">Tambah Siswa</h4>
                            <p class="text-muted small mb-0">Lengkapi data siswa untuk akses peminjaman</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    {{-- Form mengarah ke route siswa.store yang sudah kita buat di web.php --}}
                    <form action="{{ route('siswa.store') }}" method="POST">
                        @csrf
                        
                        {{-- Input Nama --}}
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Nama Lengkap Siswa</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-person text-muted"></i></span>
                                <input type="text" name="name" class="form-control bg-light border-start-0" placeholder="Contoh: Wisnu Adyaksha" required>
                            </div>
                        </div>

                        {{-- Input NIS --}}
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Nomor Induk Siswa (NIS)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-card-list text-muted"></i></span>
                                <input type="number" name="nis" class="form-control bg-light border-start-0" placeholder="Masukkan 8 digit NIS" required>
                            </div>
                        </div>

                        {{-- Input Kelas --}}
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Kelas / Jurusan</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-mortarboard text-muted"></i></span>
                                <select name="class" class="form-select bg-light border-start-0" required>
                                    <option value="" selected disabled>Pilih Kelas...</option>
                                    <option value="X TOI 1">X TOI 1</option>
                                    <option value="X TOI 2">X TOI 2</option>
                                    <option value="XI TOI 1">XI TOI 1</option>
                                    <option value="XI TOI 2">XI TOI 2</option>
                                    <option value="XII TOI 1">XII TOI 1</option>
                                    <option value="XII TOI 2">XII TOI 2</option>
                                </select>
                            </div>
                        </div>

                        {{-- Input Password --}}
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-secondary">Password Akun (Otomatis & Bisa Diubah)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-key text-muted"></i></span>
                                <input type="text" name="password" class="form-control bg-light border-start-0" value="siswa123" required>
                            </div>
                            <small class="text-muted d-block mt-1">Default: <b>siswa123</b>. Bisa diganti jika ingin.</small>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold shadow-sm">
                                <i class="bi bi-cloud-arrow-up-fill me-2"></i> Simpan Data Siswa
                            </button>
                            <button type="reset" class="btn btn-link btn-sm text-decoration-none text-muted">Reset Input</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Info Alert --}}
            <div class="alert alert-info border-0 shadow-sm mt-4 d-flex align-items-center" style="border-radius: 12px;">
                <i class="bi bi-info-circle-fill me-3 fs-4"></i>
                <small>Pastikan data yang dimasukkan sudah sesuai dengan buku induk sekolah untuk menghindari kesalahan laporan.</small>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling tambahan biar makin cakep */
    .form-control:focus, .form-select:focus {
        background-color: #fff !important;
        border-color: #0d6efd;
        box-shadow: none;
    }
    .input-group-text {
        border: 1px solid #dee2e6;
    }
    .card {
        background: #ffffff;
    }
    body {
        background-color: #f8f9fa;
    }
</style>
@endsection