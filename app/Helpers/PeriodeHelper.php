<?php

namespace App\Helpers;

use App\Models\Periode;
use Illuminate\Support\Facades\Session;

class PeriodeHelper
{
    public static function setTahunAjaran($tahunAjaran)
    {
        Session::put('selected_tahun_ajaran', $tahunAjaran);
    }

    public static function getTahunAjaran()
    {
        return Session::get('selected_tahun_ajaran') ?? Periode::orderByDesc('tahun_awal')->first()?->tahun_ajaran;
    }

    public static function getPeriode()
    {
        return Periode::where('tahun_ajaran', self::getTahunAjaran())->first();
    }
}
