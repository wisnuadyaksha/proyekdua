@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    {{-- TOMBOL KEMBALI --}}
    <div class="mb-3">
        <a href="{{ route('dashboard.admin') }}" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
    </div>
    <h4 class="fw-bold">Data Tamu / Kunjungan</h4>
    <span class="badge bg-primary rounded-pill">{{ $tamus->count() }} Total Tamu</span>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th>Nama Tamu</th>
                        <th>KTP / Identitas</th>
                        <th>Jurusan & Keperluan</th>
                        <th>No. Telepon</th>
                        <th>Tanggal</th>
                        <th>Tgl Kembali</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop data dari Controller --}}
                    @forelse($tamus as $index => $tamu)
                    @php
                        // Mencari data peminjaman terakhir berdasarkan nama tamu
                        $peminjamanTamu = \App\Models\Peminjaman::where('nama_tamu', $tamu->nama_tamu)->latest()->first();
                    @endphp
                    <tr class="align-middle">
                        <td class="px-4 text-muted">{{ $index + 1 }}</td>
                        <td class="fw-bold">{{ $tamu->nama_tamu }}</td>
                        <td>
                            @if($peminjamanTamu && $peminjamanTamu->foto_ktp)
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ asset('img/' . $peminjamanTamu->foto_ktp) }}" alt="KTP" class="rounded border shadow-sm" style="width: 50px; height: 35px; object-fit: cover; cursor: pointer;" onclick="showKtpTamu('{{ asset('img/' . $peminjamanTamu->foto_ktp) }}', '{{ $tamu->nama_tamu }}')">
                                    <a href="javascript:void(0)" onclick="showKtpTamu('{{ asset('img/' . $peminjamanTamu->foto_ktp) }}', '{{ $tamu->nama_tamu }}')" class="badge bg-primary text-decoration-none">
                                        <i class="bi bi-person-vcard"></i> Lihat
                                    </a>
                                </div>
                            @else
                                <span class="badge bg-secondary"><i class="bi bi-dash-circle"></i> Tidak Ada</span>
                            @endif
                        </td>
                        <td>
                            <div class="fw-bold small text-primary">{{ $tamu->instansi }}</div>
                            <div class="text-muted small">{{ $tamu->keperluan }}</div>
                        </td>
                        <td>{{ $tamu->telepon }}</td>
                        <td>
                            {{-- Format tanggal Indonesia --}}
                            <div class="small">{{ $tamu->created_at->format('d M Y') }}</div>
                            <div class="text-muted" style="font-size: 0.75rem;">{{ $tamu->created_at->format('H:i') }} WIB</div>
                        </td>
                        <td>
                            @if($peminjamanTamu)
                                @if($peminjamanTamu->status == 'Habis Pakai')
                                    <span class="text-muted">-</span>
                                @else
                                    <span class="small">{{ $peminjamanTamu->tgl_kembali ? \Carbon\Carbon::parse($peminjamanTamu->tgl_kembali)->format('d M Y') : '-' }}</span>
                                @endif
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($peminjamanTamu)
                                @if($peminjamanTamu->status == 'Menunggu Persetujuan')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @elseif($peminjamanTamu->status == 'Dipinjam')
                                    <span class="badge bg-primary">Dipinjam</span>
                                @elseif($peminjamanTamu->status == 'Dikembalikan')
                                    <span class="badge bg-success">Dikembalikan</span>
                                @elseif($peminjamanTamu->status == 'Ditolak')
                                    <span class="badge bg-danger">Ditolak</span>
                                @elseif($peminjamanTamu->status == 'Habis Pakai')
                                    <span class="badge bg-secondary">Habis Pakai</span>
                                @else
                                    <span class="badge bg-info">{{ $peminjamanTamu->status }}</span>
                                @endif
                            @else
                                <span class="badge bg-success bg-opacity-10 text-success">Selesai Kunjungan</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    {{-- Tampilan kalau data kosong --}}
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">
                            <i class="bi bi-people fs-1 d-block mb-2"></i>
                            Belum ada data tamu terdaftar hari ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL PREVIEW FOTO KTP TAMU --}}
<div class="modal fade" id="ktpTamuModal" tabindex="-1" aria-labelledby="ktpTamuModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="ktpTamuModalLabel"><i class="bi bi-person-vcard me-2"></i>Foto KTP / Identitas Tamu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-4">
                <p class="mb-2 fw-bold" id="ktpTamuNama"></p>
                <img id="ktpTamuImage" src="" alt="Foto KTP" class="img-fluid rounded shadow" style="max-height: 500px;">
            </div>
            <div class="modal-footer">
                <a id="ktpTamuDownloadLink" href="" target="_blank" class="btn btn-outline-primary"><i class="bi bi-box-arrow-up-right me-1"></i> Buka di Tab Baru</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showKtpTamu(imageUrl, namaTamu) {
        document.getElementById('ktpTamuImage').src = imageUrl;
        document.getElementById('ktpTamuNama').innerText = 'Identitas milik: ' + namaTamu;
        document.getElementById('ktpTamuDownloadLink').href = imageUrl;
        var modal = new bootstrap.Modal(document.getElementById('ktpTamuModal'));
        modal.show();
    }
</script>
@endsection