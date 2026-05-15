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

    <div class="w-full max-w-[600px] bg-white rounded-[2rem] shadow-2xl overflow-hidden border border-white">
        
        <div class="bg-slate-100 p-2 flex gap-1 m-6 rounded-2xl">
            <button onclick="switchTab('siswa')" id="btn-siswa" class="flex-1 py-3 px-4 rounded-xl text-sm font-bold transition-all tab-active">
                Siswa
            </button>
            <button onclick="switchTab('admin')" id="btn-admin" class="flex-1 py-3 px-4 rounded-xl text-sm font-bold text-slate-500 transition-all">
                Admin
            </button>
            <button onclick="switchTab('tamu')" id="btn-tamu" class="flex-1 py-3 px-4 rounded-xl text-sm font-bold text-slate-500 transition-all">
                Tamu
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
                    {{-- PENTING: Penanda bahwa ini form Siswa --}}
                    <input type="hidden" name="role_target" value="siswa">
                    
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Nomor Induk Siswa (NIS)</label>
                        <input type="text" name="login_input" placeholder="Masukkan NIS Anda" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3.5 focus:border-blue-500 focus:bg-white outline-none transition-all" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Kata Sandi</label>
                        <input type="password" name="password" placeholder="••••••••" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3.5 focus:border-blue-500 focus:bg-white outline-none transition-all" required>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-200 transition-all active:scale-[0.98]">
                        Masuk Sekarang
                    </button>
                </form>
            </div>

            {{-- FORM LOGIN ADMIN --}}
            <div id="form-admin" class="tab-content hidden">
                <div class="text-center mb-8">
                    <h1 class="text-2xl font-bold text-slate-800">Panel Admin 🔐</h1>
                    <p class="text-slate-500 text-sm mt-1">Gunakan Email Admin Anda</p>
                </div>
                <form action="{{ route('login') }}" method="POST" class="space-y-4">
                    @csrf
                    {{-- PENTING: Penanda bahwa ini form Admin --}}
                    <input type="hidden" name="role_target" value="admin">

                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Email Admin</label>
                        <input type="email" name="login_input" placeholder="admin@sekolah.com" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3.5 focus:border-slate-800 focus:bg-white outline-none transition-all" required>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2 ml-1">Kata Sandi</label>
                        <input type="password" name="password" placeholder="••••••••" class="w-full bg-slate-50 border-2 border-slate-100 rounded-xl px-4 py-3.5 focus:border-slate-800 focus:bg-white outline-none transition-all" required>
                    </div>
                    <button type="submit" class="w-full bg-slate-800 hover:bg-slate-900 text-white font-bold py-4 rounded-xl shadow-lg shadow-slate-200 transition-all active:scale-[0.98]">
                        Masuk ke Panel
                    </button>
                </form>
            </div>

            {{-- TAB TAMU --}}
            <div id="form-tamu" class="tab-content hidden text-center py-4">
                <div class="bg-blue-50 p-6 rounded-2xl mb-6 border border-blue-100">
                    <i class="fa-solid fa-circle-info text-blue-500 text-2xl mb-3"></i>
                    <p class="text-blue-900 font-medium text-sm">Anda bisa meminjam alat tanpa akun.</p>
                </div>
                <a href="{{ route('peminjaman.tamu') }}" class="inline-block w-full bg-white border-2 border-slate-200 text-slate-700 font-bold py-3.5 rounded-xl hover:bg-slate-50 no-underline">
                    Lanjutkan Pinjam Alat (Tamu)
                </a>
            </div>
        </div>
    </div>

    <script>
        function switchTab(type) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.getElementById('form-' + type).classList.remove('hidden');
            
            document.querySelectorAll('[id^=\"btn-\"]').forEach(el => {
                el.classList.remove('tab-active', 'text-black');
                el.classList.add('text-slate-500');
            });
            
            const activeBtn = document.getElementById('btn-' + type);
            activeBtn.classList.add('tab-active');
            activeBtn.classList.remove('text-slate-500');
        }
    </script>
</body>
</html>