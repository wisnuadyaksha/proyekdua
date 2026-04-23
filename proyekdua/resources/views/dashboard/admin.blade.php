@extends('layouts.app')

@section('sidebar-menu')
    <li class="nav-item"><a class="nav-link active-link" href="#">Dashboard Admin</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('barang.index') }}">Kelola Barang</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('persetujuan.index') }}">Persetujuan</a></li>
    <li class="nav-item"><a class="nav-link" href="{{ route('laporan.index') }}">Laporan Ganti Rugi</a></li>
@endsection

@section('content')
    <h2>Dashboard Admin</h2>
    <div class="row mt-4">
        <div class="col-md-4"><div class="card p-3 bg-primary text-white">Total Alat: 50</div></div>
        <div class="col-md-4"><div class="card p-3 bg-warning text-dark">Perlu Persetujuan: 5</div></div>
        <div class="col-md-4"><div class="card p-3 bg-danger text-white">Alat Rusak: 2</div></div>
    </div>
@endsection