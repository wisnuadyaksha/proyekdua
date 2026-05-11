@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            {{-- Tombol Kembali --}}
            <div class="mb-3">
                <a href="{{ route('siswa.index') }}" class="text-decoration-none text-muted small">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                </a>
            </div>

            <div class="card shadow border-0" style="border-radius: 15px;">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 p-2 rounded-3 me-3">
                            <i class="bi bi-pencil-square text-warning fs-4"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0">Edit Data Siswa</h4>
                            <p class="text-muted small mb-0">Perbarui informasi siswa yang terpilih</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    {{-- Form Update --}}
                    <form action="{{ route('siswa.update', $siswa->id_siswa) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- PENTING: Laravel butuh ini untuk proses Update --}}
                        
                        {{-- Nama --}}
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control bg-light" value="{{ $siswa->nama_siswa }}" required>
                        </div>

                        {{-- NIS --}}
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">NIS</label>
                            <input type="number" name="nis" class="form-control bg-light" value="{{ $siswa->nis }}" required>
                        </div>

                        {{-- Kelas --}}
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-secondary">Kelas</label>
                            <select name="class" class="form-select bg-light" required>
                                <option value="XI TOI 1" {{ $siswa->kelas == 'XI TOI 1' ? 'selected' : '' }}>XI TOI 1</option>
                                <option value="XI TOI 2" {{ $siswa->kelas == 'XI TOI 2' ? 'selected' : '' }}>XI TOI 2</option>
                                <option value="XII TOI 1" {{ $siswa->kelas == 'XII TOI 1' ? 'selected' : '' }}>XII TOI 1</option>
                                <option value="XII TOI 2" {{ $siswa->kelas == 'XII TOI 2' ? 'selected' : '' }}>XII TOI 2</option>
                            </select>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning btn-lg rounded-pill fw-bold shadow-sm">
                                <i class="bi bi-check-circle-fill me-2"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('siswa.index') }}" class="btn btn-link btn-sm text-decoration-none text-muted">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection