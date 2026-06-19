<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Peminjaman Alat - Workshop Teknik Otomasi Industri SMKN 1 Sindang. Platform untuk mengelola dan meminjam peralatan praktik dengan mudah.">
    <title>Sistem Peminjaman Alat | SMKN 1 Sindang</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root {
            --primary: #FFB800; /* Vibrant Yellow/Orange for TOI */
            --primary-hover: #E6A600;
            --bg-dark: #0A0A0B;
            --bg-card: rgba(255, 255, 255, 0.03);
            --text-main: #FFFFFF;
            --text-muted: #A0A0AB;
            --glass-border: rgba(255, 255, 255, 0.08);
            --glass-bg: rgba(10, 10, 11, 0.7);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-main);
            overflow-x: hidden;
            line-height: 1.6;
        }

        /* Ambient Background Glow */
        .ambient-glow {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 80vw;
            height: 80vw;
            transform: translate(-50%, -50%);
            background: radial-gradient(circle, rgba(255, 184, 0, 0.15) 0%, rgba(10, 10, 11, 0) 70%);
            z-index: -1;
            pointer-events: none;
        }

        /* Typography */
        h1, h2, h3, .font-heading {
            font-family: 'Outfit', sans-serif;
        }

        /* Navbar Glassmorphism */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem 5%;
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--glass-border);
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            color: var(--text-main);
        }

        .navbar-brand img {
            height: 45px;
            filter: drop-shadow(0 0 8px rgba(255, 184, 0, 0.3));
        }

        .brand-text h1 {
            font-size: 1.25rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            margin: 0;
        }

        .brand-text span {
            font-size: 0.7rem;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 600;
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.8rem 1.75rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            border: none;
            font-family: 'Outfit', sans-serif;
        }

        .btn-outline {
            background: transparent;
            color: var(--text-main);
            border: 1px solid var(--glass-border);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .btn-primary {
            background: var(--primary);
            color: #000000;
            box-shadow: 0 4px 15px rgba(255, 184, 0, 0.3);
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 184, 0, 0.4);
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 8rem 5% 4rem;
            gap: 4rem;
            position: relative;
        }

        .hero-content {
            flex: 1;
            max-width: 600px;
            animation: slideUp 1s ease-out forwards;
        }

        .hero-badge {
            display: inline-block;
            padding: 0.4rem 1rem;
            background: rgba(255, 184, 0, 0.1);
            color: var(--primary);
            border: 1px solid rgba(255, 184, 0, 0.2);
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hero h2 {
            font-size: clamp(3rem, 5vw, 4.5rem);
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(to right, #FFFFFF, #A0A0AB);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero h2 span {
            background: linear-gradient(45deg, var(--primary), #FFD700);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .hero p {
            font-size: 1.1rem;
            color: var(--text-muted);
            margin-bottom: 2.5rem;
            max-width: 90%;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .hero-visual {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            animation: fadeIn 1.5s ease-out forwards;
        }

        /* Image Styling */
        .image-container {
            position: relative;
            width: 100%;
            max-width: 500px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            border: 1px solid var(--glass-border);
            transform: perspective(1000px) rotateY(-5deg) rotateX(5deg);
            transition: transform 0.5s ease;
        }

        .image-container:hover {
            transform: perspective(1000px) rotateY(0deg) rotateX(0deg);
        }

        .image-container img {
            width: 100%;
            height: auto;
            display: block;
            opacity: 0.85;
            transition: opacity 0.3s ease;
        }

        .image-container:hover img {
            opacity: 1;
        }

        /* Features Section */
        .features {
            padding: 5rem 5%;
            background: rgba(255, 255, 255, 0.01);
            border-top: 1px solid var(--glass-border);
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-header h3 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            background: var(--bg-card);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 2.5rem 2rem;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at top right, rgba(255,184,0,0.1), transparent 50%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            border-color: rgba(255, 184, 0, 0.3);
            background: rgba(255, 255, 255, 0.05);
        }

        .feature-card:hover::before {
            opacity: 1;
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 184, 0, 0.1);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .feature-card h4 {
            font-size: 1.25rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .feature-card p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        /* Footer */
        footer {
            padding: 3rem 5%;
            text-align: center;
            border-top: 1px solid var(--glass-border);
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        /* Alert Notification */
        .notification {
            position: fixed;
            top: 100px;
            right: 20px;
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #4ade80;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            backdrop-filter: blur(10px);
            z-index: 2000;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: slideInRight 0.5s ease forwards;
        }

        /* Animations */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeIn {
            from { opacity: 0; scale: 0.95; }
            to { opacity: 1; scale: 1; }
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero {
                flex-direction: column;
                text-align: center;
                padding-top: 7rem;
            }
            .hero-content {
                max-width: 100%;
            }
            .hero p {
                margin: 0 auto 2.5rem;
            }
            .hero-actions {
                justify-content: center;
            }
            .image-container {
                transform: none;
            }
        }

        @media (max-width: 576px) {
            .navbar { padding: 1rem 5%; }
            .brand-text h1 { font-size: 1rem; }
            .hero h2 { font-size: 2.5rem; }
            .btn { width: 100%; justify-content: center; }
        }
    </style>
</head>
<body>

    <div class="ambient-glow"></div>

    @if(session('success'))
    <div class="notification">
        <i class="bi bi-check-circle-fill"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <nav class="navbar">
        <a href="/" class="navbar-brand">
            <img src="{{ asset('img/logo_smkn1.png') }}" alt="Logo SMKN 1 Sindang">
            <div class="brand-text">
                <h1>SMKN 1 SINDANG</h1>
                <span>Teknik Otomasi Industri</span>
            </div>
        </a>
    </nav>

    <section class="hero">
        <div class="hero-content">
            <div class="hero-badge">Sistem Peminjaman Digital</div>
            <h2>Manajemen Alat <br><span>Praktik Workshop</span></h2>
            <p>Platform terintegrasi untuk mengelola, melacak, dan meminjam peralatan praktik di workshop Teknik Otomasi Industri. Cepat, mudah, dan transparan.</p>
            
            <div class="hero-actions">
                <a href="{{ route('login') }}" class="btn btn-primary">
                    <i class="bi bi-person-fill"></i> Login Siswa / Guru
                </a>
                <a href="{{ route('peminjaman.tamu') }}" class="btn btn-outline">
                    <i class="bi bi-clipboard-check"></i> Form Tamu
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline" style="border-color: var(--primary); color: var(--primary);">
                    <i class="bi bi-person-plus-fill"></i> Daftar Akun
                </a>
            </div>
        </div>

        <div class="hero-visual">
            <div class="image-container">
                <img src="{{ asset('img/gedung_sekolah.jpg') }}" alt="Gedung SMKN 1 Sindang">
            </div>
        </div>
    </section>

    <section class="features">
        <div class="section-header">
            <h3>Kenapa Menggunakan Sistem Ini?</h3>
            <p style="color: var(--text-muted);">Meningkatkan efisiensi dan keamanan aset workshop</p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-lightning-charge"></i>
                </div>
                <h4 class="font-heading">Proses Cepat</h4>
                <p>Peminjaman alat dilakukan secara real-time tanpa harus mengisi form manual di atas kertas. Semua tercatat di sistem.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-box-seam"></i>
                </div>
                <h4 class="font-heading">Tracking Akurat</h4>
                <p>Pantau jumlah stok alat yang tersedia, barang yang sedang dipinjam, hingga riwayat pengembalian dengan sangat akurat.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h4 class="font-heading">Aman & Terkendali</h4>
                <p>Sistem otorisasi memastikan hanya pihak yang berwenang dan siswa terdaftar yang dapat melakukan peminjaman aset.</p>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; {{ date('Y') }} Sistem Peminjaman Alat - Teknik Otomasi Industri | SMKN 1 Sindang. All rights reserved.</p>
    </footer>

    <script>
        // Simple script to dismiss notification after 5 seconds
        const notification = document.querySelector('.notification');
        if (notification) {
            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateX(50px)';
                notification.style.transition = 'all 0.5s ease';
                setTimeout(() => notification.remove(), 500);
            }, 5000);
        }
    </script>
</body>
</html>