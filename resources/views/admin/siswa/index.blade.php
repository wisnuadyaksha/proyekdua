@extends('layouts.app')

@section('content')
<div class="container">
    {{-- TOMBOL KEMBALI --}}
    <div class="mb-3">
        <a href="{{ route('dashboard.admin') }}" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Manajemen Data Siswa & Guru</h4>
        <a href="{{ route('siswa.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah User
        </a>
    </div>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="px-4 py-3">No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>NIS / Email</th>
                            <th>Kelas</th>
                            <th>Role</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $item)
                        <tr class="align-middle">
                            <td class="px-4">{{ $index + 1 }}</td>
                            <td>
                                @if($item->foto)
                                    <img src="{{ asset('img/' . $item->foto) }}" alt="Foto {{ $item->name }}" class="rounded-circle shadow-sm" style="width: 40px; height: 40px; object-fit: cover; cursor: pointer;" onclick="showProfil('{{ asset('img/' . $item->foto) }}', '{{ $item->name }}', '{{ ucfirst($item->role) }}', '{{ $item->role === 'guru' ? $item->email : ($item->nis ?? '-') }}', '{{ $item->role === 'guru' ? 'Email' : 'NIS' }}', '{{ $item->class ?? '-' }}')">
                                @else
                                    <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white shadow-sm" style="width: 40px; height: 40px; cursor: pointer;" onclick="showProfil('', '{{ $item->name }}', '{{ ucfirst($item->role) }}', '{{ $item->role === 'guru' ? $item->email : ($item->nis ?? '-') }}', '{{ $item->role === 'guru' ? 'Email' : 'NIS' }}', '{{ $item->class ?? '-' }}')">
                                        <i class="bi bi-person-fill fs-5"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="fw-bold text-primary">{{ $item->name }}</td>
                            <td>{{ $item->nis ?? $item->email }}</td>
                            <td>
                                @if($item->role === 'guru')
                                    <span class="badge bg-warning text-dark">Pengajar</span>
                                @else
                                    <span class="badge bg-secondary">{{ $item->class ?? 'Admin Office' }}</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $item->role == 'admin' ? 'bg-danger' : ($item->role == 'guru' ? 'bg-warning text-dark' : 'bg-info text-dark') }}">
                                    {{ ucfirst($item->role) }}
                                </span>
                            </td>
                            <td class="text-center">
                                {{-- Tombol Edit --}}
                                <a href="{{ route('siswa.edit', $item->id) }}" class="btn btn-sm btn-light border">
                                    <i class="bi bi-pencil text-primary"></i>
                                </a>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('siswa.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Data user tidak ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- MODAL LIHAT PROFIL --}}
<div class="modal fade" id="profilModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow" style="border-radius: 15px; overflow: hidden;">
            <div class="modal-body text-center p-0">
                {{-- Header Warna --}}
                <div id="profilHeader" style="height: 80px; background: linear-gradient(135deg, #0d6efd, #6610f2);"></div>
                {{-- Foto --}}
                <div style="margin-top: -50px;">
                    <img id="profilImage" src="" alt="Foto Profil" class="rounded-circle shadow d-none" style="width: 100px; height: 100px; object-fit: cover; border: 4px solid #fff;">
                    <div id="profilNoImage" class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white mx-auto shadow d-none" style="width: 100px; height: 100px; border: 4px solid #fff;">
                        <i class="bi bi-person-fill" style="font-size: 2.5rem;"></i>
                    </div>
                </div>
                <div class="p-4 pt-2">
                    <h5 class="fw-bold mb-1" id="profilNama"></h5>
                    <span class="badge mb-3" id="profilRole"></span>
                    <hr>
                    <div class="text-start px-2">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-person-badge-fill text-primary me-2"></i>
                            <div>
                                <small class="text-muted d-block" id="profilIdLabel">NIS</small>
                                <span class="small fw-bold" id="profilIdValue"></span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-2" id="profilKelasRow">
                            <i class="bi bi-mortarboard-fill text-success me-2"></i>
                            <div>
                                <small class="text-muted d-block">Kelas</small>
                                <span class="small fw-bold" id="profilKelas"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center pt-0">
                <button type="button" class="btn btn-secondary btn-sm rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showProfil(fotoUrl, nama, role, idValue, idLabel, kelas) {
        var img = document.getElementById('profilImage');
        var noImg = document.getElementById('profilNoImage');
        var header = document.getElementById('profilHeader');
        var roleEl = document.getElementById('profilRole');

        // Foto
        if (fotoUrl && fotoUrl !== '') {
            img.src = fotoUrl;
            img.classList.remove('d-none');
            noImg.classList.add('d-none');
        } else {
            img.classList.add('d-none');
            noImg.classList.remove('d-none');
        }

        // Nama & Role
        document.getElementById('profilNama').innerText = nama;
        roleEl.innerText = role;
        roleEl.className = 'badge mb-3 ';
        if (role === 'Guru') {
            roleEl.className += 'bg-warning text-dark';
            header.style.background = 'linear-gradient(135deg, #ffc107, #ff9800)';
        } else if (role === 'Admin') {
            roleEl.className += 'bg-danger';
            header.style.background = 'linear-gradient(135deg, #dc3545, #c82333)';
        } else {
            roleEl.className += 'bg-primary';
            header.style.background = 'linear-gradient(135deg, #0d6efd, #6610f2)';
        }

        // ID (NIS/Email)
        document.getElementById('profilIdLabel').innerText = idLabel;
        document.getElementById('profilIdValue').innerText = idValue;

        // Kelas (sembunyikan untuk Guru)
        var kelasRow = document.getElementById('profilKelasRow');
        if (role === 'Guru') {
            kelasRow.style.display = 'none';
        } else {
            kelasRow.style.display = 'flex';
            document.getElementById('profilKelas').innerText = kelas;
        }

        var modal = new bootstrap.Modal(document.getElementById('profilModal'));
        modal.show();
    }
</script>
@endsection