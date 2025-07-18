<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KinerjaGuru;
use App\Models\JawabanKinerja;
use App\Models\Periode;
use App\Models\Kategori;
use App\Models\Guru;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class KinerjaGuruAdminController extends Controller
{
    public function index(Request $request)
    {
        // Gunakan session periode aktif
        $selectedPeriode = session('periode_aktif_guru');
        $periode = $selectedPeriode ? Periode::find($selectedPeriode) : null;
        
        // Ambil semua periode untuk dropdown
        $periodes = Periode::orderByDesc('tahun_awal')->get();
        
        // Dapatkan nama tahun ajaran dari periode terpilih
        $selectedPeriodeNama = $periode?->tahun_ajaran ?? 'Pilih Periode';

        $kategoriList = Kategori::all();
        $kinerjaList = collect();

        if ($periode) {
            $kinerjas = KinerjaGuru::where('periode_id', $periode->id)->get();
            foreach ($kinerjas as $kinerja) {
                $penilaian = [];
                foreach ($kategoriList as $kategori) {
                    $jawaban = JawabanKinerja::where('kinerja_id', $kinerja->id)
                        ->where('kategori_id', $kategori->id)
                        ->value('jawaban');
                    $penilaian[$kategori->kategori] = $jawaban ?? '-';
                }
                $guru = \App\Models\Guru::where('nama_guru', $kinerja->nama_guru)->first();
                $cabang = $guru ? $guru->cabang : '-';
                $kinerjaList->push([
                    'nama_guru' => $kinerja->nama_guru,
                    'cabang' => $cabang,
                    'jumlahTelat' => $kinerja->jumlahTelat,
                    'penilaian' => $penilaian,
                ]);
            }
        }

        // Pagination manual dari Collection
        $page = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $paginatedKinerjaList = new LengthAwarePaginator(
            $kinerjaList->forPage($page, $perPage),
            $kinerjaList->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.kinerjaguru.index', [
            'kinerjaList' => $paginatedKinerjaList,
            'kategoriList' => $kategoriList,
            'periodes' => $periodes,
            'selectedPeriode' => $selectedPeriode,
            'selectedPeriodeNama' => $selectedPeriodeNama,
        ]);
    }
}
