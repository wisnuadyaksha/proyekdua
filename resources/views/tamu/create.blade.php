@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Formulir Peminjaman Alat (Pihak Luar / Tamu)</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_tamu" class="form-control" placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Instansi / Asal</label>
                        <input type="text" name="instansi" class="form-control" placeholder="Contoh: SMKN 2 Indramayu" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pilih Alat yang Ingin Dipinjam</label>
                    <select class="form-select" name="barang_id" required>
                        <option value="">-- Pilih Alat --</option>
                        <option value="1">Solder Listrik</option>
                        <option value="2">Oscilloscope</option>
                        <option value="3">Kompresor Air</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keperluan / Tujuan</label>
                    <textarea class="form-control" name="alasan" rows="3" placeholder="Jelaskan tujuan peminjaman" required></textarea>
                </div>

                <div class="alert alert-info">
                    <small>* Peminjaman untuk tamu wajib dikembalikan maksimal pukul 16.00 WIB pada hari yang sama.</small>
                </div>

                <button type="submit" class="btn btn-dark">Kirim Permintaan</button>
                <a href="{{ route('dashboard.tamu') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection