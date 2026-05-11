@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Formulir Peminjaman Alat</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Nama Peminjam</label>
                    <input type="text" class="form-control bg-light" value="{{ Auth::user()->nama_siswa }}" readonly>
                    <input type="hidden" name="id_siswa" value="{{ Auth::user()->id_siswa }}">
                </div>

                <div class="mb-3">
                    <label for="id_barang" class="form-label">Pilih Alat yang Tersedia</label>
                    <select name="id_barang" id="id_barang" class="form-select" required>
                        <option value="">-- Pilih Alat --</option>
                        @foreach($barangs as $alat)
                            <option value="{{ $alat->id_barang }}">
                                {{ $alat->nama_barang }} (Stok: {{ $alat->stok_tersedia }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jumlah Pinjam</label>
                        <input type="number" name="jumlah_pinjam" class="form-control" min="1" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Pinjam</label>
                        <input type="date" name="tgl_pinjam" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Catatan / Tujuan Peminjaman</label>
                    <textarea name="catatan" class="form-control" placeholder="Contoh: Untuk keperluan praktikum elektronika"></textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('dashboard.siswa') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection