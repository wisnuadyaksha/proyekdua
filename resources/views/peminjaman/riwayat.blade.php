@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4>Riwayat Peminjaman Alat</h4>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Nama Alat</th>
                <th>Jumlah</th>
                <th>Tanggal Pinjam</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($riwayats as $row)
            <tr>
                <td>{{ $row->barang->nama_barang }}</td>
                <td>{{ $row->jumlah_pinjam }}</td>
                <td>{{ $row->tgl_pinjam }}</td>
                <td>
                    <span class="badge {{ $row->status == 'Dipinjam' ? 'bg-warning' : 'bg-success' }}">
                        {{ $row->status }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection