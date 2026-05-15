@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    
    <div>
        <h4 class="fw-bold mb-1">Manajemen Data Siswa</h4>

    <a href="{{ route('siswa.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Tambah Siswa
    </a>
</div>

{{-- Notifikasi Sukses --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3">No</th>
                        <th>Nama Siswa</th>
                        <th>NIS</th>
                        <th>Kelas</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $dataSiswa = \App\Models\Siswa::latest('id_siswa')->get(); @endphp
                    
                    @forelse($dataSiswa as $index => $item)
                    <tr class="align-middle">
                        <td class="px-4">{{ $index + 1 }}</td>
                        <td class="fw-bold text-primary">{{ $item->nama_siswa }}</td>
                        <td>{{ $item->nis }}</td>
                        <td><span class="badge bg-secondary">{{ $item->kelas }}</span></td>
                        <td><span class="badge bg-success bg-opacity-10 text-success">Aktif</span></td>
                        <td class="text-center">
                            <a href="{{ route('siswa.edit', $item->id_siswa) }}" class="btn btn-sm btn-light border">
                                <i class="bi bi-pencil text-primary"></i>
                            </a>
                            
                            <form action="{{ route('siswa.destroy', $item->id_siswa) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light border">
                                    <i class="bi bi-trash text-danger"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            Belum ada data siswa.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection