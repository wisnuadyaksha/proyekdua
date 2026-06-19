@extends('layouts.app')

@section('content')
<div class="container mt-4">
    {{-- TOMBOL KEMBALI --}}
    <div class="mb-3 d-print-none">
        <a href="{{ route('dashboard.admin') }}" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
    </div>

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h3 class="fw-bold mb-1"><i class="bi bi-file-earmark-bar-graph me-2"></i>Laporan & Rekap Peminjaman</h3>
            <p class="text-muted mb-0">Periode <strong>{{ $namaBulan }}</strong></p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('laporan.export', ['bulan' => $bulan, 'tahun' => $tahun, 'minggu' => $minggu]) }}" class="btn btn-success shadow-sm d-print-none">
                <i class="bi bi-file-earmark-excel me-1"></i> Export Excel (CSV)
            </a>
            <button onclick="window.print()" class="btn btn-dark shadow-sm d-print-none">
                <i class="bi bi-printer me-1"></i> Cetak PDF
            </button>
        </div>
    </div>

    {{-- FILTER BULAN & TAHUN --}}
    <div class="card shadow-sm border-0 mb-4 d-print-none">
        <div class="card-body">
            <form method="GET" action="{{ route('laporan.index') }}" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label for="bulan" class="form-label fw-semibold">
                        <i class="bi bi-calendar-month me-1"></i>Pilih Bulan
                    </label>
                    <select name="bulan" id="bulan" class="form-select">
                        @php
                            $namaBulans = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                        @endphp
                        @foreach($namaBulans as $i => $nama)
                            <option value="{{ $i + 1 }}" {{ $bulan == ($i + 1) ? 'selected' : '' }}>{{ $nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="tahun" class="form-label fw-semibold">
                        <i class="bi bi-calendar-range me-1"></i>Pilih Tahun
                    </label>
                    <select name="tahun" id="tahun" class="form-select">
                        @for($y = date('Y'); $y >= date('Y') - 5; $y--)
                            <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="minggu" class="form-label fw-semibold">
                        <i class="bi bi-calendar-week me-1"></i>Pilih Minggu
                    </label>
                    <select name="minggu" id="minggu" class="form-select">
                        <option value="semua" {{ $minggu == 'semua' ? 'selected' : '' }}>Semua Minggu</option>
                        <option value="1" {{ $minggu == '1' ? 'selected' : '' }}>Minggu 1 (Tgl 1-7)</option>
                        <option value="2" {{ $minggu == '2' ? 'selected' : '' }}>Minggu 2 (Tgl 8-14)</option>
                        <option value="3" {{ $minggu == '3' ? 'selected' : '' }}>Minggu 3 (Tgl 15-21)</option>
                        <option value="4" {{ $minggu == '4' ? 'selected' : '' }}>Minggu 4 (Tgl 22-28)</option>
                        <option value="5" {{ $minggu == '5' ? 'selected' : '' }}>Minggu 5 (Tgl 29-Akhir)</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-warning fw-bold w-100">
                        <i class="bi bi-funnel me-1"></i> Tampilkan
                    </button>
                </div>
            </form>
        </div>
    </div>





    {{-- TABEL DETAIL PEMINJAMAN (EXCEL STYLE) --}}
    <div class="card shadow-sm border border-secondary mb-5">
        <div class="card-header bg-success text-white fw-bold d-flex justify-content-between align-items-center">
            <span><i class="bi bi-file-earmark-spreadsheet me-1"></i> Data Rekapitulasi ({{ $minggu == 'semua' ? 'Semua Minggu' : 'Minggu Ke-'.$minggu }})</span>
            <span class="badge bg-white text-success">{{ count($laporans) }} Baris</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive" style="max-height: 600px; overflow-y: auto;">
                <table class="table table-bordered table-hover table-sm align-middle mb-0" style="font-size: 0.9rem;">
                    <thead class="table-light sticky-top" style="z-index: 1;">
                        <tr class="text-center">
                            <th style="width: 50px;">No</th>
                            <th style="width: 120px;">Tgl Pinjam</th>
                            <th>Peminjam</th>
                            <th>Role / Kelas</th>
                            <th>Rincian Alat & Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $groupedLaporans = $laporans->groupBy(function($item) {
                                $identifier = $item->id_siswa ? 'siswa_'.$item->id_siswa : 'tamu_'.$item->nama_tamu;
                                return $identifier . '_' . \Carbon\Carbon::parse($item->tgl_pinjam)->format('Y-m-d');
                            });
                            $nomor = 1;
                        @endphp

                        @forelse($groupedLaporans as $key => $group)
                        @php $first = $group->first(); @endphp
                        <tr>
                            <td class="text-center">{{ $nomor++ }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($first->tgl_pinjam)->format('d-m-Y') }}</td>
                            <td>
                                @if($first->id_siswa && $first->siswa)
                                    {{ $first->siswa->name }}
                                @elseif($first->id_siswa && !$first->siswa)
                                    <span class="text-danger">User Dihapus</span>
                                @else
                                    {{ $first->nama_tamu ?? 'Umum/Tamu' }}
                                @endif
                            </td>
                            <td class="text-center">
                                @if($first->id_siswa && $first->siswa)
                                    @if($first->siswa->role === 'guru')
                                        <span class="badge bg-warning text-dark"><i class="bi bi-person-badge"></i> Guru</span>
                                    @else
                                        Siswa - {{ $first->siswa->class ?? '-' }}
                                    @endif
                                @elseif($first->id_siswa && !$first->siswa)
                                    <span class="badge bg-secondary">Tidak Diketahui</span>
                                @else
                                    Umum/Tamu
                                @endif
                            </td>
                            <td>
                                <ul class="mb-0 ps-3">
                                    @foreach($group as $item)
                                        @php
                                            $badgeClass = 'bg-warning text-dark';
                                            if($item->status == 'Dikembalikan') $badgeClass = 'bg-success';
                                            if($item->status == 'Ditolak') $badgeClass = 'bg-danger';
                                            if($item->status == 'Dipinjam') $badgeClass = 'bg-info text-dark';
                                            if($item->status == 'Habis Pakai') $badgeClass = 'bg-secondary';
                                            
                                            $tglKembali = in_array($item->status, ['Habis Pakai', 'Ditolak']) ? '' : ($item->tgl_kembali ? ' (Kembali: ' . \Carbon\Carbon::parse($item->tgl_kembali)->format('d-m-Y') . ')' : '');
                                        @endphp
                                        <li>
                                            {{ $item->barang->nama_barang ?? 'Alat Dihapus' }} 
                                            <strong>({{ $item->jumlah_pinjam }} {{ $item->barang->satuan ?? '' }})</strong> 
                                            - <span class="badge {{ $badgeClass }}">{{ $item->status }}</span>
                                            <span class="text-muted small">{{ $tglKembali }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-3 text-muted">Belum ada data peminjaman di periode ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- FOOTER REKAP (untuk cetakan) --}}
    <div class="mt-4 d-none d-print-block">
        <div class="row mt-5">
            <div class="col-6"></div>
            <div class="col-6 text-center">
                <p>Sindang, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p>Penanggung Jawab,</p>
                <br><br><br>
                <p class="fw-bold" style="border-bottom: 1px solid #000; display: inline-block;">(...........................)</p>
            </div>
        </div>
    </div>
</div>

{{-- CSS CETAK --}}
<style>
    @media print {
        .btn, .d-print-none, nav, .navbar { display: none !important; }
        .card { box-shadow: none !important; border: 1px solid #dee2e6 !important; }
        body { background-color: white !important; font-size: 12px; }
        .container { max-width: 100% !important; }
        .card-header { background-color: #f8f9fa !important; color: #000 !important; -webkit-print-color-adjust: exact; }
        .badge { border: 1px solid #ccc; }
        .table-dark th { background-color: #343a40 !important; color: white !important; -webkit-print-color-adjust: exact; }
    }
</style>
@endsection