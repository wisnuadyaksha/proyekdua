<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - SMKN 1 Sindang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-200/50 min-h-screen flex items-center justify-center p-4">

    <!-- Tombol Kembali ke Login -->
    <a href="{{ route('login') }}" class="absolute top-6 left-6 flex items-center gap-2 text-slate-500 hover:text-slate-800 font-semibold transition-all">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Login
    </a>

    <div class="w-full max-w-[500px] bg-white rounded-[2rem] shadow-2xl overflow-hidden border border-white p-8">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-slate-800">Lupa Kata Sandi 🔒</h1>
            <p class="text-slate-500 text-sm mt-2">Masukkan NIS atau Email Anda beserta kata sandi yang baru.</p>
        </div>

        {{-- Menampilkan Error/Success --}}
        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-xl">
                <p class="text-red-700 text-sm font-medium">{{ $errors->first() }}</p>
            </div>
        @endif
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-xl">
                <p class="text-green-700 text-sm font-medium">{{ session('success') }}</p>
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">NIS / Email Sekolah</label>
                <input type="text" name="login_input" placeholder="Masukkan NIS atau Email" value="{{ old('login_input') }}" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3.5 focus:border-blue-500 focus:bg-white outline-none transition-all" required autofocus>
            </div>
            
            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Kata Sandi Baru</label>
                <div class="relative">
                    <input type="password" name="password" id="pass-new" placeholder="Minimal 6 karakter" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3.5 focus:border-blue-500 focus:bg-white outline-none transition-all" required>
                    <button type="button" onclick="togglePassword('pass-new', 'icon-new')" class="absolute inset-y-0 right-4 flex items-center text-slate-400 hover:text-slate-600">
                        <i class="fa-solid fa-eye-slash" id="icon-new"></i>
                    </button>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Konfirmasi Kata Sandi Baru</label>
                <div class="relative">
                    <input type="password" name="password_confirmation" id="pass-new-conf" placeholder="Ulangi kata sandi baru" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3.5 focus:border-blue-500 focus:bg-white outline-none transition-all" required>
                    <button type="button" onclick="togglePassword('pass-new-conf', 'icon-new-conf')" class="absolute inset-y-0 right-4 flex items-center text-slate-400 hover:text-slate-600">
                        <i class="fa-solid fa-eye-slash" id="icon-new-conf"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-[0.98] mt-6">
                Perbarui Kata Sandi
            </button>
        </form>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>
</html>
