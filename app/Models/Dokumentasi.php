<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    protected $table = 'dokumentasis';

    protected $fillable = [
        'dokumentasi',
        'jadwal_mengajar_id',
        'tanggal',
        'waktu_submit',
        'batas_absen',
        'status_terlambat',
    ];

    public function jadwal()
    {
        return $this->belongsTo(JadwalMengajar::class, 'jadwal_mengajar_id');
    }
}
