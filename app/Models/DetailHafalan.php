<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailHafalan extends Model
{
    protected $table = 'detail_hafalans';

    protected $fillable = [
        'santri_id', 'jadwal_mengajar_id', 'juz',
        'surah', 'ayat_awal', 'ayat_akhir', 'tanggal'
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'santri_id');
    }

    public function jadwal()
    {
        return $this->belongsTo(JadwalMengajar::class, 'jadwal_mengajar_id');
    }
}
