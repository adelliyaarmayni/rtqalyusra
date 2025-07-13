<?php

namespace App\Http\Controllers;
use App\Models\Pengguna;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

class PenggunaController extends Controller
{

    public function index()
    {
        // $users = User::all();
        $users = User::with('roles')->get();
        return view('admin.kelolapengguna.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.kelolapengguna.tambah', compact('roles'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            // dd('hi');
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed',
                'is_active' => 'sometimes|boolean',
                'role' => 'required|exists:roles,name'
            ]);
            // dd($request->all());

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'is_active' => $request->is_active
            ]);
            $user->assignRole($validated['role']); 
            DB::commit();

            return redirect()->route('admin.kelolapengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
        } catch (ValidationException $exception) {
            DB::rollBack();
            return redirect()->back()
                ->withErrors($exception->validator)
                ->withInput();
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $exception->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $pengguna = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.kelolapengguna.edit', compact('pengguna', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $pengguna = User::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'is_active' => 'sometimes|boolean',
            'role' => 'sometimes|exists:roles,name'
        ]);

        $pengguna->name = $request->name;
        $pengguna->email = $request->email;
        $pengguna->is_active = $request->is_active;

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6|confirmed']);
            $pengguna->password = bcrypt($request->password);
        }

        $pengguna->save();
        $pengguna->syncRoles([$request->role]);

        return redirect()->route('admin.kelolapengguna.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }
}
