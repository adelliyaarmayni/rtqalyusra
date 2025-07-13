<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\Santri;
use Illuminate\Http\Request;

class SantriController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('perPage', 10);

        $query = Santri::with('periode');

        if ($search) {
            $query->where('nama_santri', 'like', "%$search%")
                ->orWhere('tempat_lahir', 'like', "%$search%")
                ->orWhere('tanggal_lahir', 'like', "%$search%")
                ->orWhere('asal', 'like', "%$search%")
                ->orWhere('kelas', 'like', "%$search%")
                ->orWhere('jenis_kelas', 'like', "%$search%")
                ->orWhere('cabang', 'like', "%$search%");
        }

        $santris = $query->latest()->paginate($perPage)->withQueryString();

        return view('admin.datasantri.index', compact('santris', 'search', 'perPage'));
    }


    public function create()
    {
        $periodes = Periode::all();
        return view('admin.datasantri.tambah', compact('periodes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nis' => 'required|string|max:255',
            'nama_santri' => 'required|string|max:255|unique:santri',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'GolDar' => 'required|string|max:2',
            'MK' => 'required|string|max:2',
            'email' => 'required|email|max:255',
            'NoHP_ortu' => 'required|string|max:20',
            'asal_sekolah' => 'required|string|max:255',
            'pekerjaan_ortu' => 'required|string|max:255',
            'nama_ortu' => 'required|string|max:255',
            'kat_masuk' => 'required|string|max:100',
            'asal' => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
            'jenis_kelas' => 'required|string|max:100',
            'cabang' => 'required|string|max:100',
            'periode_id' => 'required|exists:periode,id',
        ]);

        Santri::create($validatedData);

        return redirect()->route('admin.datasantri.index')->with('success', 'Data santri berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        $santri = Santri::findOrFail($id);
        return view('admin.datasantri.detail', compact('santri'));
    }

    public function edit(string $id)
    {
        $santri = Santri::findOrFail($id);
        $periodes = Periode::all();
        return view('admin.datasantri.edit', compact('santri', 'periodes'));
    }

    public function update(Request $request, string $id)
    {
        $santri = Santri::findOrFail($id);

        $validated = $request->validate([
            'nis' => 'required|string|max:255',
            'nama_santri' => 'required|string|max:255|unique:santri,nama_santri,' . $id,
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'GolDar' => 'required|string|max:2',
            'MK' => 'required|string|max:2',
            'email' => 'required|email|max:255',
            'NoHP_ortu' => 'required|string|max:20',
            'asal_sekolah' => 'required|string|max:255',
            'pekerjaan_ortu' => 'required|string|max:255',
            'nama_ortu' => 'required|string|max:255',
            'kat_masuk' => 'required|string|max:100',
            'asal' => 'required|string|max:255',
            'kelas' => 'required|string|max:100',
            'jenis_kelas' => 'required|string|max:100',
            'cabang' => 'required|string|max:100',
            'periode_id' => 'required|exists:periode,id',
        ]);

        $santri->update($validated);

        return redirect()->route('admin.datasantri.index')->with('success', 'Data santri berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $santri = Santri::findOrFail($id);
        $santri->delete();

        return redirect()->route('admin.datasantri.index')->with('success', 'Data santri berhasil dihapus.');
    }
}
