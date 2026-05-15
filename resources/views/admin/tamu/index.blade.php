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
                        <th>Instansi & Keperluan</th>
                        <th>No. Telepon</th>
                        <th>Tanggal</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop data dari Controller --}}
                    @forelse($tamus as $index => $tamu)
                    <tr class="align-middle">
                        <td class="px-4 text-muted">{{ $index + 1 }}</td>
                        <td class="fw-bold">{{ $tamu->nama_tamu }}</td>
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
                        <td class="text-center">
                            <span class="badge bg-success bg-opacity-10 text-success">Selesai</span>
                        </td>
                    </tr>
                    @empty
                    {{-- Tampilan kalau data kosong --}}
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
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
@endsection