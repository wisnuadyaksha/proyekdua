@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-3">
        <a href="{{ route('siswa.index') }}" class="text-decoration-none text-muted small">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="row justify-content-center">
        {{-- KOLOM KIRI: PROFIL USER --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow border-0 text-center" style="border-radius: 15px;">
                <div class="card-body p-4">
                    {{-- Foto Profil --}}
                    <div class="mb-3">
                        @if($siswa->foto)
                            <img src="{{ asset('img/' . $siswa->foto) }}" alt="Foto {{ $siswa->name }}" class="rounded-circle shadow" style="width: 120px; height: 120px; object-fit: cover; border: 4px solid {{ $siswa->role === 'guru' ? '#ffc107' : ($siswa->role === 'admin' ? '#dc3545' : '#0d6efd') }};">
                        @else
                            <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white mx-auto shadow" style="width: 120px; height: 120px; border: 4px solid {{ $siswa->role === 'guru' ? '#ffc107' : ($siswa->role === 'admin' ? '#dc3545' : '#0d6efd') }};">
                                <i class="bi bi-person-fill" style="font-size: 3rem;"></i>
                            </div>
                        @endif
                    </div>

                    {{-- Nama & Role --}}
                    <h5 class="fw-bold mb-1">{{ $siswa->name }}</h5>
                    <span class="badge {{ $siswa->role === 'guru' ? 'bg-warning text-dark' : ($siswa->role === 'admin' ? 'bg-danger' : 'bg-primary') }} mb-3">
                        {{ ucfirst($siswa->role) }}
                    </span>

                    <hr>

                    {{-- Detail Info --}}
                    <div class="text-start">
                        @if($siswa->role === 'guru')
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-envelope-fill text-warning me-2"></i>
                                <div>
                                    <small class="text-muted d-block">Email</small>
                                    <span class="small fw-bold">{{ $siswa->email }}</span>
                                </div>
                            </div>
                        @else
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-person-badge-fill text-primary me-2"></i>
                                <div>
                                    <small class="text-muted d-block">NIS</small>
                                    <span class="small fw-bold">{{ $siswa->nis ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-mortarboard-fill text-primary me-2"></i>
                                <div>
                                    <small class="text-muted d-block">Kelas</small>
                                    <span class="small fw-bold">{{ $siswa->class ?? '-' }}</span>
                                </div>
                            </div>
                        @endif

                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-calendar-event-fill text-success me-2"></i>
                            <div>
                                <small class="text-muted d-block">Terdaftar Sejak</small>
                                <span class="small fw-bold">{{ $siswa->created_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-clock-fill text-info me-2"></i>
                            <div>
                                <small class="text-muted d-block">Update Terakhir</small>
                                <span class="small fw-bold">{{ $siswa->updated_at->format('d M Y, H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: FORM EDIT --}}
        <div class="col-md-6 mb-4">
            <div class="card shadow border-0" style="border-radius: 15px;">
                <div class="card-header bg-white border-0 pt-4 pb-0">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning bg-opacity-10 p-2 rounded-3 me-3">
                            <i class="bi bi-pencil-square text-warning fs-4"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-0">Edit Data {{ ucfirst($siswa->role) }}</h4>
                            <p class="text-muted small mb-0">Perbarui informasi {{ $siswa->name }}</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-secondary">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control bg-light" value="{{ $siswa->name }}" required>
                        </div>

                        @if($siswa->role === 'guru')
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-secondary">Alamat Email</label>
                                <input type="email" name="email" class="form-control bg-light" value="{{ $siswa->email }}" required>
                            </div>
                        @else
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-secondary">NIS</label>
                                <input type="text" name="nis" class="form-control bg-light" value="{{ $siswa->nis }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-secondary">Kelas</label>
                                <select name="class" class="form-select bg-light" required>
                                    <option value="X TOI 1" {{ $siswa->class == 'X TOI 1' ? 'selected' : '' }}>X TOI 1</option>
                                    <option value="X TOI 2" {{ $siswa->class == 'X TOI 2' ? 'selected' : '' }}>X TOI 2</option>
                                    <option value="XI TOI 1" {{ $siswa->class == 'XI TOI 1' ? 'selected' : '' }}>XI TOI 1</option>
                                    <option value="XI TOI 2" {{ $siswa->class == 'XI TOI 2' ? 'selected' : '' }}>XI TOI 2</option>
                                    <option value="XII TOI 1" {{ $siswa->class == 'XII TOI 1' ? 'selected' : '' }}>XII TOI 1</option>
                                    <option value="XII TOI 2" {{ $siswa->class == 'XII TOI 2' ? 'selected' : '' }}>XII TOI 2</option>
                                    <option value="Staff" {{ $siswa->class == 'Staff' ? 'selected' : '' }}>Staff</option>
                                </select>
                            </div>
                        @endif

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-secondary">Reset Password (Opsional)</label>
                            <input type="text" name="password" class="form-control bg-light" placeholder="Isi jika ingin mereset password user ini">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
                        </div>

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