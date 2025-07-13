<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\JadwalMengajar;
use App\Models\Periode;
use App\Models\JadwalKegiatan;
use App\Models\Dokumentasi;
use App\Models\DetailKehadiran;
use App\Models\Santri;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class KehadiranAdminController extends Controller
{
    public function index(Request $request)
    {
        $periodes = Periode::orderBy('tahun_awal', 'desc')->get();
        $cabangs = JadwalMengajar::select('cabang')->distinct()->orderBy('cabang')->pluck('cabang');
        $kelass = JadwalMengajar::select('kelas')->distinct()->orderBy('kelas')->pluck('kelas');
        $namaGurus = Guru::orderBy('nama_guru')->pluck('nama_guru', 'id');
        $kegiatans = JadwalMengajar::select('kegiatan')->distinct()->orderBy('kegiatan')->pluck('kegiatan');

        $initialTanggal = Carbon::now()->toDateString();

        $detailKehadiran = collect();
        $dokumentasiList = collect();

        return view('admin.kehadiranA.index', compact(
            'periodes',
            'cabangs',
            'kelass',
            'namaGurus',
            'kegiatans',
            'initialTanggal',
            'request'
        ));
    }

    public function detail(Request $request)
    {
        $tanggal = $request->input('tanggal');
        if (!$tanggal) {
            return redirect()->route('admin.kehadiran.index')->with('error', 'Tanggal harus diisi.');
        }

        // Ambil kehadiran
        $queryKehadiran = DetailKehadiran::with(['santri', 'jadwal.guru'])
            ->join('jadwal_mengajar', 'detail_kehadiran.jadwal_mengajar_id', '=', 'jadwal_mengajar.id')
            ->when($request->filled('periode_id'), fn($q) => $q->where('jadwal_mengajar.periode_id', $request->periode_id))
            ->when($request->filled('cabang'), fn($q) => $q->where('jadwal_mengajar.cabang', $request->cabang))
            ->when($request->filled('kelas'), fn($q) => $q->where('jadwal_mengajar.kelas', $request->kelas))
            ->when($request->filled('nama_guru'), fn($q) => $q->where('jadwal_mengajar.guru_id', $request->nama_guru))
            ->when($request->filled('kegiatan'), fn($q) => $q->where('jadwal_mengajar.kegiatan', $request->kegiatan))
            ->whereDate('detail_kehadiran.tanggal', $tanggal)
            ->select('detail_kehadiran.*')
            ->paginate(10) // ← PAGINATION
            ->appends($request->query()); // ← untuk tetap bawa query string (filters)

        // Ambil dokumentasi
        $queryDokumentasi = Dokumentasi::join('jadwal_mengajar', 'dokumentasis.jadwal_mengajar_id', '=', 'jadwal_mengajar.id')
            ->when($request->filled('periode_id'), fn($q) => $q->where('jadwal_mengajar.periode_id', $request->periode_id))
            ->when($request->filled('cabang'), fn($q) => $q->where('jadwal_mengajar.cabang', $request->cabang))
            ->when($request->filled('kelas'), fn($q) => $q->where('jadwal_mengajar.kelas', $request->kelas))
            ->when($request->filled('nama_guru'), fn($q) => $q->where('jadwal_mengajar.guru_id', $request->nama_guru))
            ->when($request->filled('kegiatan'), fn($q) => $q->where('jadwal_mengajar.kegiatan', $request->kegiatan))
            ->whereDate('dokumentasis.tanggal', $tanggal)
            ->select('dokumentasis.*')
            ->get();

        // Tambah URL untuk dokumentasi
        $queryDokumentasi->map(function ($doc) {
            $doc->dokumentasi_url = Storage::disk('public')->exists($doc->dokumentasi)
                ? Storage::url($doc->dokumentasi) : null;
            return $doc;
        });

        $periode = null;
        if ($request->filled('periode_id')) {
            $periode = Periode::find($request->periode_id);
        }

        return view('admin.kehadiranA.detail', [
            'tanggal' => $tanggal,
            'dataKehadiran' => $queryKehadiran,
            'dokumentasi' => $queryDokumentasi,
            'periode' => $periode,
        ]);
    }

    public function getKehadiranData(Request $request)
    {
        try {
            $query = DetailKehadiran::with(['santri', 'jadwal'])
                ->select(
                    'detail_kehadiran.id',
                    'detail_kehadiran.tanggal',
                    'detail_kehadiran.status_kehadiran',
                    'detail_kehadiran.bukti',
                    'santri.nama_santri',
                    'santri.kelas as santri_kelas',
                    'jadwal_mengajar.cabang',
                    'jadwal_mengajar.kelas',
                    'guru.nama_guru',
                    'jadwal_mengajar.kegiatan',
                    'jadwal_mengajar.jam_masuk',
                    'jadwal_mengajar.jam_keluar'
                )
                ->join('santri', 'detail_kehadiran.namasantri_id', '=', 'santri.id')
                ->join('jadwal_mengajar', 'detail_kehadiran.jadwal_mengajar_id', '=', 'jadwal_mengajar.id')
                ->join('guru as guru', 'jadwal_mengajar.guru_id', '=', 'guru.id');

            if ($request->filled('periode_id')) {
                $query->where('jadwal_mengajar.periode_id', $request->input('periode_id'));
            }
            if ($request->filled('tanggal')) {
                $parseDate = Carbon::parse($request->input('tanggal'))->toDateString();
                $query->whereDate('detail_kehadiran.tanggal', $parseDate);
            }
            if ($request->filled('cabang')) {
                $query->where('jadwal_mengajar.cabang', $request->input('cabang'));
            }
            if ($request->filled('kelas')) {
                $query->where('jadwal_mengajar.kelas', $request->input('kelas'));
            }
            if ($request->filled('nama_guru') && $request->input('nama_guru') !== 'all') {
                $query->where('jadwal_mengajar.guru_id', $request->input('nama_guru'));
            }
            if ($request->filled('kegiatan')) {
                $query->where('jadwal_mengajar.kegiatan', $request->input('kegiatan'));
            }
            if ($request->filled('status_kehadiran')) {
                $query->where('detail_kehadiran.status_kehadiran', $request->input('status_kehadiran'));
            }

            $kehadiran = $query->orderBy('detail_kehadiran.tanggal', 'desc')
                ->orderBy('jadwal_mengajar.jam_masuk', 'asc')
                ->orderBy('santri.nama_santri', 'asc')
                ->paginate(20, ['*'], 'kehadiran_page');

            $kehadiran->getCollection()->transform(function ($item) {
                $item->bukti_url = ($item->bukti && Storage::disk('public')->exists($item->bukti))
                    ? Storage::url($item->bukti) : null;
                unset($item->santri, $item->jadwal);
                return $item;
            });

            return response()->json($kehadiran);
        } catch (\Exception $e) {
            Log::error("Error fetching admin attendance data: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine());
            return response()->json(['error' => 'Gagal memuat data kehadiran. Silakan coba lagi.'], 500);
        }
    }

    public function getDokumentasiData(Request $request)
    {
        try {
            $query = Dokumentasi::with('jadwalKegiatan')
                ->select(
                    'dokumentasis.id',
                    'dokumentasis.tanggal',
                    'dokumentasis.dokumentasi',
                    'jadwal_mengajar.cabang',
                    'jadwal_mengajar.kelas',
                    'guru.nama_guru',
                    'jadwal_mengajar.kegiatan',
                    'jadwal_mengajar.jam_masuk',
                    'jadwal_mengajar.jam_keluar'
                )
                ->join('jadwal_mengajar', 'dokumentasis.jadwal_mengajar_id', '=', 'jadwal_mengajar.id')
                ->join('guru as guru', 'jadwal_mengajar.guru_id', '=', 'guru.id');

            if ($request->filled('periode_id')) {
                $query->where('jadwal_mengajar.periode_id', $request->input('periode_id'));
            }
            if ($request->filled('tanggal')) {
                $parseDate = Carbon::parse($request->input('tanggal'))->toDateString();
                $query->whereDate('dokumentasi.tanggal', $parseDate);
            }
            if ($request->filled('cabang')) {
                $query->where('jadwal_mengajar.cabang', $request->input('cabang'));
            }
            if ($request->filled('kelas')) {
                $query->where('jadwal_mengajar.kelas', $request->input('kelas'));
            }
            if ($request->filled('nama_guru') && $request->input('nama_guru') !== 'all') {
                $query->where('jadwal_mengajar.guru_id', $request->input('nama_guru'));
            }
            if ($request->filled('kegiatan')) {
                $query->where('jadwal_mengajar.kegiatan', $request->input('kegiatan'));
            }

            $dokumentasi = $query->orderBy('dokumentasis.tanggal', 'desc')
                ->orderBy('jadwal_mengajar.jam_masuk', 'asc')
                ->paginate(20, ['*'], 'dokumentasi_page');

            $dokumentasi->getCollection()->transform(function ($item) {
                $item->dokumentasi_url = ($item->dokumentasi && Storage::disk('public')->exists($item->dokumentasi))
                    ? Storage::url($item->dokumentasi) : null;
                unset($item->jadwalKegiatan);
                return $item;
            });

            return response()->json($dokumentasi);
        } catch (\Exception $e) {
            Log::error("Error fetching admin documentation data: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine());
            return response()->json(['error' => 'Gagal memuat data dokumentasi. Silakan coba lagi.'], 500);
        }
    }
}
