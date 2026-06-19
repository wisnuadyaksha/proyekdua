@extends('layouts.app')

@section('content')
<div class="container mt-4">
    {{-- TOMBOL KEMBALI --}}
    <div class="mb-3">
        <a href="{{ route('dashboard.admin') }}" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
    </div>
    <h3 class="fw-bold mb-4">Persetujuan Peminjaman Alat</h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-x-circle-fill me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Peminjam</th>
                        <th>Identitas</th>
                        <th>Alat</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
    @forelse($pinjamans as $p)
    <tr>
        <td>{{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d M Y') }}</td>
        <td>
            <div class="fw-bold">{{ $p->siswa->name ?? $p->nama_tamu }}</div>
            <small class="text-muted">
                {{ $p->id_siswa && $p->siswa ? ucfirst($p->siswa->role) : 'Tamu' }} | {{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d M Y') }}
            </small>
        </td>
        <td>
            {{-- Kolom Identitas: Foto KTP untuk Tamu, Foto Profil untuk Siswa/Guru --}}
            @if(!$p->id_siswa && $p->foto_ktp)
                <div class="d-flex align-items-center gap-2">
                    <img src="{{ asset('img/' . $p->foto_ktp) }}" alt="KTP" class="rounded border shadow-sm" style="width: 50px; height: 35px; object-fit: cover; cursor: pointer;" onclick="showKtp('{{ asset('img/' . $p->foto_ktp) }}', '{{ $p->nama_tamu }}')">
                    <div>
                        <a href="javascript:void(0)" onclick="showKtp('{{ asset('img/' . $p->foto_ktp) }}', '{{ $p->nama_tamu }}')" class="badge bg-primary text-decoration-none">
                            <i class="bi bi-person-vcard"></i> Lihat KTP
                        </a>
                    </div>
                </div>
            @elseif(!$p->id_siswa)
                <span class="badge bg-danger"><i class="bi bi-exclamation-triangle"></i> Tanpa KTP</span>
            @elseif($p->id_siswa && $p->siswa && $p->siswa->foto)
                <img src="{{ asset('img/' . $p->siswa->foto) }}" alt="Foto Profil" class="rounded-circle shadow-sm" style="width: 35px; height: 35px; object-fit: cover;">
            @else
                <div class="rounded-circle bg-secondary d-flex align-items-center justify-content-center text-white" style="width: 35px; height: 35px;">
                    <i class="bi bi-person-fill"></i>
                </div>
            @endif
        </td>
        <td>{{ $p->barang->nama_barang ?? 'Alat Tidak Ditemukan' }}</td>
        <td>{{ $p->jumlah_pinjam }}</td>
        <td>
            <span class="badge {{ $p->status == 'Menunggu Persetujuan' ? 'bg-warning' : 'bg-info' }}">
                {{ $p->status }}
            </span>
        </td>
        <td class="text-center">
            <div class="d-flex justify-content-center gap-2">
                {{-- Form Setujui --}}
                <form action="{{ route('persetujuan.update', $p->id_peminjaman) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="Dipinjam">
                    <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-check-lg"></i> Setujui</button>
                </form>

                {{-- Form Tolak --}}
                <form action="{{ route('persetujuan.update', $p->id_peminjaman) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="Ditolak">
                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-x-lg"></i> Tolak</button>
                </form>
            </div>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="7" class="text-center py-5 text-muted">
            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
            Tidak ada permintaan peminjaman yang menunggu persetujuan.
        </td>
    </tr>
    @endforelse
</tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL PREVIEW FOTO KTP --}}
<div class="modal fade" id="ktpModal" tabindex="-1" aria-labelledby="ktpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="ktpModalLabel"><i class="bi bi-person-vcard me-2"></i>Foto KTP / Identitas</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-4">
                <p class="mb-2 fw-bold" id="ktpNamaTamu"></p>
                <img id="ktpImage" src="" alt="Foto KTP" class="img-fluid rounded shadow" style="max-height: 500px;">
            </div>
            <div class="modal-footer">
                <a id="ktpDownloadLink" href="" target="_blank" class="btn btn-outline-primary"><i class="bi bi-box-arrow-up-right me-1"></i> Buka di Tab Baru</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<style>
    .table thead th {
        border-top: none;
        padding: 15px 10px;
        font-weight: 600;
    }
    .table tbody td {
        padding: 15px 10px;
    }
</style>

<script>
    function showKtp(imageUrl, namaTamu) {
        document.getElementById('ktpImage').src = imageUrl;
        document.getElementById('ktpNamaTamu').innerText = 'Identitas milik: ' + namaTamu;
        document.getElementById('ktpDownloadLink').href = imageUrl;
        var modal = new bootstrap.Modal(document.getElementById('ktpModal'));
        modal.show();
    }
</script>
@endsection