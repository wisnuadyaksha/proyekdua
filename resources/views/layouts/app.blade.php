<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Peminjaman - SMKN 1 SINDANG</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f8f9fa; min-height: 100vh; display: flex; flex-direction: column; }
        .navbar { background-color: #1a1a1a !important; border-bottom: 3px solid #ffc107; }
        .main-content { flex: 1; padding-top: 30px; padding-bottom: 30px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark py-3 shadow">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="bi bi-tools me-2 text-warning"></i> SMKN 1 SINDANG
            </a>
            
            <div class="ms-auto d-flex align-items-center">
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm px-4 fw-bold rounded-pill">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-warning btn-sm px-4 fw-bold rounded-pill">Login Admin</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container main-content">
        @yield('content')
    </main>

    {{-- PASTIKAN TIDAK ADA APAPUN DI SINI --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>