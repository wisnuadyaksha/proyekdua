@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        {{-- Profil Siswa --}}
        <div class="col-md-10 mb-4">
            <div class="card shadow-sm border-0 p-4" style="border-radius: 15px; background: white;">
                <div class="d-flex align-items-center">
                    <div class="me-4 position-relative">
                        @if(Auth::user()->foto)
                            <img src="{{ asset('img/' . Auth::user()->foto) }}" alt="Foto Profil" class="rounded-circle shadow" style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #0d6efd;">
                        @else
                            <div class="rounded-circle shadow d-flex justify-content-center align-items-center bg-primary text-white" style="width: 100px; height: 100px; font-size: 3rem; border: 3px solid #0d6efd;">
                                <i class="bi bi-person"></i>
                            </div>
                        @endif
                        <form action="{{ route('profile.foto.update') }}" method="POST" enctype="multipart/form-data" class="position-absolute" style="bottom: 0; right: 0;">
                            @csrf
                            <label for="foto-upload-siswa" class="btn btn-sm btn-light rounded-circle shadow p-1" style="cursor: pointer; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-pencil-fill text-primary" style="font-size: 0.8rem;"></i>
                            </label>
                            <input id="foto-upload-siswa" type="file" name="foto" class="d-none" accept="image/*" onchange="this.form.submit()">
                        </form>
                    </div>
                    <div>
                        <span class="badge bg-primary mb-2 px-3 py-2 rounded-pill">Siswa</span>
                        <h2 class="fw-bold text-dark mb-1">{{ Auth::user()->name }}</h2>
                        <p class="text-muted mb-1"><i class="bi bi-card-text me-2"></i>NIS: {{ Auth::user()->nis }}</p>
                        <p class="text-muted mb-2"><i class="bi bi-building me-2"></i>Kelas: {{ Auth::user()->class }}</p>
                        <button type="button" class="btn btn-sm btn-outline-primary rounded-pill mt-1" data-bs-toggle="modal" data-bs-target="#editProfilModalSiswa">
                            <i class="bi bi-pencil-square me-1"></i> Edit Profil
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Menu Pinjam Alat --}}
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm border-0 h-100 p-4 text-center" style="border-radius: 15px;">
                <div class="card-body d-flex flex-column">
                    <i class="bi bi-tools text-primary mb-3" style="font-size: 3rem;"></i>
                    <h4 class="fw-bold">Pinjam Alat</h4>
                    <p class="text-muted small">Klik untuk mulai meminjam alat praktikum sekolah.</p>
                    <a href="{{ route('peminjaman.siswa') }}" class="btn btn-primary w-100 rounded-pill mt-auto">Mulai</a>
                </div>
            </div>
        </div>

        {{-- Menu Riwayat --}}
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm border-0 h-100 p-4 text-center" style="border-radius: 15px;">
                <div class="card-body d-flex flex-column">
                    <i class="bi bi-clock-history text-success mb-3" style="font-size: 3rem;"></i>
                    <h4 class="fw-bold">Riwayat Saya</h4>
                    <p class="text-muted small">Pantau status persetujuan dan history peminjaman Anda.</p>
                    <a href="{{ route('peminjaman.riwayat'); }}" class="btn btn-success w-100 rounded-pill mt-auto">Cek Riwayat</a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL EDIT PROFIL SISWA --}}
<div class="modal fade" id="editProfilModalSiswa" tabindex="-1" aria-labelledby="editProfilModalSiswaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editProfilModalSiswaLabel"><i class="bi bi-person-lines-fill me-2"></i>Edit Profil Siswa</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('profile.biodata.update') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">NIS</label>
                        <input type="text" class="form-control" name="nis" value="{{ Auth::user()->nis }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kelas</label>
                        <input type="text" class="form-control" name="class" value="{{ Auth::user()->class }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection