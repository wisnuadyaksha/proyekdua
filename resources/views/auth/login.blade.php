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
            <button onclick="switchTab('siswa')" id="btn-siswa" class="flex-1 py-3 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-2 tab-active">
                <i class="fa-solid fa-graduation-cap"></i> Siswa
            </button>
            <button onclick="switchTab('admin')" id="btn-admin" class="flex-1 py-3 rounded-xl text-sm font-bold text-slate-500 transition-all flex items-center justify-center gap-2">
                <i class="fa-solid fa-user-shield"></i> Admin
            </button>
            <button onclick="switchTab('tamu')" id="btn-tamu" class="flex-1 py-3 rounded-xl text-sm font-bold text-slate-500 transition-all flex items-center justify-center gap-2">
                <i class="fa-solid fa-users"></i> Tamu
            </button>
        </div>

        <div class="px-10 pb-10">
            @if($errors->any())
                <div class="bg-red-50 text-red-500 p-4 rounded-xl mb-6 text-sm font-bold border border-red-100">
                    <i class="fa-solid fa-circle-exclamation me-2"></i> {{ $errors->first() }}
                </div>
            @endif

            <div id="form-siswa" class="tab-content">
                <h3 class="text-xl font-bold text-slate-800">Login Siswa</h3>
                <p class="text-slate-500 text-sm mb-6">Masuk menggunakan Nomor Induk Siswa (NIS) Anda</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input type="hidden" name="password" value="password123">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nomor Induk Siswa (NIS)</label>
                        <input type="text" name="login_input" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:ring-2 focus:ring-slate-400 outline-none transition-all font-semibold" placeholder="Contoh: 22230101" required>
                    </div>
                    <button type="submit" class="w-full bg-slate-800 text-white font-bold py-3.5 rounded-xl hover:bg-slate-900 transition-all shadow-lg shadow-slate-200">Masuk sebagai Siswa</button>
                </form>
            </div>

            <div id="form-admin" class="tab-content hidden">
                <h3 class="text-xl font-bold text-slate-800">Login Admin</h3>
                <p class="text-slate-500 text-sm mb-6">Gunakan email dan password admin yang terdaftar</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Email Address</label>
                        <input type="text" name="login_input" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:ring-2 focus:ring-slate-400 outline-none font-semibold" placeholder="admin@gmail.com" required>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Password</label>
                        <input type="password" name="password" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:ring-2 focus:ring-slate-400 outline-none font-semibold" placeholder="••••••••" required>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3.5 rounded-xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-100">Masuk sebagai Admin</button>
                </form>
            </div>

            <div id="form-tamu" class="tab-content hidden text-center py-4">
                <div class="bg-blue-50 p-6 rounded-2xl mb-6 border border-blue-100 text-center">
                    <i class="fa-solid fa-circle-info text-blue-500 text-2xl mb-3"></i>
                    <p class="text-blue-900 font-medium leading-relaxed text-sm">
                        Anda tidak perlu akun untuk meminjam alat. Klik tombol di bawah untuk langsung mengisi formulir peminjaman.
                    </p>
                </div>
                <a href="{{ route('peminjaman.tamu') }}" class="inline-block w-full bg-white border-2 border-slate-200 text-slate-700 font-bold py-3.5 rounded-xl hover:bg-slate-50 transition-all no-underline">
                    Lanjutkan Pinjam Alat (Tamu)
                </a>
            </div>
        </div>
    </div>

    <script>
        function switchTab(type) {
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            document.getElementById('form-' + type).classList.remove('hidden');
            
            document.querySelectorAll('[id^="btn-"]').forEach(el => {
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