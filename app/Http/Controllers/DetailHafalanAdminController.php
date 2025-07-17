<?php

namespace App\Http\Controllers;

use App\Models\DetailHafalan;
use App\Models\Guru;
use App\Models\JadwalMengajar;
use App\Models\Periode;
use App\Models\Santri;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DetailHafalanAdminController extends Controller
{
    public function index()
    {
        // Gunakan session periode aktif
        $selectedPeriode = session('periode_aktif_guru');
        
        $gurus = Guru::all();
        $periodes = Periode::all();
        
        return view('admin.hafalanadmin.index', compact('gurus', 'periodes', 'selectedPeriode'));
    }

    public function detail(Request $request)
    {
        // Validasi input filter
        $request->validate([
            'cabang' => 'required|string',
            'guru_id' => 'required|integer',
            'kelas' => 'required|string',
            'tanggal' => 'required|date'
        ]);

        // Gunakan session periode aktif jika tidak ada periode_id di request
        $periode_id = $request->filled('periode_id') ? $request->periode_id : session('periode_aktif_guru');
        $cabang = $request->cabang;
        $guru_id = $request->guru_id;
        $kelas = $request->kelas;
        $tanggal = Carbon::parse($request->tanggal)->toDateString();

        // Cari jadwal mengajar yang sesuai filter
        $jadwal = JadwalMengajar::where([
            'guru_id' => $guru_id,
            'kelas' => $kelas,
            'cabang' => $cabang,
            'periode_id' => $periode_id
        ])->first();

        if (!$jadwal) {
            return redirect()->route('admin.hafalanadmin.index')->with('error', 'Jadwal mengajar tidak ditemukan.');
        }

        // Ambil data hafalan berdasarkan jadwal dan tanggal
        $hafalan = DetailHafalan::where('jadwal_mengajar_id', $jadwal->id)
            ->whereDate('tanggal', $tanggal)
            ->with('santri')
            ->paginate(10)
            ->appends($request->except('page'));

        // Data tambahan untuk tampilan
        $guru = Guru::find($guru_id);
        $periode = Periode::find($periode_id);

        return view('admin.hafalanadmin.detail', [
            'hafalan' => $hafalan,
            'guru' => $guru,
            'periode' => $periode,
            'kelas' => $kelas,
            'tanggal' => $tanggal,
            'cabang' => $cabang
        ]);
    }
}
