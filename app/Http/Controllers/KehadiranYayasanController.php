<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\JadwalMengajar;
use App\Models\DetailKehadiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KehadiranYayasanController extends Controller
{
    public function index()
    {
        // Halaman awal: menampilkan daftar cabang
        return view('yayasan.kehadiranY.index');
    }

    public function detail(Request $request, $cabang)
    {
        // Ambil semua periode untuk dropdown
        $periodes = Periode::orderByDesc('tahun_awal')->get();
        
        // Gunakan session periode aktif
        $selectedPeriode = session('periode_aktif_guru');
        $periode = $selectedPeriode ? Periode::find($selectedPeriode) : $periodes->first();

        $chartData = [];
        if ($periode) {
            // Ambil semua jadwal mengajar di periode ini untuk cabang tertentu
            $jadwalIds = JadwalMengajar::where('periode_id', $periode->id)
                ->where('cabang', $cabang)
                ->pluck('id');

            // Ambil kehadiran berdasarkan kelas
            $rawKehadiran = DetailKehadiran::whereIn('jadwal_mengajar_id', $jadwalIds)
                ->with('jadwal')
                ->get()
                ->groupBy(fn($item) => $item->jadwal->kelas ?? 'Tidak Diketahui')
                ->map(function ($items, $kelas) {
                    return [
                        'kelas' => $kelas,
                        'hadir' => $items->where('status_kehadiran', 'Hadir')->count(),
                        'alfa' => $items->where('status_kehadiran', 'Alfa')->count(),
                    ];
                })->values();
            $chartData = $rawKehadiran;
        }

        return view('yayasan.kehadiranY.detail', [
            'cabang' => $cabang,
            'periodes' => $periodes,
            'selectedPeriode' => $selectedPeriode,
            'selectedPeriodeNama' => $periode?->tahun_ajaran ?? 'Pilih Periode',
            'chartData' => $chartData,
        ]);
    }
}
