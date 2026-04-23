@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="text-center mb-4">
            <h4 class="fw-bold">SMK NEGERI 1 SINDANG</h4>
            <p class="text-muted">Workshop Teknik Otomasi Industri</p>
        </div>

        <div class="card shadow border-0">
            <ul class="nav nav-pills nav-justified bg-light p-2" id="loginTab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" id="admin-tab" data-bs-toggle="pill" data-bs-target="#login-admin" type="button">ADMIN</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="siswa-tab" data-bs-toggle="pill" data-bs-target="#login-siswa" type="button">SISWA</button>
                </li>
            </ul>

            <div class="tab-content p-4">
                <div class="tab-pane fade show active" id="login-admin">
                    <form action="{{ route('dashboard.admin') }}" method="GET">
                        <div class="mb-3">
                            <label class="form-label">Email Admin</label>
                            <input type="email" class="form-control" placeholder="admin@smkn1sindang.sch.id" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" placeholder="******" required>
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Login Admin</button>
                    </form>
                </div>

                <div class="tab-pane fade" id="login-siswa">
                    <form action="{{ route('dashboard.siswa') }}" method="GET">
                        <div class="mb-3">
                            <label class="form-label">NIS (Nomor Induk Siswa)</label>
                            <input type="number" class="form-control" placeholder="Contoh: 2407001" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" placeholder="******" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login Siswa</button>
                    </form>
                </div>
            </div>
            
            <div class="card-footer bg-white border-0 text-center pb-4">
                <p class="mb-1 text-muted">Bukan Siswa/Admin?</p>
                <a href="{{ route('tamu.create') }}" class="btn btn-outline-success btn-sm">Masuk Sebagai Tamu</a>
            </div>
        </div>
    </div>
</div>
@endsection