@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="mb-3">
        <a href="{{ auth()->user()->role === 'guru' ? route('dashboard.guru') : route('dashboard.siswa') }}" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
        </a>
    </div>
    <div class="card shadow-sm border-0" style="border-radius: 15px;">
        <div class="card-header bg-dark text-white" style="border-radius: 15px 15px 0 0;">
            <h5 class="mb-0 py-1"><i class="bi bi-file-earmark-text me-2"></i>Formulir Peminjaman Alat</h5>
        </div>

        @if(session('error'))
            <div class="alert alert-danger m-3">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success m-3">{{ session('success') }}</div>
        @endif
        <div class="card-body p-0">
            <div class="row g-0">
                {{-- KOLOM GAMBAR --}}
                <div class="col-md-4 bg-light d-flex align-items-center justify-content-center p-3" style="border-radius: 15px 0 0 15px;">
                    <div class="text-center" id="img-placeholder">
                        <i class="bi bi-image" style="font-size: 3rem; color: #ccc;"></i>
                        <p class="small text-muted">Pilih alat untuk melihat gambar</p>
                    </div>
                    <img id="preview-img" src="" class="img-fluid rounded shadow-sm" style="max-height: 250px; object-fit: contain; display: none;">
                </div>

                {{-- KOLOM FORMULIR --}}
                <div class="col-md-8 p-4">
                    <form action="{{ auth()->user()->role === 'guru' ? route('peminjaman.guru.store') : route('peminjaman.siswa.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nama Peminjam</label>
                            <input type="text" name="nama_peminjam" class="form-control" value="{{ auth()->user()->name }}" required readonly>
                        </div>
                        
                        <div id="alat-container">
                            <div class="alat-item border rounded p-3 mb-3 bg-white position-relative shadow-sm">
                                <div class="row">
                                    <div class="col-md-8 mb-2">
                                        <label class="form-label fw-bold">Pilih Alat</label>
                                        <select name="id_barang[]" class="form-select select-barang" required>
                                            <option value="" disabled selected>-- Pilih Alat --</option>
                                            @foreach($barangs as $barang)
                                                <option value="{{ $barang->id_barang }}" data-foto="{{ $barang->foto_barang }}" data-satuan="{{ $barang->satuan }}" data-jenis="{{ $barang->jenis_barang }}">
                                                    {{ $barang->nama_barang }} (Tersedia: {{ $barang->stok_tersedia }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <label class="form-label fw-bold">Jumlah <span class="satuan-text text-primary"></span></label>
                                        <input type="number" name="jumlah_pinjam[]" class="form-control" min="1" required>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 mt-2 me-2 btn-hapus-alat" style="display: none;"><i class="bi bi-trash"></i></button>
                            </div>
                        </div>
                        
                        <button type="button" id="btn-tambah-alat" class="btn btn-outline-primary btn-sm mb-4"><i class="bi bi-plus-circle me-1"></i> Tambah Alat Lainnya</button>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label fw-bold">Tanggal Pinjam</label>
                                <input type="date" name="tgl_pinjam" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-4 mb-3" id="container-tgl-kembali">
                                <label class="form-label fw-bold">Rencana Kembali</label>
                                <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Catatan / Tujuan Peminjaman <span class="text-danger">*</span></label>
                            <textarea name="catatan" class="form-control" rows="3" placeholder="Wajib diisi" required></textarea>
                        </div>

                        <div class="mb-4 form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="ketentuan" required>
                            <label class="form-check-label text-muted small" for="ketentuan">
                                Saya setuju untuk menjaga alat dengan baik dan mengembalikan sesuai dengan tanggal rencana pengembalian. Jika terjadi kerusakan atau kehilangan, saya bersedia bertanggung jawab.
                            </label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ auth()->user()->role === 'guru' ? route('dashboard.guru') : route('dashboard.siswa') }}" class="btn btn-outline-secondary px-4 rounded-pill">Batal</a>
                            <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">Ajukan Peminjaman</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const container = document.getElementById('alat-container');
        const btnTambah = document.getElementById('btn-tambah-alat');

        // Fungsi untuk menangani perubahan pada select barang
        function attachSelectEvent(selectElement) {
            selectElement.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const fotoPath = selectedOption.getAttribute('data-foto');
                const satuan = selectedOption.getAttribute('data-satuan');
                const jenis = selectedOption.getAttribute('data-jenis');
                
                const imgElement = document.getElementById('preview-img');
                const placeholder = document.getElementById('img-placeholder');
                
                // Cari elemen satuan-text di dalam parent row yang sama
                const row = this.closest('.row');
                if(row) {
                    const satuanText = row.querySelector('.satuan-text');
                    if(satuanText) {
                        satuanText.innerText = satuan ? `(${satuan})` : '';
                    }
                }

                // Cek apakah semua barang yang dipilih adalah Habis Pakai
                // Jika YA, maka rencana kembali tidak wajib
                let allHabisPakai = true;
                document.querySelectorAll('.select-barang').forEach(select => {
                    if (select.selectedIndex > 0) {
                        const j = select.options[select.selectedIndex].getAttribute('data-jenis');
                        if (j !== 'Habis Pakai') allHabisPakai = false;
                    } else {
                        allHabisPakai = false;
                    }
                });

                const tglContainer = document.getElementById('container-tgl-kembali');
                const tglInput = document.getElementById('tgl_kembali');
                
                if(allHabisPakai) {
                    if(tglContainer) tglContainer.style.display = 'none';
                    if(tglInput) tglInput.required = false;
                } else {
                    if(tglContainer) tglContainer.style.display = 'block';
                    if(tglInput) tglInput.required = true;
                }

                // Tampilkan gambar untuk item yang terakhir diubah
                if (fotoPath && fotoPath !== "NULL" && fotoPath !== "") {
                    placeholder.style.display = 'none';
                    const filename = fotoPath.replace(/^alat\//, '');
                    imgElement.src = "{{ asset('img/alat') }}/" + filename; 
                    imgElement.style.display = 'block';
                } else {
                    placeholder.style.display = 'block';
                    imgElement.style.display = 'none';
                }
            });
        }

        // Attach event ke elemen pertama
        document.querySelectorAll('.select-barang').forEach(attachSelectEvent);

        // Tambah Alat Lainnya
        if(btnTambah) {
            btnTambah.addEventListener('click', function() {
                const firstItem = document.querySelector('.alat-item');
                const newItem = firstItem.cloneNode(true);
                
                // Reset value
                newItem.querySelector('select').selectedIndex = 0;
                newItem.querySelector('input[type="number"]').value = '';
                newItem.querySelector('.satuan-text').innerText = '';
                
                // Tampilkan tombol hapus
                newItem.querySelector('.btn-hapus-alat').style.display = 'block';
                
                // Attach event hapus
                newItem.querySelector('.btn-hapus-alat').addEventListener('click', function() {
                    newItem.remove();
                    // trigger change untuk update tampilan tanggal kembali jika perlu
                    const firstSelect = document.querySelector('.select-barang');
                    if(firstSelect) firstSelect.dispatchEvent(new Event('change'));
                });
                
                // Attach event change
                attachSelectEvent(newItem.querySelector('.select-barang'));
                
                container.appendChild(newItem);
            });
        }
    });
</script>
@endsection