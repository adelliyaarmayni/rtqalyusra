<?php

namespace App\Http\Controllers;

use App\Models\Dokumentasi;
use Illuminate\Http\Request;
use App\Models\JadwalMengajar;
use App\Models\Periode;
use Illuminate\Support\Facades\Auth;

class DashboardGuruController extends Controller
{
    public function index(Request $request)
    {
        $guruId = Auth::user()->guru->id ?? null;
        if (!$guruId) {
            return abort(403, 'Guru tidak ditemukan.');
        }   

        // Ambil semua periode untuk dropdown
        $periodes = Periode::orderBy('tahun_awal', 'asc')->get();

        // Gunakan session periode aktif
        $selectedPeriode = session('periode_aktif_guru');

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
    }

    public function updatePeriode(Request $request)
    {
        if ($request->has('periode_id')) {
            session(['periode_aktif_guru' => $request->periode_id]);
            
            // Return response untuk AJAX
            $selectedPeriodeNama = Periode::find($request->periode_id)?->tahun_ajaran ?? 'Pilih Periode';
            
            return response()->json([
                'success' => true,
                'message' => 'Periode berhasil diupdate',
                'periode_nama' => $selectedPeriodeNama
            ]);
        }
        
        return response()->json(['success' => false, 'message' => 'Periode ID tidak ditemukan']);
    }
}
