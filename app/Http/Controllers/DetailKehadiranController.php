<?php

namespace App\Http\Controllers;

use App\Models\DetailKehadiran;
use App\Models\Dokumentasi;
use App\Models\Guru;
use App\Models\JadwalMengajar;
use App\Models\Santri;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DetailKehadiranController extends Controller
{
    public function detail($kelas)
    {
        $selectedPeriode = request()->query('periode_id');

        $user = Auth::user();
        $guru = $user->guru;

        // Ambil jadwal yang sesuai kelas, guru, dan periode
        $jadwal = JadwalMengajar::where('guru_id', $guru->id)
            ->where('kelas', $kelas)
            ->when($selectedPeriode, fn($q) => $q->where('periode_id', $selectedPeriode))
            ->first();

        if (!$jadwal) {
            return redirect()->back()->with('error', 'Jadwal tidak ditemukan di periode ini.');
        }

        $santri = Santri::where('kelas', $kelas)
            ->where('periode_id', $selectedPeriode)
            ->get();

        $detail_kehadiran = DetailKehadiran::with('santri', 'jadwal')
            ->where('jadwal_mengajar_id', $jadwal->id)
            ->get();

        $listKegiatan = JadwalMengajar::where('kelas', $kelas)
            ->where('guru_id', $guru->id)
            ->whereNotNull('kegiatan')
            ->when($selectedPeriode, fn($q) => $q->where('periode_id', $selectedPeriode))
            ->distinct()
            ->pluck('kegiatan');

        return view('guru.detailKehadiran.detail', compact(
            'detail_kehadiran',
            'santri',
            'kelas',
            'listKegiatan',
            'selectedPeriode'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'kelas' => 'required|string',
            'guru_id' => 'required|exists:guru,id',
            'periode_id' => 'required',
            'kegiatan' => 'required|string',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required',
            'dokumentasi' => 'nullable|image|mimes:jpg,png,jpeg, jfif|max:2048',
            'jadwal_mengajar_id' => 'required|exists:jadwal_mengajar,id',
        ]);

        // foreach ($request->kehadiran as $id => $data) {
        //     if (!isset($data['bukti'])) {
        //         return back()->withErrors(["kehadiran.$id.bukti" => "Bukti untuk santri {$data['nama_santri']} wajib diunggah."])->withInput();
        //     }
        // }

        if (!$request->hasFile('dokumentasi')) {
            return back()->withErrors(['dokumentasi' => 'Dokumentasi kegiatan wajib diunggah.'])->withInput();
        }

        // Upload dokumentasi kegiatan
        if ($request->hasFile('dokumentasi')) {
            $dokumenPath = $request->file('dokumentasi')->store('dokumentasi_kegiatan', 'public');

            // Hitung keterlambatan
            $waktuSubmit = Carbon::now(); // waktu submit saat ini dengan timezone Asia/Jakarta
            $batasAbsen = Carbon::createFromFormat('H:i:s', $request->jam_masuk,)->addMinutes(15); // batas absen (jam_masuk + 15 menit)
            $statusTerlambat = $waktuSubmit->gt($batasAbsen) ? 'Terlambat' : 'Tepat Waktu';

            Dokumentasi::create([
                'dokumentasi' => $dokumenPath ?? '-',
                'jadwal_mengajar_id' => $request->jadwal_mengajar_id,
                'tanggal' => $request->tanggal,
                'waktu_submit' => $waktuSubmit->format('H:i:s'),
                'batas_absen' => $batasAbsen->format('H:i:s'),
                'status_terlambat' => $statusTerlambat,
            ]);
        }

        // Simpan data kehadiran per santri
        foreach ($request->kehadiran as $data) {
            $buktiPath = null;
            if (isset($data['bukti']) && $data['bukti']) {
                $buktiPath = $data['bukti']->store('bukti_kehadiran', 'public');
            }

            DetailKehadiran::create([
                'namasantri_id' => $data['santri_id'],
                'jadwal_mengajar_id' => $request->jadwal_mengajar_id,
                'tanggal' => $request->tanggal,
                'status_kehadiran' => $data['status_kehadiran'],
                'bukti' => $buktiPath,
            ]);
        }

        return redirect()->route('guru.detailKehadiran.detail', [
            'kelas' => $request->kelas,
            'periode_id' => $request->periode_id,
            'tanggal' => $request->tanggal,
        ])->with('success', 'Kehadiran dan dokumentasi berhasil disimpan.');
    }

    public function getKehadiran($kelas, $tanggal)
    {
        $user = Auth::user();
        $guru = $user->guru;

        try {
            $parseDate = Carbon::parse($tanggal)->toDateString();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Format tanggal tidak valid.'], 400);
        }

        $periodeId = request()->query('periode_id');
        $kegiatan = request()->query('kegiatan');

        $query = JadwalMengajar::where('guru_id', $guru->id)
            ->where('kelas', $kelas)
            ->where('periode_id', $periodeId);

        if (!empty($kegiatan)) {
            $query->where('kegiatan', $kegiatan);
        }

        $jadwal = $query->first();

        if (!$jadwal) {
            return response()->json([]);
        }

        $kehadiran = DetailKehadiran::where('jadwal_mengajar_id', $jadwal->id)
            ->whereDate('tanggal', $parseDate)
            ->with(['santri' => function ($query) use ($kelas, $periodeId) {
                $query->where('kelas', $kelas)
                    ->where('periode_id', $periodeId);
            }])
            ->get();

        return response()->json($kehadiran);
    }


    public function getDokumentasi($tanggal)
    {
        try {
            $parseDate = Carbon::parse($tanggal)->toDateString();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Format tanggal tidak valid.'], 400);
        }

        $periodeId = request()->query('periode_id');
        $kegiatan = request()->query('kegiatan');

        Log::info('Filter Dokumentasi', [
            'tanggal' => $parseDate,
            'periode_id' => $periodeId,
            'kegiatan' => $kegiatan,
        ]);

        $query = Dokumentasi::whereDate('tanggal', $parseDate);

        if ($kegiatan || $periodeId) {
            $query->whereHas('jadwal', function ($q) use ($kegiatan, $periodeId) {
                if ($kegiatan) {
                    $q->where('kegiatan', $kegiatan);
                }
                if ($periodeId) {
                    $q->where('periode_id', $periodeId);
                }
            });
        }

        $dokumentasi = $query->get();

        $dokumentasiUrl = [];
        foreach ($dokumentasi as $record) {
            if (Storage::disk('public')->exists($record->dokumentasi)) {
                $dokumentasiUrl[] = Storage::url($record->dokumentasi);
            }
        }

        return response()->json(['success' => true, 'dokumentasi' => $dokumentasiUrl]);
    }
}
