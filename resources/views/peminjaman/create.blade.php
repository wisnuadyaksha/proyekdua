@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Formulir Peminjaman Alat - Tamu</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama Anda" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Instansi / Asal</label>
                    <input type="text" name="instansi" class="form-control" placeholder="Contoh: SMKN 2 Indramayu" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alat yang Dipinjam</label>
                    <select class="form-select" name="barang_id" required>
                        <option value="">-- Pilih Alat --</option>
                        <option value="1">Solder Listrik</option>
                        <option value="2">Multimeter</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tujuan Peminjaman</label>
                    <textarea name="tujuan" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-dark">Kirim Permintaan</button>
                <a href="{{ route('dashboard.tamu') }}" class="btn btn-light border">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection