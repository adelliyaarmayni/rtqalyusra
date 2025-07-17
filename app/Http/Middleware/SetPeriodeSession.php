<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Periode;

class SetPeriodeSession
{
    public function handle(Request $request, Closure $next)
    {
        // Jika ada parameter periode_id di request, simpan ke session
        if ($request->has('periode_id') && !empty($request->periode_id)) {
            session(['periode_aktif_guru' => $request->periode_id]);
        }
        
        // Jika belum ada session periode, set dengan periode terbaru
        if (!session()->has('periode_aktif_guru')) {
            $latestPeriode = Periode::orderBy('tahun_awal', 'desc')->first();
            if ($latestPeriode) {
                session(['periode_aktif_guru' => $latestPeriode->id]);
            }
        }

        return $next($request);
    }
}
