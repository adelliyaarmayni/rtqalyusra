<?php

namespace App\Http\Controllers;

use App\Models\DetailHafalan;
use App\Models\JadwalMengajar;
use App\Models\Periode;
use App\Models\Santri;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class DetailHafalanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $guru = $user->guru;

        $listPeriode = Periode::orderBy('tahun_awal', 'asc')->get();
        $selectedPeriode = request('periode_id');

        if ($guru) {
            $jadwal = JadwalMengajar::where('guru_id', $guru->id)
                ->when($selectedPeriode, fn($q) => $q->where('periode_id', $selectedPeriode))
                ->get();

            $kelasUnik = $jadwal->pluck('kelas')->unique();
        } else {
            $jadwal = collect();
            $kelasUnik = collect();
        }

        return view('guru.hafalansantri.index', compact('jadwal', 'kelasUnik', 'listPeriode', 'selectedPeriode'));
    }


    public function input($namaKelas)
    {
        $user = Auth::user();
        $guru = $user->guru;
        $periodeId = request('periode_id');

        $namaKelas = ucfirst($namaKelas);

        $surahList = json_decode(File::get(resource_path('data/surah.json')), true);
        $juzList = json_decode(File::get(resource_path('data/juz.json')), true);

        $jadwal = JadwalMengajar::where('guru_id', $guru->id)
            ->where('kelas', $namaKelas)
            ->when($periodeId, fn($q) => $q->where('periode_id', $periodeId))
            ->with(['guru', 'periode'])
            ->get();

        if (!$jadwal || $jadwal->isEmpty()) {
            return redirect()->route('guru.hafalansantri.index')->with('error', 'Jadwal mengajar tidak ditemukan.');
        }

        $santri = Santri::where('kelas', $namaKelas)
            ->where('cabang', $guru->cabang)
            ->when($periodeId, fn($q) => $q->where('periode_id', $periodeId))
            ->get();

        return view('guru.hafalansantri.input', [
            'namaKelas' => $namaKelas,
            'santri' => $santri,
            'guru' => $guru,
            'jadwal' => $jadwal,
            'listSurah' => $surahList,
            'listJuz' => $juzList
        ]);
    }

    public function detail($kelas)
    {
        $surahList = json_decode(File::get(resource_path('data/surah.json')), true);
        $juzList = json_decode(File::get(resource_path('data/juz.json')), true);
        $selectedPeriode = request('periode_id');

        $santri = Santri::where('kelas', $kelas)
            ->when($selectedPeriode, fn($q) => $q->where('periode_id', $selectedPeriode))
            ->get();

        return view('guru.hafalansantri.detail')->with([
            'santri' => $santri,
            'listSurah' => $surahList,
            'listJuz' => $juzList,
            'kelas' => $kelas,
            'selectedPeriode' => $selectedPeriode
        ]);
    }

    public function store(Request $request)
    {
        $rawSurah = json_decode(File::get(resource_path('data/surah.json')), true);
        $rawJuz = json_decode(File::get(resource_path('data/juz.json')), true);

        // Ambil transliterasi Surah
        $surahList = collect($rawSurah['data'])->pluck('name.transliteration.id')->toArray();

        // Ambil nomor Juz sebagai string: ["1", "2", ..., "30"]
        $juzList = collect($rawJuz['data'])->pluck('juz')->map(fn($val) => (string) $val)->toArray();

        $request->validate([
            'tanggal' => 'required|date',
            'jadwal_mengajar_id' => 'required|integer|exists:jadwal_mengajar,id',
            'hafalan' => 'required|array',
            'hafalan.*.santri_id' => 'required|exists:santri,id',
            'hafalan.*.surah' => ['required', 'string', Rule::in($surahList)],
            'hafalan.*.juz' => ['required', 'string', Rule::in($juzList)],
            'hafalan.*.ayat_awal' => 'required|string',
            'hafalan.*.ayat_akhir' => 'required|string',
        ]);

        foreach ($request->hafalan as $data) {
            DetailHafalan::create([
                'santri_id' => $data['santri_id'],
                'jadwal_mengajar_id' => $request->jadwal_mengajar_id,
                'tanggal' => $request->tanggal,
                'surah' => $data['surah'],
                'juz' => $data['juz'],
                'ayat_awal' => $data['ayat_awal'],
                'ayat_akhir' => $data['ayat_akhir'],
            ]);
        }

        return redirect()->route('guru.hafalansantri.detail', [
            'kelas' => $request->kelas,
            'periode_id' => $request->periode_id,
            'tanggal' => $request->tanggal,
        ])
            ->with('success', 'Hafalan Santri berhasil disimpan.');
    }

    public function getHafalanByDate($kelas, $tanggal)
    {
        $user = Auth::user();
        $guru = $user->guru;
        $periodeId = request('periode_id');
        $page = request('page', 1);
        $perPage = 10;

        try {
            $parseDate = Carbon::parse($tanggal)->toDateString();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Format tanggal tidak valid.'], 400);
        }

        $jadwal = JadwalMengajar::where('guru_id', $guru->id)
            ->where('kelas', $kelas)
            ->when($periodeId, fn($q) => $q->where('periode_id', $periodeId))
            ->first();

        if (!$jadwal) {
            return response()->json([]);
        }

        $query = DetailHafalan::where('jadwal_mengajar_id', $jadwal->id)
            ->whereDate('tanggal', $parseDate)
            ->with('santri');

        $total = $query->count();
        $items = $query->skip(($page - 1) * $perPage)->take($perPage)->get();

        return response()->json([
            'data' => $items,
            'pagination' => [
                'total' => $total,
                'per_page' => $perPage,
                'current_page' => $page,
            ]
        ]);
    }
}
