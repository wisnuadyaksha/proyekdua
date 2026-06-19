<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - SMKN 1 Sindang</title>
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
            <button onclick="switchTab('siswa')" id="btn-siswa" class="flex-1 py-3 px-4 rounded-xl text-sm font-bold transition-all tab-active">
                Siswa
            </button>
            <button onclick="switchTab('guru')" id="btn-guru" class="flex-1 py-3 px-4 rounded-xl text-sm font-bold transition-all text-slate-500">
                Guru
            </button>
        </div>

        <div class="px-8 pb-8">
            {{-- Menampilkan Error --}}
            @if($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-xl">
                    @foreach($errors->all() as $error)
                        <p class="text-red-700 text-sm font-medium">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            {{-- FORM REGISTER SISWA --}}
            <div id="form-siswa" class="tab-content">
                <div class="text-center mb-6">
                    <h1 class="text-2xl font-bold text-slate-800">Daftar Akun Siswa 🎓</h1>
                    <p class="text-slate-500 text-sm mt-1">Buat akun baru untuk mengakses sistem</p>
                </div>
                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <input type="hidden" name="role" value="siswa">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Nama Lengkap</label>
                        <input type="text" name="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-blue-500 focus:bg-white outline-none transition-all" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Nomor Induk Siswa (NIS)</label>
                        <input type="text" name="nis" placeholder="Masukkan NIS Anda" value="{{ old('nis') }}" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-blue-500 focus:bg-white outline-none transition-all" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Kelas</label>
                        <div class="relative">
                            <select name="class" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 appearance-none focus:border-blue-500 focus:bg-white outline-none transition-all" required>
                                <option value="" disabled selected>Pilih Kelas</option>
                                <option value="X TOI 1" {{ old('class') == 'X TOI 1' ? 'selected' : '' }}>X TOI 1</option>
                                <option value="X TOI 2" {{ old('class') == 'X TOI 2' ? 'selected' : '' }}>X TOI 2</option>
                                <option value="XI TOI 1" {{ old('class') == 'XI TOI 1' ? 'selected' : '' }}>XI TOI 1</option>
                                <option value="XI TOI 2" {{ old('class') == 'XI TOI 2' ? 'selected' : '' }}>XI TOI 2</option>
                                <option value="XII TOI 1" {{ old('class') == 'XII TOI 1' ? 'selected' : '' }}>XII TOI 1</option>
                                <option value="XII TOI 2" {{ old('class') == 'XII TOI 2' ? 'selected' : '' }}>XII TOI 2</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                <i class="fa-solid fa-chevron-down text-sm"></i>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Foto Profil (Wajib)</label>
                        <input type="file" name="foto" accept="image/*" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-blue-500 focus:bg-white outline-none transition-all text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Kata Sandi</label>
                        <div class="relative">
                            <input type="password" name="password" id="pass-siswa" placeholder="Minimal 6 karakter" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-blue-500 focus:bg-white outline-none transition-all" required>
                            <button type="button" onclick="togglePassword('pass-siswa', 'icon-siswa')" class="absolute inset-y-0 right-4 flex items-center text-slate-400 hover:text-slate-600">
                                <i class="fa-solid fa-eye-slash" id="icon-siswa"></i>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Konfirmasi Kata Sandi</label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="pass-siswa-conf" placeholder="Ulangi kata sandi" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-blue-500 focus:bg-white outline-none transition-all" required>
                            <button type="button" onclick="togglePassword('pass-siswa-conf', 'icon-siswa-conf')" class="absolute inset-y-0 right-4 flex items-center text-slate-400 hover:text-slate-600">
                                <i class="fa-solid fa-eye-slash" id="icon-siswa-conf"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-[0.98] mt-2">
                        Daftar Sekarang
                    </button>
                </form>
                <p class="text-center text-sm text-slate-400 mt-4">Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Login di sini</a></p>
            </div>

            {{-- FORM REGISTER GURU --}}
            <div id="form-guru" class="tab-content hidden">
                <div class="text-center mb-6">
                    <h1 class="text-2xl font-bold text-slate-800">Daftar Akun Guru 📚</h1>
                    <p class="text-slate-500 text-sm mt-1">Buat akun guru untuk meminjam alat</p>
                </div>
                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <input type="hidden" name="role" value="guru">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Nama Lengkap</label>
                        <input type="text" name="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-amber-500 focus:bg-white outline-none transition-all" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Email Anda</label>
                        <input type="email" name="email" placeholder="contoh@sekolah.com" value="{{ old('email') }}" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-amber-500 focus:bg-white outline-none transition-all" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Foto Profil (Wajib)</label>
                        <input type="file" name="foto" accept="image/*" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-amber-500 focus:bg-white outline-none transition-all text-sm file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Kata Sandi</label>
                        <div class="relative">
                            <input type="password" name="password" id="pass-guru" placeholder="Minimal 6 karakter" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-amber-500 focus:bg-white outline-none transition-all" required>
                            <button type="button" onclick="togglePassword('pass-guru', 'icon-guru')" class="absolute inset-y-0 right-4 flex items-center text-slate-400 hover:text-slate-600">
                                <i class="fa-solid fa-eye-slash" id="icon-guru"></i>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Konfirmasi Kata Sandi</label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="pass-guru-conf" placeholder="Ulangi kata sandi" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3 focus:border-amber-500 focus:bg-white outline-none transition-all" required>
                            <button type="button" onclick="togglePassword('pass-guru-conf', 'icon-guru-conf')" class="absolute inset-y-0 right-4 flex items-center text-slate-400 hover:text-slate-600">
                                <i class="fa-solid fa-eye-slash" id="icon-guru-conf"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-slate-800 hover:bg-slate-900 text-white font-bold py-4 rounded-xl shadow-lg shadow-slate-200 transition-all active:scale-[0.98] mt-2">
                        Daftar Sekarang
                    </button>
                </form>
                <p class="text-center text-sm text-slate-400 mt-4">Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Login di sini</a></p>
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
