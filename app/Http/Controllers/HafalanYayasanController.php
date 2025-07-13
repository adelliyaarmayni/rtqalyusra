<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periode;
use App\Models\JadwalMengajar;
use App\Models\DetailHafalan;
use Illuminate\Support\Facades\DB;

class HafalanYayasanController extends Controller
{
    public function index()
    {
        return view('yayasan.hafalansantriY.index');
    }

    public function detail(Request $request, $cabang)
    {
        $periodes = Periode::orderByDesc('tahun_awal')->get();

        $periodeFilter = $request->input('periode');
        $periode = $periodeFilter
            ? Periode::where('tahun_ajaran', $periodeFilter)->first()
            : $periodes->first();

        $chartData = [];

        if ($periode) {
            // Ambil semua jadwal di cabang dan periode itu
            $jadwalIds = JadwalMengajar::where('periode_id', $periode->id)
                ->where('cabang', $cabang)
                ->pluck('id');

            // Ambil semua detail hafalan berdasarkan jadwal
            $hafalan = DetailHafalan::with('jadwal')
                ->whereIn('jadwal_mengajar_id', $jadwalIds)
                ->get();

            // Ambil hanya hafalan tertinggi tiap santri
            $filtered = $hafalan
                ->groupBy('santri_id')
                ->map(function ($items) {
                    return $items->sortByDesc('juz')->first(); // hanya satu data per santri
                });

            // Kelompokkan berdasarkan kelas dan kelompok juz
            $grouped = $filtered->groupBy(fn($item) => $item->jadwal->kelas ?? 'Tidak Diketahui')
                ->map(function ($items, $kelas) {
                    return [
                        'kelas' => $kelas,
                        'juz_1_5'    => $items->whereBetween('juz', [1, 5])->count(),
                        'juz_6_10'   => $items->whereBetween('juz', [6, 10])->count(),
                        'juz_11_15'  => $items->whereBetween('juz', [11, 15])->count(),
                        'juz_16_20'  => $items->whereBetween('juz', [16, 20])->count(),
                        'juz_21_25'  => $items->whereBetween('juz', [21, 25])->count(),
                        'juz_26_30'  => $items->whereBetween('juz', [26, 30])->count(),
                    ];
                });

            // Urutkan kelas secara manual
            $urutanKelas = ['Halaqah A', 'Halaqah B', 'Halaqah C', 'Halaqah D', 'Halaqah E'];
            $chartData = collect($urutanKelas)
                ->filter(fn($k) => isset($grouped[$k]))
                ->map(fn($k) => $grouped[$k])
                ->values();
        }

        return view('yayasan.hafalansantriY.detail', [
            'cabang' => $cabang,
            'periodes' => $periodes,
            'periodeFilter' => $periode->tahun_ajaran ?? null,
            'chartData' => $chartData,
        ]);
    }
}
