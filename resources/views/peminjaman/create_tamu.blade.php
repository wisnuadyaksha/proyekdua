@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="mb-3">
        <a href="{{ url('/') }}" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
        </a>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow border-0">
                <div class="card-header bg-warning text-dark text-center">
                    <h5 class="mb-0 font-weight-bold">Formulir Peminjaman Alat (Tamu)</h5>
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
                        <div class="col-md-5 bg-light d-flex align-items-center justify-content-center p-3">
                            <div class="text-center" id="img-placeholder-tamu">
                                <i class="bi bi-camera" style="font-size: 3rem; color: #ccc;"></i>
                                <p class="small text-muted">Gambar alat akan muncul di sini</p>
                            </div>
                            <img id="preview-img-tamu" src="" class="img-fluid rounded shadow-sm" style="max-height: 300px; object-fit: contain; display: none;">
                        </div>

                        {{-- KOLOM FORMULIR --}}
                        <div class="col-md-7 p-4">
                            <form action="{{ route('peminjaman.storeTamu') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label text-secondary small fw-bold">Nama Lengkap</label>
                                    <input type="text" name="nama_peminjam" class="form-control bg-light border-0" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small fw-bold">Asal Jurusan / Prodi / Instansi</label>
                                    <input type="text" name="jurusan" class="form-control bg-light border-0" placeholder="Contoh: Teknik Otomasi Industri" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small fw-bold">Nomor Telepon / WhatsApp</label>
                                    <input type="number" name="no_telp" class="form-control bg-light border-0" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-secondary small fw-bold">Foto KTP / Identitas (Wajib)</label>
                                    <input type="file" name="foto_ktp" class="form-control bg-light border-0" accept="image/jpeg,image/png,image/jpg" required>
                                    <div class="form-text text-muted small"><i class="bi bi-shield-check text-success"></i> Identitas diperlukan untuk keamanan. Max 2MB (JPG/PNG).</div>
                                </div>
                                <div id="alat-container-tamu">
                                    <div class="alat-item-tamu border bg-white rounded p-3 mb-3 position-relative shadow-sm">
                                        <div class="row">
                                            <div class="col-md-8 mb-2">
                                                <label class="form-label text-secondary small fw-bold">Pilih Alat</label>
                                                <select name="id_barang[]" class="form-select bg-light border-0 select-barang-tamu" required>
                                                    <option value="" disabled selected>-- Pilih Alat --</option>
                                                    @foreach($barangs as $barang)
                                                        <option value="{{ $barang->id_barang }}" 
                                                                data-stok="{{ $barang->stok_tersedia }}"
                                                                data-satuan="{{ $barang->satuan }}" 
                                                                data-jenis="{{ $barang->jenis_barang }}"
                                                                data-foto="{{ $barang->foto_barang }}">
                                                            {{ $barang->nama_barang }} (Stok: {{ $barang->stok_tersedia }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-2">
                                                <label class="form-label text-secondary small fw-bold">Jumlah <span class="satuan-text-tamu text-primary"></span></label>
                                                <input type="number" name="jumlah_pinjam[]" class="form-control bg-light border-0" min="1" required>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 mt-2 me-2 btn-hapus-alat-tamu" style="display: none;"><i class="bi bi-trash"></i></button>
                                    </div>
                                </div>
                                <button type="button" id="btn-tambah-alat-tamu" class="btn btn-outline-primary btn-sm mb-4"><i class="bi bi-plus-circle me-1"></i> Tambah Alat Lainnya</button>

                                <div class="row mb-3">
                                    <div class="col-md-12" id="container-tgl-kembali">
                                        <label class="form-label text-secondary small fw-bold">Rencana Kembali</label>
                                        <input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control bg-light border-0" required>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label text-secondary small fw-bold">Catatan / Keperluan Khusus <span class="text-danger">*</span></label>
                                    <textarea name="catatan" class="form-control bg-light border-0" rows="2" placeholder="Wajib diisi" required></textarea>
                                </div>
                                
                                <div class="mb-4 form-check bg-light p-3 rounded border-0">
                                    <input class="form-check-input ms-1 mt-1" type="checkbox" value="1" id="ketentuanTamu" required>
                                    <label class="form-check-label text-muted small ms-2" for="ketentuanTamu">
                                        Saya setuju untuk mematuhi peraturan peminjaman, menjaga alat dengan baik, dan bersedia mengganti atau bertanggung jawab penuh jika terjadi kerusakan atau kehilangan atas alat yang saya pinjam.
                                    </label>
                                </div>

                                <button type="submit" class="btn btn-warning w-100 fw-bold py-2 rounded-pill shadow-sm">
                                    <i class="bi bi-send-fill me-2"></i> Kirim Permohonan Pinjam
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    document.addEventListener("DOMContentLoaded", function() {
        const containerTamu = document.getElementById('alat-container-tamu');
        const btnTambahTamu = document.getElementById('btn-tambah-alat-tamu');

        function attachSelectEventTamu(selectElement) {
            selectElement.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const fotoPath = selectedOption.getAttribute('data-foto');
                const satuan = selectedOption.getAttribute('data-satuan');
                const jenis = selectedOption.getAttribute('data-jenis');
                
                const imgElement = document.getElementById('preview-img-tamu');
                const placeholder = document.getElementById('img-placeholder-tamu');
                
                const row = this.closest('.row');
                if(row) {
                    const satuanText = row.querySelector('.satuan-text-tamu');
                    if(satuanText) {
                        satuanText.innerText = satuan ? `(${satuan})` : '';
                    }
                }

                // Cek apakah semua barang yang dipilih adalah Habis Pakai
                let allHabisPakai = true;
                document.querySelectorAll('.select-barang-tamu').forEach(select => {
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

                if (fotoPath && fotoPath !== "NULL" && fotoPath !== "") {
                    placeholder.style.display = 'none';
                    imgElement.src = "{{ asset('img/alat') }}/" + fotoPath;
                    imgElement.style.display = 'block';
                } else {
                    placeholder.style.display = 'block';
                    imgElement.style.display = 'none';
                }
            });
        }

        // Attach event ke elemen pertama
        document.querySelectorAll('.select-barang-tamu').forEach(attachSelectEventTamu);

        if(btnTambahTamu) {
            btnTambahTamu.addEventListener('click', function() {
                const firstItem = document.querySelector('.alat-item-tamu');
                const newItem = firstItem.cloneNode(true);
                
                // Reset value
                newItem.querySelector('select').selectedIndex = 0;
                newItem.querySelector('input[type="number"]').value = '';
                newItem.querySelector('.satuan-text-tamu').innerText = '';
                
                // Tampilkan tombol hapus
                newItem.querySelector('.btn-hapus-alat-tamu').style.display = 'block';
                
                // Attach event hapus
                newItem.querySelector('.btn-hapus-alat-tamu').addEventListener('click', function() {
                    newItem.remove();
                    const firstSelect = document.querySelector('.select-barang-tamu');
                    if(firstSelect) firstSelect.dispatchEvent(new Event('change'));
                });
                
                attachSelectEventTamu(newItem.querySelector('.select-barang-tamu'));
                
                containerTamu.appendChild(newItem);
            });
        }
    });
</script>
@endsection