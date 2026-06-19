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
            <h3 class="fw-bold mb-1"><i class="bi bi-calendar3 me-2"></i>Rekap Peminjaman Bulanan</h3>
            <p class="text-muted mb-0">Rekapitulasi peminjaman alat periode <strong>{{ $namaBulan }}</strong></p>
        </div>
        <button onclick="window.print()" class="btn btn-dark shadow-sm d-print-none">
            <i class="bi bi-printer me-1"></i> Cetak Rekap
        </button>
    </div>

    {{-- FILTER BULAN & TAHUN --}}
    <div class="card shadow-sm border-0 mb-4 d-print-none">
        <div class="card-body">
            <form method="GET" action="{{ route('laporan.rekap') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
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
                <div class="col-md-4">
                    <label for="tahun" class="form-label fw-semibold">
                        <i class="bi bi-calendar-range me-1"></i>Pilih Tahun
                    </label>
                    <select name="tahun" id="tahun" class="form-select">
                        @for($y = date('Y'); $y >= date('Y') - 5; $y--)
                            <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-warning fw-bold w-100">
                        <i class="bi bi-funnel me-1"></i> Tampilkan Rekap
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- STATISTIK CARDS --}}
    <div class="row mb-4">
        <div class="col-6 col-md-4 col-lg-2 mb-3">
            <div class="card border-0 shadow-sm h-100 text-center" style="border-left: 4px solid #0d6efd !important;">
                <div class="card-body py-3 px-2">
                    <h2 class="fw-bold text-primary mb-1">{{ $totalPeminjaman }}</h2>
                    <small class="text-muted fw-semibold">Total Pinjam</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2 mb-3">
            <div class="card border-0 shadow-sm h-100 text-center" style="border-left: 4px solid #198754 !important;">
                <div class="card-body py-3 px-2">
                    <h2 class="fw-bold text-success mb-1">{{ $totalDikembalikan }}</h2>
                    <small class="text-muted fw-semibold">Dikembalikan</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2 mb-3">
            <div class="card border-0 shadow-sm h-100 text-center" style="border-left: 4px solid #0dcaf0 !important;">
                <div class="card-body py-3 px-2">
                    <h2 class="fw-bold text-info mb-1">{{ $totalDipinjam }}</h2>
                    <small class="text-muted fw-semibold">Dipinjam</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2 mb-3">
            <div class="card border-0 shadow-sm h-100 text-center" style="border-left: 4px solid #6c757d !important;">
                <div class="card-body py-3 px-2">
                    <h2 class="fw-bold text-secondary mb-1">{{ $totalHabisPakai }}</h2>
                    <small class="text-muted fw-semibold">Habis Pakai</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2 mb-3">
            <div class="card border-0 shadow-sm h-100 text-center" style="border-left: 4px solid #ffc107 !important;">
                <div class="card-body py-3 px-2">
                    <h2 class="fw-bold text-warning mb-1">{{ $totalMenunggu }}</h2>
                    <small class="text-muted fw-semibold">Menunggu</small>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-lg-2 mb-3">
            <div class="card border-0 shadow-sm h-100 text-center" style="border-left: 4px solid #dc3545 !important;">
                <div class="card-body py-3 px-2">
                    <h2 class="fw-bold text-danger mb-1">{{ $totalDitolak }}</h2>
                    <small class="text-muted fw-semibold">Ditolak</small>
                </div>
            </div>
        </div>
    </div>

    {{-- TOP ALAT & TOP PEMINJAM --}}
    <div class="row mb-4">
        {{-- ALAT TERPOPULER --}}
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-dark text-white fw-bold">
                    <i class="bi bi-trophy me-1"></i> Top 5 Alat Paling Sering Dipinjam
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">#</th>
                                <th>Nama Alat</th>
                                <th class="text-center">Frekuensi</th>
                                <th class="text-center">Total Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($alatPopuler as $index => $alat)
                            <tr>
                                <td class="ps-3">
                                    @if($loop->iteration == 1)
                                        <span class="badge bg-warning text-dark">🥇</span>
                                    @elseif($loop->iteration == 2)
                                        <span class="badge bg-secondary">🥈</span>
                                    @elseif($loop->iteration == 3)
                                        <span class="badge bg-danger">🥉</span>
                                    @else
                                        {{ $loop->iteration }}
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $alat['nama'] }}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary rounded-pill">{{ $alat['jumlah'] }}x</span>
                                </td>
                                <td class="text-center">{{ $alat['total_qty'] }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">Belum ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- PEMINJAM PALING AKTIF --}}
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-dark text-white fw-bold">
                    <i class="bi bi-person-lines-fill me-1"></i> Top 5 Peminjam Paling Aktif
                </div>
                <div class="card-body p-0">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">#</th>
                                <th>Nama</th>
                                <th>Tipe</th>
                                <th class="text-center">Jumlah Pinjam</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($peminjamAktif as $index => $org)
                            <tr>
                                <td class="ps-3">
                                    @if($loop->iteration == 1)
                                        <span class="badge bg-warning text-dark">🥇</span>
                                    @elseif($loop->iteration == 2)
                                        <span class="badge bg-secondary">🥈</span>
                                    @elseif($loop->iteration == 3)
                                        <span class="badge bg-danger">🥉</span>
                                    @else
                                        {{ $loop->iteration }}
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-semibold">{{ $org['nama'] }}</span>
                                    @if($org['kelas'] != '-')
                                        <br><small class="text-muted">{{ $org['kelas'] }}</small>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $org['tipe'] == 'Siswa' ? 'bg-info' : 'bg-secondary' }}">
                                        {{ $org['tipe'] }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-primary rounded-pill">{{ $org['jumlah'] }}x</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">Belum ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- TABEL DETAIL REKAP --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white fw-bold">
            <i class="bi bi-table me-1"></i> Detail Peminjaman - {{ $namaBulan }}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Peminjam</th>
                            <th>Alat</th>
                            <th>Jumlah</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekaps as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if($item->id_siswa && $item->siswa)
                                    <span class="fw-bold text-primary">{{ $item->siswa->name }}</span>
                                    <br><small class="text-muted">{{ $item->siswa->class }}</small>
                                @else
                                    {{ $item->nama_tamu ?? 'Umum/Tamu' }}
                                @endif
                            </td>
                            <td>{{ $item->barang->nama_barang ?? 'Alat Dihapus' }}</td>
                            <td>{{ $item->jumlah_pinjam }} {{ $item->barang->satuan ?? '' }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_pinjam)->format('d-m-Y') }}</td>
                            <td>
                                @if($item->status == 'Habis Pakai')
                                    <span class="text-muted">-</span>
                                @else
                                    {{ $item->tgl_kembali ? \Carbon\Carbon::parse($item->tgl_kembali)->format('d-m-Y') : '-' }}
                                @endif
                            </td>
                            <td>
                                @php
                                    $badgeClass = 'bg-warning text-dark';
                                    if($item->status == 'Dikembalikan') $badgeClass = 'bg-success';
                                    if($item->status == 'Ditolak') $badgeClass = 'bg-danger';
                                    if($item->status == 'Dipinjam') $badgeClass = 'bg-info text-dark';
                                    if($item->status == 'Habis Pakai') $badgeClass = 'bg-secondary';
                                @endphp
                                <span class="badge {{ $badgeClass }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="bi bi-inbox text-muted" style="font-size: 2rem;"></i>
                                <p class="text-muted mt-2 mb-0">Tidak ada data peminjaman pada bulan <strong>{{ $namaBulan }}</strong>.</p>
                            </td>
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
