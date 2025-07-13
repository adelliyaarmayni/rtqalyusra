<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $table = 'kehadiran';

    protected $fillable = [
        'nama_guru', 'kelas', 'cabang', 'kegiatan_santri', 'hari_tanggal',
        'waktu', 'periode_id', 'waktu_submit', 'batas_absen', 'status_terlambat'
    ];
}