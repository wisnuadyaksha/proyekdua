<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Kelola Alat</title>
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
                <a href="#" class="flex items-center gap-3 bg-white/10 text-white px-4 py-3 rounded-xl">
                    <i class="fa-solid fa-box"></i> Kelola Alat
                </a>
                <a href="#" class="flex items-center gap-3 text-slate-400 hover:bg-white/5 px-4 py-3 rounded-xl transition">
                    <i class="fa-solid fa-users"></i> Daftar Siswa
                </a>
                <a href="#" class="flex items-center gap-3 text-slate-400 hover:bg-white/5 px-4 py-3 rounded-xl transition">
                    <i class="fa-solid fa-file-invoice"></i> Laporan
                </a>
                <a href="index.php" class="flex items-center gap-3 text-red-400 hover:bg-red-500/10 px-4 py-3 rounded-xl transition mt-20">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar
                </a>
            </nav>
        </aside>

        <main class="flex-1 p-4 md:p-10">
            <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">Manajemen Alat Workshop</h2>
                    <p class="text-slate-500">Tambah, edit, atau hapus stok alat bengkel</p>
                </div>
                <button onclick="openAddModal()" class="bg-black text-white px-6 py-3 rounded-2xl font-bold hover:bg-slate-800 transition flex items-center gap-2 shadow-xl shadow-black/20">
                    <i class="fa-solid fa-plus"></i> Tambah Alat Baru
                </button>
            </header>

            <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Info Alat</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Kategori</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Stok</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Status</th>
                            <th class="p-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <tr class="hover:bg-slate-50/30 transition">
                            <td class="p-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 bg-slate-100 rounded-2xl overflow-hidden shadow-inner">
                                        <img src="img/obeng.jpg" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800">Obeng Plus (+)</p>
                                        <p class="text-[10px] text-slate-400 font-mono">ID: TOOL-001</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-6">
                                <span class="text-xs font-bold text-slate-500 bg-slate-100 px-3 py-1 rounded-lg uppercase">Hand Tools</span>
                            </td>
                            <td class="p-6">
                                <p class="font-bold text-slate-800">12 <span class="text-slate-400 font-normal text-xs">Unit</span></p>
                            </td>
                            <td class="p-6">
                                <span class="flex items-center gap-2 text-green-600 text-xs font-bold">
                                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span> Baik
                                </span>
                            </td>
                            <td class="p-6">
                                <div class="flex gap-2">
                                    <button class="w-10 h-10 flex items-center justify-center rounded-xl bg-slate-100 text-slate-600 hover:bg-slate-200 transition">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button class="w-10 h-10 flex items-center justify-center rounded-xl bg-red-50 text-red-500 hover:bg-red-100 transition">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <div id="modal-add" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-lg rounded-[2.5rem] p-8 shadow-2xl">
            <h3 class="text-2xl font-black text-slate-800 mb-6">Tambah Inventaris</h3>
            <form action="#" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Nama Alat</label>
                        <input type="text" class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none focus:ring-2 focus:ring-black transition" placeholder="Contoh: Multimeter Digital">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Kategori</label>
                        <select class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none">
                            <option>Hand Tools</option>
                            <option>Measuring</option>
                            <option>Power Tools</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Jumlah Stok</label>
                        <input type="number" class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-slate-100 outline-none">
                    </div>
                </div>
                <div class="pt-6 flex gap-4">
                    <button type="button" onclick="closeAddModal()" class="flex-1 py-4 font-bold text-slate-400">Batal</button>
                    <button type="submit" class="flex-[2] py-4 bg-black text-white rounded-2xl font-black shadow-xl shadow-black/20">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openAddModal() { document.getElementById('modal-add').classList.remove('hidden'); }
        function closeAddModal() { document.getElementById('modal-add').classList.add('hidden'); }
    </script>
</body>
</html>