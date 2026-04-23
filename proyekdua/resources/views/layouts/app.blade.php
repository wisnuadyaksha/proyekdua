<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI Peminjaman Alat - SMKN 1 Sindang</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body { background-color: #f8f9fa; }
        .navbar { margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .nav-link.active { font-weight: bold; color: #0d6efd !important; }
        .container { background: white; padding: 30px; border-radius: 10px; min-height: 80vh; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SMKN 1 SINDANG</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    
                    {{-- MENU UNTUK ADMIN --}}
                    @if(Request::is('admin/*'))
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ route('dashboard.admin') }}">Dashboard Admin</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('barang*') ? 'active' : '' }}" href="{{ route('barang.index') }}">Data Alat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('persetujuan.index') }}">Persetujuan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('laporan.index') }}">Laporan</a>
                        </li>

                    {{-- MENU UNTUK SISWA --}}
                    @elseif(Request::is('siswa/*'))
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('siswa/dashboard') ? 'active' : '' }}" href="{{ route('dashboard.siswa') }}">Dashboard Siswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('peminjaman.create') }}">Pinjam Alat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('peminjaman.riwayat') }}">Riwayat Pinjam</a>
                        </li>

                    {{-- MENU UNTUK TAMU --}}
                    @elseif(Request::is('tamu/*'))
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('tamu/dashboard') ? 'active' : '' }}" href="{{ route('dashboard.tamu') }}">Dashboard Tamu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tamu.create') }}">Isi Form Tamu</a>
                        </li>
                    @endif

                </ul>
                
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="/">Keluar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container border">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>