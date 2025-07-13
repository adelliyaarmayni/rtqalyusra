<?php

namespace App\Http\Controllers;

use App\Models\DetailHafalan;
use App\Models\DetailKehadiran;
use App\Models\Dokumentasi;
use App\Models\JadwalMengajar;
use App\Models\Periode;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        \Log::info('Dashboard route hit');
        $user = Auth::user();
        \Log::info('Logged in as: ' . $user->name . ' with role: ' . $user->role);
        $role = $user->getRoleNames()->first();

        $periodes = Periode::orderByDesc('tahun_awal')->get();
        $periodeFilter = $request->input('periode');
        $periode = $periodeFilter
            ? Periode::where('tahun_ajaran', $periodeFilter)->first()
            : $periodes->first();

        if ($role == 'admin') {
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
                    ->mergeBindings($subquery->getQuery()) // penting agar parameter binding tetap jalan
                    ->select('max_juz as juz', DB::raw('COUNT(*) as total'))
                    ->groupBy('max_juz')
                    ->orderBy('max_juz')
                    ->get();
            }

            $periodes = Periode::orderByDesc('tahun_awal')->get();

            return view('admin.dashboard.master', compact(
                'guruCount',
                'santriCount',
                'kehadiranData',
                'hafalanByJuz',
                'periodes',
                'periodeFilter'
            ));
        } elseif ($role == 'guru') {
            $guruId = $user->guru->id ?? null;
            if (!$guruId)
                return abort(403, 'Guru tidak ditemukan.');

            $periodes = Periode::orderBy('tahun_awal', 'asc')->get();

            // Default ke periode terbaru jika tidak ada yang dipilih
            $selectedPeriode = $request->input('periode_id') ?? $periodes->first()?->id;

            // Dapatkan nama tahun ajaran dari periode terpilih
            $selectedPeriodeNama = Periode::find($selectedPeriode)?->tahun_ajaran ?? 'Pilih Periode';

            // Hitung jumlah kelas unik berdasarkan kelas + cabang
            $jumlahKelas = JadwalMengajar::where('guru_id', $guruId)
                ->when($selectedPeriode, fn($q) => $q->where('periode_id', $selectedPeriode))
                ->get()
                ->unique(fn($item) => $item->kelas . '-' . $item->cabang)
                ->count();

            $jadwalIds = JadwalMengajar::where('guru_id', $guruId)
                ->when($selectedPeriode, fn($q) => $q->where('periode_id', $selectedPeriode))
                ->pluck('id');

            $jumlahTelat = Dokumentasi::whereIn('jadwal_mengajar_id', $jadwalIds)
                ->where('status_terlambat', 'Terlambat')
                ->count();

            return view('guru.dashboard.master', [
                'jumlahKelas' => $jumlahKelas,
                'jumlahTelat' => $jumlahTelat,
                'periodes' => $periodes,
                'selectedPeriode' => $selectedPeriode,
                'selectedPeriodeNama' => $selectedPeriodeNama,
            ]);

        } elseif ($role == 'yayasan') {
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
}
