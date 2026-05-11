@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="fw-bold mb-4">Persetujuan Peminjaman Alat</h3>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Peminjam</th>
                        <th>Alat</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($peminjamans as $p)
                    <tr>
                        <td>
                            @if($p->id_siswa)
                                {{-- Jika Siswa --}}
                                <span class="fw-bold">{{ $p->siswa->nama_siswa ?? 'Siswa Terhapus' }}</span>
                                <br><small class="text-muted">NIS: {{ $p->siswa->nis ?? '-' }}</small>
                            @else
                                {{-- Jika Tamu --}}
                                <span class="fw-bold text-primary">{{ $p->nama_tamu }}</span> 
                                <br><span class="badge bg-info text-dark" style="font-size: 0.7rem;">Tamu / Umum</span>
                            @endif
                        </td>

                        <td>{{ $p->barang->nama_barang ?? 'Alat Dihapus' }}</td>
                        <td>{{ $p->jumlah_pinjam }}</td>
                        <td>
                            {{-- Warna Badge Dinamis --}}
                            @php
                                $badgeColor = 'bg-secondary';
                                if($p->status == 'Dipinjam') $badgeColor = 'bg-warning text-dark';
                                elseif($p->status == 'Kembali') $badgeColor = 'bg-success';
                                elseif($p->status == 'Ditolak') $badgeColor = 'bg-danger';
                                elseif($p->status == 'Menunggu Persetujuan') $badgeColor = 'bg-info text-dark';
                            @endphp
                            <span class="badge {{ $badgeColor }}">
                                {{ $p->status }}
                            </span>
                        </td>
                        <td>
                            @if($p->status == 'Menunggu Persetujuan' || $p->status == 'Dipinjam')
                            
                            {{-- Tombol Setujui - Paksa ID masuk ke parameter 'id' --}}
                            <form action="{{ route('persetujuan.update', ['id' => $p->id_peminjaman]) }}" method="POST" class="d-inline">
                                @csrf 
                                @method('PUT')
                                <input type="hidden" name="status" value="Dipinjam">
                                <button type="submit" class="btn btn-sm btn-success">Setujui</button>
                            </form>
                            
                            {{-- Tombol Tolak - Paksa ID masuk ke parameter 'id' --}}
                            <form action="{{ route('persetujuan.update', ['id' => $p->id_peminjaman]) }}" method="POST" class="d-inline">
                                @csrf 
                                @method('PUT')
                                <input type="hidden" name="status" value="Ditolak">
                                <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
                            </form>
                            
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection