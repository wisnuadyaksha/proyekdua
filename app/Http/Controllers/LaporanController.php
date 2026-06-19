<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Barang;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman laporan + rekap peminjaman per bulan dan minggu.
     */
    public function index(Request $request)
    {
        // Default bulan & tahun = bulan ini
        $bulan = $request->input('bulan', Carbon::now()->month);
        $tahun = $request->input('tahun', Carbon::now()->year);
        $minggu = $request->input('minggu', 'semua');

        // Query peminjaman berdasarkan bulan & tahun
        $query = Peminjaman::with(['siswa', 'barang'])
            ->whereMonth('tgl_pinjam', $bulan)
            ->whereYear('tgl_pinjam', $tahun);

        // Filter berdasarkan minggu (1-5)
        if ($minggu !== 'semua') {
            // Asumsi sederhana: minggu 1 = tgl 1-7, minggu 2 = 8-14, dst.
            $startDay = ($minggu - 1) * 7 + 1;
            $endDay = $minggu * 7;
            if ($minggu == 5) {
                $endDay = 31; // Cover sisa hari di bulan itu
            }
            $query->whereDay('tgl_pinjam', '>=', $startDay)
                  ->whereDay('tgl_pinjam', '<=', $endDay);
        }

        $laporans = $query->latest('tgl_pinjam')->get();

        // Nama bulan untuk tampilan
        $namaBulan = Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F Y');

        return view('admin.laporan.index', compact(
            'laporans', 'bulan', 'tahun', 'minggu', 'namaBulan'
        ));
    }

    /**
     * Export Laporan ke CSV (Excel)
     */
    public function exportCsv(Request $request)
    {
        $bulan = $request->input('bulan', Carbon::now()->month);
        $tahun = $request->input('tahun', Carbon::now()->year);
        $minggu = $request->input('minggu', 'semua');

        $query = Peminjaman::with(['siswa', 'barang'])
            ->whereMonth('tgl_pinjam', $bulan)
            ->whereYear('tgl_pinjam', $tahun);

        if ($minggu !== 'semua') {
            $startDay = ($minggu - 1) * 7 + 1;
            $endDay = $minggu * 7;
            if ($minggu == 5) $endDay = 31;
            $query->whereDay('tgl_pinjam', '>=', $startDay)
                  ->whereDay('tgl_pinjam', '<=', $endDay);
        }

        $laporans = $query->latest('tgl_pinjam')->get();
        $namaBulan = Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F Y');

        $fileName = "Rekap_Peminjaman_{$namaBulan}_Minggu_{$minggu}.csv";

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = ['No', 'Tanggal Pinjam', 'Peminjam', 'Role/Kelas', 'Rincian Alat & Status'];

        $callback = function() use($laporans, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            $groupedLaporans = $laporans->groupBy(function($item) {
                $identifier = $item->id_siswa ? 'siswa_'.$item->id_siswa : 'tamu_'.$item->nama_tamu;
                return $identifier . '_' . Carbon::parse($item->tgl_pinjam)->format('Y-m-d');
            });

            $nomor = 1;
            foreach ($groupedLaporans as $key => $group) {
                $first = $group->first();
                $peminjam = ($first->id_siswa && $first->siswa) ? $first->siswa->name : ($first->nama_tamu ?? 'Tamu');
                
                $role = 'Umum/Tamu';
                if ($first->id_siswa && $first->siswa) {
                    if ($first->siswa->role === 'guru') {
                        $role = 'Guru';
                    } else {
                        $role = 'Siswa - ' . ($first->siswa->class ?? '-');
                    }
                } elseif ($first->id_siswa && !$first->siswa) {
                    $role = 'User Dihapus';
                }

                $rincianAlat = [];
                foreach($group as $item) {
                    $namaAlat = $item->barang->nama_barang ?? 'Alat Dihapus';
                    $qty = $item->jumlah_pinjam . ' ' . ($item->barang->satuan ?? '');
                    $tglKembali = in_array($item->status, ['Habis Pakai', 'Ditolak']) ? '' : ($item->tgl_kembali ? '(Kembali: '.Carbon::parse($item->tgl_kembali)->format('d-m-Y').')' : '');
                    $rincianAlat[] = "- $namaAlat ($qty) [{$item->status}] $tglKembali";
                }
                
                $row = [
                    $nomor++,
                    Carbon::parse($first->tgl_pinjam)->format('d-m-Y'),
                    $peminjam,
                    $role,
                    implode("\n", $rincianAlat)
                ];

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}