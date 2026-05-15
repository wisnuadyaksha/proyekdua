@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    {{-- TOMBOL KEMBALI --}}
    <div class="mb-3">
        <a href="{{ route('dashboard.admin') }}" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
    </div>
    <h4 class="fw-bold">Manajemen Inventaris Barang</h4>
    <a href="{{ route('barang.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Barang
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th>Foto</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok (Total/Tersedia)</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($barangs as $index => $item)
                    <tr class="align-middle">
                        <td class="px-4">{{ $index + 1 }}</td>
                        <td>
                            @if($item->foto_barang)
                                {{-- Di index.blade.php --}}
                            <img src="{{ asset('storage/' . $item->foto_barang) }}" alt="foto" width="50" class="rounded">
                            @else
                                <span class="text-muted small">No Photo</span>
                            @endif
                        </td>
                        <td class="fw-bold text-primary">{{ $item->nama_barang }}</td>
                        <td><span class="badge bg-info text-dark">{{ $item->kategori }}</span></td>
                        {{-- Sesuaikan dengan nama kolom di database kamu (stok_total & stok_tersedia) --}}
                        <td>{{ $item->stok_total }} / <b class="text-success">{{ $item->stok_tersedia }}</b></td>
                        <td class="text-center">
                            {{-- Gunakan id_barang sebagai primary key sesuai model --}}
                            <a href="{{ route('barang.edit', $item->id_barang) }}" class="btn btn-sm btn-light border">
                                <i class="bi bi-pencil text-primary"></i>
                            </a>
                            
                            <form action="{{ route('barang.destroy', $item->id_barang) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus barang ini?')">
                                @csrf 
                                @method('DELETE')
                                <button class="btn btn-sm btn-light border">
                                    <i class="bi bi-trash text-danger"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Belum ada data barang.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection