@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Form Pengajuan Peminjaman Alat</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Peminjam</label>
                        <input type="text" class="form-control" value="Syekha Nabila (Siswa)" readonly>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pilih Alat</label>
                            <select class="form-select">
                                <option>Multimeter Digital</option>
                                <option>Solder Dekko</option>
                                <option>Osiloskop</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jumlah</label>
                            <input type="number" class="form-control" min="1" value="1">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Pinjam</label>
                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Estimasi Pengembalian</label>
                            <input type="date" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keperluan</label>
                        <textarea class="form-control" rows="2" placeholder="Contoh: Praktikum Mikrokontroler"></textarea>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Ajukan Peminjaman</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection