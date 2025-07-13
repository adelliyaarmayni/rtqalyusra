<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Santri;
use App\Models\Periode;
use App\Models\DetailHafalan;
use App\Models\JadwalMengajar;
use App\Models\DetailKehadiran;
use App\Models\Dokumentasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardYayasanController extends Controller
{
    public function index(Request $request)
    {
        $periodeFilter = $request->input('periode');
        $periode = $periodeFilter ? Periode::where('tahun_ajaran', $periodeFilter)->first() : null;

        // Jumlah guru berdasarkan periode
        $guruCount = 0;
        $santriCount = 0;

        if ($periode) {
            // Guru yang terlibat di jadwal mengajar dalam periode ini
            $guruIds = JadwalMengajar::where('periode_id', $periode->id)
                ->pluck('guru_id')
                ->unique();

            $guruCount = \App\Models\Guru::whereIn('id', $guruIds)->count();

            $santriCount = $periode
                ? \App\Models\Santri::where('periode_id', $periode->id)->count()
                : 0;
        }

        // Bar Chart Kehadiran berdasarkan cabang (2 bar: hadir & alfa)
        $kehadiranData = [];
        if ($periode) {
            $jadwalIds = JadwalMengajar::where('periode_id', $periode->id)->pluck('id');

            $rawKehadiran = DetailKehadiran::whereIn('jadwal_mengajar_id', $jadwalIds)
                ->with('jadwal')
                ->get()
                ->groupBy(fn($item) => $item->jadwal->cabang ?? 'Tidak Diketahui')
                ->map(function ($items, $cabang) {
                    return [
                        'cabang' => $cabang,
                        'hadir' => $items->where('status_kehadiran', 'Hadir')->count(),
                        'alfa' => $items->where('status_kehadiran', 'Alfa')->count(),
                    ];
                })->values();

            $kehadiranData = $rawKehadiran;
        }

        // Bar Chart Hafalan berdasarkan juz
        $hafalanByJuz = collect();

        if ($periode) {
            $subquery = DetailHafalan::select('santri_id', DB::raw('MAX(juz) as max_juz'))
                ->whereHas('jadwal', function ($q) use ($periode) {
                    $q->where('periode_id', $periode->id);
                })
                ->groupBy('santri_id');

            $hafalanByJuz = DB::table(DB::raw("({$subquery->toSql()}) as sub"))
                ->mergeBindings($subquery->getQuery()) 
                ->select('max_juz as juz', DB::raw('COUNT(*) as total'))
                ->groupBy('max_juz')
                ->orderBy('max_juz')
                ->get();
        }

        $periodes = Periode::orderByDesc('tahun_awal')->get();

        $chartTerlambatGuru = collect();

        if ($periode) {
            $jadwalIds = JadwalMengajar::where('periode_id', $periode->id)->pluck('id');

            $terlambatData = Dokumentasi::whereIn('jadwal_mengajar_id', $jadwalIds)
                ->where('status_terlambat', 'Terlambat')
                ->with('jadwal.guru')
                ->get();

            $chartTerlambatGuru = $terlambatData->groupBy(function ($item) {
                return $item->jadwal->guru->nama_guru ?? 'Tidak Diketahui';
            })->map(function ($items, $namaGuru) {
                return [
                    'nama_guru' => $namaGuru,
                    'jumlah' => $items->count(),
                ];
            })->values();
        }

        return view('yayasan.dashboard.master', compact(
            'guruCount',
            'santriCount',
            'kehadiranData',
            'hafalanByJuz',
            'periodes',
            'periodeFilter',
            'chartTerlambatGuru'
        ));
    }
}
