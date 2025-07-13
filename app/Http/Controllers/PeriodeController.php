<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index()
    {
        $periode = Periode::orderBy('tahun_awal', 'asc')->get();
        return view('admin.periode.index', compact('periode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_awal' => 'required|integer|min:2010|max:2030',
            'tahun_akhir' => 'required|integer|min:2010|max:2030|gte:tahun_awal',
        ]);

        $tahun_ajaran = "{$request->tahun_awal}-{$request->tahun_akhir}";

        // Masukkan tahun_ajaran ke dalam request agar bisa divalidasi
        $request->merge(['tahun_ajaran' => $tahun_ajaran]);

        // Validasi unik tahun_ajaran
        $request->validate([
            'tahun_ajaran' => 'unique:periode,tahun_ajaran',
        ], [
            'tahun_ajaran.unique' => 'Tahun ajaran tersebut sudah ada.'
        ]);

        // Simpan ke database
        Periode::create([
            'tahun_awal' => $request->tahun_awal,
            'tahun_akhir' => $request->tahun_akhir,
            'tahun_ajaran' => $tahun_ajaran,
        ]);

        return redirect()->route('admin.periode.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }
}
