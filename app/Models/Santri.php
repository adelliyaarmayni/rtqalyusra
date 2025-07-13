<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;
    protected $table = 'santri';

    protected $fillable = [
        'nis',
        'nama_santri',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'GolDar',
        'MK',
        'email',
        'NoHP_ortu',
        'asal_sekolah',
        'pekerjaan_ortu',
        'nama_ortu',
        'kat_masuk',
        'asal',
        'kelas',
        'periode_id',
        'jenis_kelas',
        'cabang'
    ];

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
}
