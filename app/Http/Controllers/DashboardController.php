<?php

namespace App\Http\Controllers;

use App\Models\DetailHafalan;
use App\Models\DetailKehadiran;
use App\Models\Dokumentasi;
use App\Models\JadwalMengajar;
use App\Models\Periode;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $role = $user->getRoleNames()->first();

        return match ($role) {
            'admin' => redirect()->route('dashboard-admin'),
            'guru' => redirect()->route('dashboard-guru'),
            'yayasan' => redirect()->route('dashboard-yayasan'),
            default => abort(403, 'Role tidak dikenali.'),
        };
    }
}
