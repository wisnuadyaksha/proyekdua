<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Peminjaman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
        .tab-active { border-bottom: 3px solid black; color: black; font-weight: 700; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-6">

    <div class="bg-white w-full max-w-md rounded-3xl shadow-xl overflow-hidden border border-slate-100">
        <div class="p-8 text-center pb-4">
            <img src="logo_smk.png" alt="Logo" class="w-16 h-16 mx-auto mb-4">
            <h2 class="text-2xl font-bold text-slate-800">Selamat Datang</h2>
            <p class="text-slate-500 text-sm">Silahkan masuk ke akun anda</p>
        </div>

        <div class="flex border-b border-slate-100">
            <button onclick="switchTab('siswa')" id="btn-siswa" class="flex-1 py-4 text-sm font-medium text-slate-400 transition-all tab-active">Siswa</button>
            <button onclick="switchTab('admin')" id="btn-admin" class="flex-1 py-4 text-sm font-medium text-slate-400 transition-all">Admin</button>
            <button onclick="switchTab('tamu')" id="btn-tamu" class="flex-1 py-4 text-sm font-medium text-slate-400 transition-all">Tamu</button>
        </div>

        <div class="p-8">
            <form id="form-siswa" action="proses_login.php" method="POST" class="space-y-5">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Nomor Induk Siswa (NIS)</label>
                    <input type="text" name="nis" placeholder="Masukkan NIS anda" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-black outline-none transition">
                </div>
                <button type="submit" class="w-full bg-black text-white py-3.5 rounded-xl font-bold hover:bg-slate-800 transition shadow-lg shadow-black/10">Login Siswa</button>
            </form>

            <form id="form-admin" action="proses_login.php" method="POST" class="space-y-5 hidden">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Email Admin</label>
                    <input type="email" name="email" placeholder="admin@smkn1sindang.sch.id" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-black outline-none transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2 text-right">Lupa Password?</label>
                    <input type="password" name="password" placeholder="••••••••" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-black outline-none transition">
                </div>
                <button type="submit" class="w-full bg-black text-white py-3.5 rounded-xl font-bold hover:bg-slate-800 transition">Login Admin</button>
            </form>

            <form id="form-tamu" action="proses_login.php" method="POST" class="space-y-5 hidden">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Masukkan nama anda" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-black outline-none transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase mb-2">Asal Jurusan / Instansi</label>
                    <input type="text" name="instansi" placeholder="Contoh: Teknik Mesin" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-black outline-none transition">
                </div>
                <button type="submit" class="w-full bg-black text-white py-3.5 rounded-xl font-bold hover:bg-slate-800 transition">Masuk sebagai Tamu</button>
            </form>
        </div>
    </div>

    <script>
        function switchTab(role) {
            // Sembunyikan semua form
            document.getElementById('form-siswa').classList.add('hidden');
            document.getElementById('form-admin').classList.add('hidden');
            document.getElementById('form-tamu').classList.add('hidden');
            
            // Hapus class aktif di tombol
            document.getElementById('btn-siswa').classList.remove('tab-active');
            document.getElementById('btn-admin').classList.remove('tab-active');
            document.getElementById('btn-tamu').classList.remove('tab-active');

            // Tampilkan form yang dipilih & aktifkan tombolnya
            document.getElementById('form-' + role).classList.remove('hidden');
            document.getElementById('btn-' + role).classList.add('tab-active');
        }
    </script>
</body>
</html>