<?php

namespace App\Http\Controllers;

use App\Models\JadwalMengajar;
use App\Models\Guru;
use App\Models\Periode;
use Illuminate\Http\Request;

class JadwalMengajarController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10); // default 10

        $query = JadwalMengajar::with(['guru', 'periode']);

        if ($search) {
            $query->whereHas('guru', function ($q) use ($search) {
                $q->where('nama_guru', 'like', '%' . $search . '%');
            })->orWhere('kelas', 'like', '%' . $search . '%')
                ->orWhere('cabang', 'like', '%' . $search . '%')
                ->orWhere('kegiatan', 'like', '%' . $search . '%');
        }

        $jadwals = $query->paginate($perPage)->appends([
            'search' => $search,
            'per_page' => $perPage,
        ]);

        $periodes = Periode::orderBy('tahun_awal')->get();

        return view('admin.jadwalmengajar.index', compact('jadwals', 'periodes', 'search', 'perPage'));
    }


    public function create()
    {
        $gurus = Guru::all();
        $periodes = Periode::all();
        return view('admin.jadwalmengajar.tambah', compact('gurus', 'periodes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'guru_id' => 'required|exists:guru,id',
            'kelas' => 'required|string|max:50',
            'cabang' => 'required|string|max:100',
            'kegiatan' => 'required|string|max:100',
            'periode_id' => 'required|exists:periode,id',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'required|date_format:H:i|after_or_equal:jam_masuk',
        ]);

        JadwalMengajar::create($request->all());

        return redirect()->route('admin.jadwalmengajar.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jadwal = JadwalMengajar::findOrFail($id);
        $gurus = Guru::all();
        $periodes = Periode::orderBy('tahun_awal')->get();
        return view('admin.jadwalmengajar.edit', compact('jadwal', 'gurus', 'periodes'));
    }

    public function update(Request $request, $id)
    {
        logger('UPDATE JADWAL MENGAJAR DIPANGGIL', $request->all());

        $request->validate([
            'guru_id' => 'required|exists:guru,id',
            'kelas' => 'required|string|max:50',
            'cabang' => 'required|string|max:100',
            'kegiatan' => 'required|string|max:100',
            'periode_id' => 'required|exists:periode,id',
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'required|date_format:H:i|after_or_equal:jam_masuk',
        ]);

        $jadwal = JadwalMengajar::findOrFail($id);
        $jadwal->update($request->all());

        return redirect()->route('admin.jadwalmengajar.index')->with('success', 'Jadwal berhasil diupdate');
    }

    public function destroy($id)
    {
        JadwalMengajar::destroy($id);
        return redirect()->route('admin.jadwalmengajar.index')->with('success', 'Jadwal berhasil dihapus');
    }
}
