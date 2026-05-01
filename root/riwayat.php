<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman - SMKN 1 Sindang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-50 min-h-screen">

    <div class="flex">
        <aside class="w-64 bg-white h-screen sticky top-0 border-r border-slate-200 p-6 hidden md:block">
            <div class="flex items-center gap-3 mb-10">
                <img src="img/logo_smk.png" class="w-8 h-8">
                <span class="font-bold text-sm">SMKN 1 Sindang</span>
            </div>
            <nav class="space-y-2">
                <a href="dashboard_siswa.php" class="flex items-center gap-3 text-slate-500 hover:bg-slate-100 px-4 py-3 rounded-xl transition">
                    <i class="fa-solid fa-house"></i> Dashboard
                </a>
                <a href="#" class="flex items-center gap-3 bg-black text-white px-4 py-3 rounded-xl shadow-lg shadow-black/10">
                    <i class="fa-solid fa-clock-rotate-left"></i> Riwayat
                </a>
                <a href="index.php" class="flex items-center gap-3 text-red-500 hover:bg-red-50 px-4 py-3 rounded-xl transition mt-20">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar
                </a>
            </nav>
        </aside>

        <main class="flex-1 p-4 md:p-10">
            <header class="mb-10">
                <h2 class="text-2xl font-bold text-slate-800">Riwayat Peminjaman</h2>
                <p class="text-slate-500">Pantau status pengembalian alat kamu di sini</p>
            </header>

            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Alat</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Tgl Pinjam</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Batas Kembali</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="p-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-slate-100 rounded-xl overflow-hidden">
                                        <img src="img/obeng.jpg" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800">Obeng Plus (+)</p>
                                        <p class="text-xs text-slate-400">Jumlah: 1</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-6 text-sm font-medium text-slate-600">27 Apr 2026</td>
                            <td class="p-6 text-sm font-medium text-slate-600">28 Apr 2026</td>
                            <td class="p-6">
                                <span class="bg-blue-100 text-blue-600 text-[10px] px-3 py-1.5 rounded-full font-black uppercase tracking-wider">Dipinjam</span>
                            </td>
                            <td class="p-6">
                                <button class="text-xs font-bold text-white bg-slate-800 px-4 py-2 rounded-lg hover:bg-black transition">Detail</button>
                            </td>
                        </tr>

                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="p-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-slate-100 rounded-xl overflow-hidden text-center content-center text-slate-400">
                                        <i class="fa-solid fa-wrench"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800">Tang Kombinasi</p>
                                        <p class="text-xs text-slate-400">Jumlah: 1</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-6 text-sm font-medium text-slate-600">20 Apr 2026</td>
                            <td class="p-6 text-sm font-bold text-red-500">21 Apr 2026</td>
                            <td class="p-6">
                                <span class="bg-red-100 text-red-600 text-[10px] px-3 py-1.5 rounded-full font-black uppercase tracking-wider">Terlambat</span>
                            </td>
                            <td class="p-6">
                                <button class="text-xs font-bold text-white bg-red-500 px-4 py-2 rounded-lg hover:bg-red-600 transition shadow-lg shadow-red-200">Bayar Denda</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-8 p-6 bg-white rounded-3xl border border-slate-100 flex items-center justify-between">
                <div>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Denda Belum Dibayar</p>
                    <h4 class="text-2xl font-black text-slate-800">Rp 5.000</h4>
                </div>
                <i class="fa-solid fa-wallet text-3xl text-slate-200"></i>
            </div>
        </main>
    </div>

</body>
</html>