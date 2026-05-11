@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Alat Workshop</h3>
        <a href="{{ route('barang.create') }}" class="btn btn-success"> Tambah Alat</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-hover border">
        <thead class="table-dark">
            <tr>
                <th>Foto</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Stok (Total/Tersedia)</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alats as $item)
            <tr>
                <td>
                    @if($item->foto_barang)
                        <img src="{{ asset('storage/'.$item->foto_barang) }}" width="50">
                    @else
                        <span class="text-muted">No Photo</span>
                    @endif
                </td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->kategori }}</td>
                <td>{{ $item->stok_total }} / {{ $item->stok_tersedia }}</td>
                <td>
                    <form action="{{ route('barang.destroy', $item->id_barang) }}" method="POST">
                        <a href="{{ route('barang.edit', $item->id_barang) }}" class="btn btn-warning btn-sm">Edit</a>
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus alat ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection