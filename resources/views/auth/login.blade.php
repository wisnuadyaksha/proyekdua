<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SMKN 1 Sindang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .tab-active { background-color: white; color: black !important; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1); }
    </style>
</head>
<body class="bg-slate-200/50 min-h-screen flex items-center justify-center p-4">

    <!-- Tombol Kembali ke Home -->
    <a href="{{ url('/') }}" class="absolute top-6 left-6 flex items-center gap-2 text-slate-500 hover:text-slate-800 font-semibold transition-all">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Home
    </a>

    <div class="w-full max-w-[500px] bg-white rounded-[2rem] shadow-2xl overflow-hidden border border-white">
        
        <div class="bg-slate-100 p-2 flex gap-1 m-6 rounded-2xl">
            <button onclick="switchTab('siswa')" id="btn-siswa" class="flex-1 py-3 px-2 rounded-xl text-sm font-bold transition-all tab-active">
                Siswa
            </button>
            <button onclick="switchTab('guru')" id="btn-guru" class="flex-1 py-3 px-2 rounded-xl text-sm font-bold transition-all text-slate-500">
                Guru
            </button>
            <button onclick="switchTab('admin')" id="btn-admin" class="flex-1 py-3 px-2 rounded-xl text-sm font-bold transition-all text-slate-500">
                Admin
            </button>
        </div>

        <div class="px-8 pb-8">
            {{-- Menampilkan Error --}}
            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-xl">
                    <p class="text-red-700 text-sm font-medium">{{ $errors->first() }}</p>
                </div>
            @endif

            {{-- FORM LOGIN SISWA --}}
            <div id="form-siswa" class="tab-content">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-slate-800">Halo, Siswa! 👋</h1>
                    <p class="text-slate-500 text-sm mt-1">Gunakan NIS dan Password untuk masuk</p>
                </div>
                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="role_target" value="siswa">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Nomor Induk Siswa (NIS)</label>
                        <input type="text" name="login_input" placeholder="Masukkan NIS Anda" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3.5 focus:border-blue-500 focus:bg-white outline-none transition-all" required autofocus>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-2 ml-1">
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Kata Sandi</label>
                            <a href="{{ route('password.request') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-800 transition-colors">Lupa sandi?</a>
                        </div>
                        <div class="relative">
                            <input type="password" name="password" id="pass-siswa" placeholder="••••••••" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3.5 focus:border-blue-500 focus:bg-white outline-none transition-all" required>
                            <button type="button" onclick="togglePassword('pass-siswa', 'icon-siswa')" class="absolute inset-y-0 right-4 flex items-center text-slate-400 hover:text-slate-600">
                                <i class="fa-solid fa-eye-slash" id="icon-siswa"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-[0.98] mt-4">
                        Masuk Sekarang
                    </button>
                </form>
                <p class="text-center text-sm text-slate-400 mt-4">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">Daftar di sini</a></p>
            </div>

            {{-- FORM LOGIN GURU --}}
            <div id="form-guru" class="tab-content hidden">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-slate-800">Panel Guru 📚</h1>
                    <p class="text-slate-500 text-sm mt-1">Gunakan Email dan Password untuk masuk</p>
                </div>
                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="role_target" value="guru">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Email Sekolah</label>
                        <input type="email" name="login_input" placeholder="contoh@sekolah.com" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3.5 focus:border-amber-500 focus:bg-white outline-none transition-all" required>
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-2 ml-1">
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Kata Sandi</label>
                            <a href="{{ route('password.request') }}" class="text-xs font-semibold text-amber-600 hover:text-amber-800 transition-colors">Lupa sandi?</a>
                        </div>
                        <div class="relative">
                            <input type="password" name="password" id="pass-guru" placeholder="••••••••" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3.5 focus:border-amber-500 focus:bg-white outline-none transition-all" required>
                            <button type="button" onclick="togglePassword('pass-guru', 'icon-guru')" class="absolute inset-y-0 right-4 flex items-center text-slate-400 hover:text-slate-600">
                                <i class="fa-solid fa-eye-slash" id="icon-guru"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-amber-500 hover:bg-amber-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-amber-200 transition-all active:scale-[0.98] mt-4">
                        Masuk Sekarang
                    </button>
                </form>
                <p class="text-center text-sm text-slate-400 mt-4">Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">Daftar di sini</a></p>
            </div>

            {{-- FORM LOGIN ADMIN --}}
            <div id="form-admin" class="tab-content hidden">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-slate-800">Panel Admin 🔐</h1>
                    <p class="text-slate-500 text-sm mt-1">Gunakan Email dan Password untuk masuk</p>
                </div>
                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="role_target" value="admin">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Email Admin</label>
                        <input type="email" name="login_input" placeholder="admin@sekolah.com" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3.5 focus:border-slate-800 focus:bg-white outline-none transition-all" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Kata Sandi</label>
                        <div class="relative">
                            <input type="password" name="password" id="pass-admin" placeholder="••••••••" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3.5 focus:border-slate-800 focus:bg-white outline-none transition-all" required>
                            <button type="button" onclick="togglePassword('pass-admin', 'icon-admin')" class="absolute inset-y-0 right-4 flex items-center text-slate-400 hover:text-slate-600">
                                <i class="fa-solid fa-eye-slash" id="icon-admin"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-slate-800 hover:bg-slate-900 text-white font-bold py-4 rounded-xl shadow-lg shadow-slate-200 transition-all active:scale-[0.98] mt-4">
                        Masuk ke Panel
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function switchTab(type) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.getElementById('form-' + type).classList.remove('hidden');
            
            document.querySelectorAll('[id^="btn-"]').forEach(el => {
                el.classList.remove('tab-active', 'text-slate-800');
                el.classList.add('text-slate-500');
            });
            
            const activeBtn = document.getElementById('btn-' + type);
            activeBtn.classList.add('tab-active');
            activeBtn.classList.remove('text-slate-500');
        }

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