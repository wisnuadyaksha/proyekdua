<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Sistem Peminjaman Alat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        .float-anim { animation: float 3s ease-in-out infinite; }
    </style>
</head>
<body class="bg-gradient-to-br from-slate-100 via-blue-50 to-indigo-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-lg bg-white rounded-3xl shadow-2xl overflow-hidden border border-white/50 p-8 text-center">
        
        {{-- ICON --}}
        <div class="float-anim mb-6">
            <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full mx-auto flex items-center justify-center shadow-lg shadow-blue-200">
                <i class="fa-solid fa-envelope-open-text text-white text-4xl"></i>
            </div>
        </div>

        {{-- JUDUL --}}
        <h2 class="text-2xl font-bold text-slate-800 mb-2">Cek Kotak Masuk Email Anda</h2>
        <p class="text-slate-500 text-sm mb-6">
            Kami telah mengirimkan link verifikasi ke email:
        </p>

        {{-- EMAIL ADDRESS --}}
        <div class="bg-blue-50 border border-blue-200 rounded-xl py-3 px-4 mb-6 inline-block">
            <span class="text-blue-700 font-bold text-lg">
                <i class="fa-solid fa-at mr-1"></i>{{ auth()->user()->email }}
            </span>
        </div>

        <p class="text-slate-400 text-sm mb-6">
            Silakan buka email tersebut dan klik tombol <strong class="text-slate-600">"Verify Email Address"</strong> untuk mengaktifkan akun Anda sebagai Guru di Sistem Peminjaman Alat.
        </p>

        {{-- ALERT SUCCESS (RESENT) --}}
        @if(session('resent'))
            <div class="bg-green-50 border border-green-300 text-green-700 rounded-xl px-4 py-3 mb-4 text-sm">
                <i class="fa-solid fa-check-circle mr-1"></i> {{ session('resent') }}
            </div>
        @endif

        {{-- ALERT INFO --}}
        @if(session('info'))
            <div class="bg-blue-50 border border-blue-300 text-blue-700 rounded-xl px-4 py-3 mb-4 text-sm">
                <i class="fa-solid fa-info-circle mr-1"></i> {{ session('info') }}
            </div>
        @endif

        {{-- TOMBOL BUKA GMAIL --}}
        <a href="https://mail.google.com" target="_blank" class="w-full mb-3 inline-flex items-center justify-center bg-white border-2 border-red-500 text-red-500 py-3 px-6 rounded-xl font-bold hover:bg-red-50 hover:text-red-600 transition-all shadow-md">
            <i class="fa-brands fa-google mr-2"></i> Buka Gmail Sekarang
        </a>

        {{-- TOMBOL KIRIM ULANG --}}
        <form method="POST" action="{{ route('verification.send') }}" class="mb-4">
            @csrf
            <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 px-6 rounded-xl font-bold hover:from-blue-700 hover:to-indigo-700 transition-all shadow-lg shadow-blue-200 hover:shadow-xl">
                <i class="fa-solid fa-paper-plane mr-2"></i> Kirim Ulang Email Verifikasi
            </button>
        </form>

        {{-- TOMBOL LOGOUT --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-slate-400 hover:text-red-500 text-sm font-semibold transition-all py-2">
                <i class="fa-solid fa-arrow-right-from-bracket mr-1"></i> Logout / Ganti Akun
            </button>
        </form>

        {{-- TIPS --}}
        <div class="mt-6 bg-amber-50 border border-amber-200 rounded-xl p-4 text-left">
            <p class="text-amber-700 font-bold text-sm mb-2"><i class="fa-solid fa-lightbulb mr-1"></i> Tips:</p>
            <ul class="text-amber-600 text-xs space-y-1">
                <li>• Periksa folder <strong>Spam</strong> atau <strong>Promosi</strong> jika email tidak muncul di Kotak Masuk.</li>
                <li>• Link verifikasi akan kedaluwarsa dalam <strong>60 menit</strong>.</li>
                <li>• Jika masih tidak menerima email, coba klik "Kirim Ulang" di atas.</li>
            </ul>
        </div>
    </div>

</body>
</html>
