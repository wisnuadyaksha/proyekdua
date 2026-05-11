@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-dark text-white text-center">
                    <h4>Buku Tamu Workshop TOI</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('tamu.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_tamu" class="form-control" placeholder="Masukkan nama Anda" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Asal Instansi / Perusahaan</label>
                            <input type="text" name="instansi" class="form-control" placeholder="Contoh: SMKN 1 Sindang" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon/WA</label>
                            <input type="number" name="telepon" class="form-control" placeholder="08xxxx" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keperluan</label>
                            <textarea name="keperluan" class="form-control" rows="3" placeholder="Tujuan kunjungan..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Kirim Data Kunjungan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection