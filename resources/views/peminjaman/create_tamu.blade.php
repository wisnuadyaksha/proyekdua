@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-warning text-dark text-center">
                    <h5 class="mb-0 font-weight-bold">Formulir Peminjaman Alat (Tamu)</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('peminjaman.storeTamu') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Nama Lengkap</label>
                            <input type="text" name="nama_peminjam" class="form-control" placeholder="Masukkan nama sesuai KTP" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Pilih Barang/Alat</label>
                            <select name="id_barang" class="form-select" required>
                                <option value="">-- Pilih Alat --</option>
                                @foreach($barangs as $item)
                                    <option value="{{ $item->id_barang }}">
                                        {{ $item->nama_barang }} (Tersedia: {{ $item->stok_tersedia }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Jumlah Pinjam</label>
                                <input type="number" name="jumlah_pinjam" class="form-control" min="1" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label font-weight-bold">Rencana Tanggal Kembali</label>
                                <input type="date" name="tgl_kembali" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Catatan/Tujuan</label>
                            <textarea name="catatan" class="form-control" rows="2" placeholder="Contoh: Keperluan praktikum rangkaian listrik"></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning font-weight-bold text-dark">Kirim Permohonan Pinjam</button>
                            <a href="/" class="btn btn-light border">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
            <p class="text-center mt-3 text-muted small">
                *Data Anda akan diverifikasi oleh Admin sebelum alat diberikan.
            </p>
        </div>
    </div>
</div>
@endsection