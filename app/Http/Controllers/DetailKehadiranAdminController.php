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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class DetailKehadiranAdminController extends Controller
{
    public function detail($kelas)
    {
        $detail_kehadiran = DetailKehadiran::with('santri')
            ->whereHas('santri', function ($query) use ($kelas) {
                $query->where('kelas', $kelas);
            })
            ->get();

        $santri = Santri::where('kelas', $kelas)->get();

        return view('admin.detailKehadiran.detail', compact('detail_kehadiran', 'santri', 'kelas'));
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

        // Upload dokumentasi kegiatan
        if ($request->hasFile('dokumentasi')) {
            $dokumenPath = $request->file('dokumentasi')->store('dokumentasi_kegiatan', 'public');

            // Hitung keterlambatan
            $waktuSubmit = Carbon::now(); // waktu submit saat ini dengan timezone Asia/Jakarta
            $batasAbsen = Carbon::createFromFormat('H:i:s', $request->jam_masuk, )->addMinutes(15); // batas absen (jam_masuk + 15 menit)
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

        return redirect()->route('guru.detailKehadiran.detail', ['kelas' => $request->kelas])
            ->with('success', 'Kehadiran dan dokumentasi berhasil disimpan.');
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

        $jadwal = JadwalMengajar::where('guru_id', $guru->id)
            ->where('kelas', $kelas)
            ->first();

        $kehadiran = DetailKehadiran::where('jadwal_mengajar_id', $jadwal->id)
            ->whereDate('tanggal', $parseDate)
            ->with('santri')
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

        $dokumentasi = Dokumentasi::whereDate('tanggal', $parseDate)
            ->get();

        $dokumentasiUrl = [];
        foreach ($dokumentasi as $record) {
            if (Storage::disk('public')->exists($record->dokumentasi)) {
                $dokumentasiUrl[] = Storage::url($record->dokumentasi);
            } else {
                Log::warning("Dokumentasi file not found for path: " . $record->dokumentasi);
            }
        }

        return response()->json(['success' => true, 'dokumentasi' => $dokumentasiUrl]);
    }
}