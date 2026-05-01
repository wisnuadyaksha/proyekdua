<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - Sistem Peminjaman</title>
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
                <a href="#" class="flex items-center gap-3 bg-black text-white px-4 py-3 rounded-xl shadow-lg shadow-black/10">
                    <i class="fa-solid fa-house"></i> Dashboard
                </a>
                <a href="#" class="flex items-center gap-3 text-slate-500 hover:bg-slate-100 px-4 py-3 rounded-xl transition">
                    <i class="fa-solid fa-clock-rotate-left"></i> Riwayat
                </a>
                <a href="index.php" class="flex items-center gap-3 text-red-500 hover:bg-red-50 px-4 py-3 rounded-xl transition mt-20">
                    <i class="fa-solid fa-right-from-bracket"></i> Keluar
                </a>
            </nav>
        </aside>

        <main class="flex-1 p-4 md:p-10">
            <header class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800">Katalog Alat</h2>
                    <p class="text-slate-500">Pilih alat yang ingin kamu pinjam hari ini</p>
                </div>
                <div class="flex items-center gap-4">
                    <button class="relative p-2 bg-white border border-slate-200 rounded-full text-slate-600">
                        <i class="fa-solid fa-bell"></i>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                    </button>
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-bold text-slate-800">Nama Siswa</p>
                        <p class="text-xs text-slate-500">XI TOI 1</p>
                    </div>
                    <div class="w-10 h-10 bg-slate-200 rounded-full overflow-hidden border-2 border-white shadow-sm text-center content-center">
                         <i class="fa-solid fa-user text-slate-400"></i>
                    </div>
                </div>
            </header>

            <div class="bg-amber-50 border-l-4 border-amber-400 p-4 rounded-xl mb-8 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-exclamation text-amber-500 text-xl"></i>
                    <div>
                        <p class="text-sm text-amber-800 font-bold">Peringatan Pengembalian</p>
                        <p class="text-xs text-amber-700">Kamu memiliki 1 alat yang melewati batas waktu. Denda saat ini: <span class="font-bold">Rp 5.000</span></p>
                    </div>
                </div>
                <button class="text-xs font-bold bg-amber-200 text-amber-800 px-3 py-1 rounded-lg uppercase">Detail</button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <div class="bg-blue-600 p-6 rounded-3xl text-white shadow-xl shadow-blue-200">
                    <p class="text-blue-100 text-sm mb-1 font-medium">Total Pinjaman</p>
                    <h3 class="text-3xl font-bold">3 <span class="text-lg font-normal">Alat</span></h3>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                    <p class="text-slate-500 text-sm mb-1 font-medium">Belum Kembali</p>
                    <h3 class="text-3xl font-bold text-slate-800">1</h3>
                </div>
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
                    <p class="text-slate-500 text-sm mb-1 font-medium">Denda Aktif</p>
                    <h3 class="text-3xl font-bold text-red-500">Rp 5.000</h3>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <div class="bg-white rounded-3xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition">
                    <div class="bg-slate-100 h-40 rounded-2xl mb-4 overflow-hidden">
                        <img src="img/obeng.jpg" class="w-full h-full object-cover" alt="Obeng">
                    </div>
                    <div class="flex justify-between items-start mb-2">
                        <h4 class="font-bold text-slate-800">Obeng Plus (+)</h4>
                        <span class="bg-green-100 text-green-600 text-[10px] px-2 py-1 rounded-lg font-bold uppercase tracking-wider">Tersedia</span>
                    </div>
                    <p class="text-xs text-slate-400 mb-4 italic leading-relaxed">Hand tools untuk memasang baut...</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-400 bg-slate-50 px-2 py-1 rounded-md">Hand Tools</span>
                        <button onclick="openModal('Obeng Plus (+)', 'img/obeng.jpg')" class="bg-black text-white text-sm px-4 py-2 rounded-xl font-bold hover:bg-slate-800 transition">Pinjam</button>
                    </div>
                </div>

                <div class="bg-white rounded-3xl p-4 border border-slate-100 shadow-sm hover:shadow-md transition">
                    <div class="bg-slate-100 h-40 rounded-2xl mb-4 overflow-hidden">
                        <img src="img/resistor.jpg" class="w-full h-full object-cover" alt="Resistor">
                    </div>
                    <div class="flex justify-between items-start mb-2">
                        <h4 class="font-bold text-slate-800">Resistor 10k</h4>
                        <span class="bg-slate-100 text-slate-400 text-[10px] px-2 py-1 rounded-lg font-bold uppercase tracking-wider">Stok: 50</span>
                    </div>
                    <p class="text-xs text-slate-400 mb-4 italic leading-relaxed">Komponen elektronik pasif...</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-400 bg-slate-50 px-2 py-1 rounded-md">Electronics</span>
                        <button class="bg-slate-100 text-slate-800 text-sm px-4 py-2 rounded-xl font-bold hover:bg-slate-200 transition">Ambil</button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="modal-pinjam" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[100] hidden flex items-center justify-center p-4">
        <div class="bg-white w-full max-w-md rounded-[2.5rem] overflow-hidden shadow-2xl transition-all scale-95 opacity-0 duration-300" id="modal-content">
            <div class="p-6 border-b border-slate-50 flex justify-between items-center">
                <h3 class="font-bold text-lg text-slate-800">Isi Detail Peminjaman</h3>
                <button onclick="closeModal()" class="w-8 h-8 flex items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:text-slate-600 transition">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form action="#" method="POST" class="p-8 space-y-6">
                <div class="flex gap-5">
                    <div class="w-24 h-24 bg-slate-100 rounded-2xl overflow-hidden shadow-inner">
                        <img id="modal-img-preview" src="" class="w-full h-full object-cover">
                    </div>
                    <div class="flex flex-col justify-center">
                        <h4 id="modal-item-title" class="font-black text-slate-800 text-xl tracking-tight"></h4>
                        <p class="text-xs text-slate-400 font-bold bg-slate-50 px-2 py-1 rounded-lg inline-block mt-2 uppercase tracking-widest">Alat Workshop</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Jumlah Pinjam</label>
                        <div class="flex items-center bg-slate-50 rounded-2xl border border-slate-100 p-1">
                            <button type="button" onclick="adjustValue(-1)" class="w-12 h-12 flex items-center justify-center bg-white rounded-xl shadow-sm hover:bg-slate-100 transition">-</button>
                            <input type="number" id="input-jumlah" name="jumlah" value="1" class="bg-transparent w-full text-center outline-none font-bold text-lg">
                            <button type="button" onclick="adjustValue(1)" class="w-12 h-12 flex items-center justify-center bg-white rounded-xl shadow-sm hover:bg-slate-100 transition">+</button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Durasi Pinjam (Hari)</label>
                        <select name="durasi" class="w-full px-5 py-4 rounded-2xl bg-slate-50 border border-slate-100 font-bold text-slate-700 outline-none focus:ring-2 focus:ring-black transition appearance-none">
                            <option value="1">1 Hari (Kembali Besok)</option>
                            <option value="2">2 Hari</option>
                            <option value="3">3 Hari</option>
                            <option value="7">1 Minggu</option>
                        </select>
                    </div>
                </div>

                <div class="pt-2 flex gap-4">
                    <button type="button" onclick="closeModal()" class="flex-1 py-4 font-bold text-slate-400 hover:text-slate-600 transition">Batal</button>
                    <button type="submit" class="flex-[2] py-4 bg-black text-white rounded-2xl font-black shadow-xl shadow-black/20 hover:scale-[1.02] active:scale-95 transition-all">
                        Konfirmasi Pinjam
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openModal(title, imgPath) {
            const modal = document.getElementById('modal-pinjam');
            const content = document.getElementById('modal-content');
            
            document.getElementById('modal-item-title').innerText = title;
            document.getElementById('modal-img-preview').src = imgPath;

            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('modal-pinjam');
            const content = document.getElementById('modal-content');
            
            content.classList.add('scale-95', 'opacity-0');
            content.classList.remove('scale-100', 'opacity-100');
            
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        function adjustValue(change) {
            const input = document.getElementById('input-jumlah');
            let val = parseInt(input.value) + change;
            if (val < 1) val = 1;
            input.value = val;
        }
    </script>

</body>
</html>