<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Pinjaman Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-50 min-h-screen">

    <div class="flex">
        <aside class="w-64 bg-slate-900 h-screen sticky top-0 p-6 hidden md:block text-white">
            <div class="flex items-center gap-3 mb-10">
                <img src="img/logo_smk.png" class="w-8 h-8 brightness-0 invert">
                <span class="font-bold text-sm">Admin Workshop</span>
            </div>
            <nav class="space-y-2">
                <a href="dashboard_admin.php" class="flex items-center gap-3 text-slate-400 hover:bg-white/5 px-4 py-3 rounded-xl transition">
                    <i class="fa-solid fa-box"></i> Kelola Alat
                </a>
                <a href="#" class="flex items-center gap-3 bg-white/10 text-white px-4 py-3 rounded-xl">
                    <i class="fa-solid fa-users"></i> Daftar Siswa
                </a>
                <a href="index.php" class="flex items-center gap-3 text-red-400 hover:bg-red-500/10 px-4 py-3 rounded-xl transition mt-20">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar
                </a>
            </nav>
        </aside>

        <main class="flex-1 p-4 md:p-10">
            <header class="mb-10">
                <h2 class="text-2xl font-bold text-slate-800">Status Peminjaman Siswa</h2>
                <p class="text-slate-500">Pantau siswa yang sedang meminjam alat dan kelola pengembalian</p>
            </header>

            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Siswa</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Alat & Jumlah</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tgl Kembali</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <tr class="hover:bg-slate-50/30 transition">
                            <td class="p-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold">
                                        AN
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm">Ahmad Nabil</p>
                                        <p class="text-[10px] text-slate-400 uppercase tracking-tighter">XI TOI 1</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-6 text-sm">
                                <span class="font-bold text-slate-700">Multimeter Digital</span>
                                <p class="text-xs text-slate-400 font-medium">1 Unit</p>
                            </td>
                            <td class="p-6 text-sm font-medium text-slate-600">29 Apr 2026</td>
                            <td class="p-6">
                                <span class="bg-blue-100 text-blue-600 text-[10px] px-3 py-1.5 rounded-full font-black uppercase tracking-wider">Aktif</span>
                            </td>
                            <td class="p-6">
                                <button class="text-xs font-bold bg-green-500 text-white px-4 py-2 rounded-xl hover:bg-green-600 shadow-lg shadow-green-100 transition">
                                    Konfirmasi Kembali
                                </button>
                            </td>
                        </tr>
                        
                        <tr class="bg-red-50/30">
                            <td class="p-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center text-red-600 font-bold">
                                        SP
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm">Siti Pertiwi</p>
                                        <p class="text-[10px] text-slate-400 uppercase tracking-tighter">XI TOI 2</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-6 text-sm font-bold text-slate-700">Solder Listrik 40W</td>
                            <td class="p-6 text-sm font-black text-red-500">25 Apr 2026</td>
                            <td class="p-6">
                                <span class="bg-red-500 text-white text-[10px] px-3 py-1.5 rounded-full font-black uppercase tracking-wider">Terlambat</span>
                            </td>
                            <td class="p-6 flex gap-2">
                                <button class="text-xs font-bold border border-red-200 text-red-500 px-4 py-2 rounded-xl hover:bg-red-50 transition">
                                    Tagih
                                </button>
                                <button class="text-xs font-bold bg-slate-800 text-white px-4 py-2 rounded-xl hover:bg-black transition">
                                    Selesai
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

</body>
</html>