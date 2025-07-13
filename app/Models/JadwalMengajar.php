<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalMengajar extends Model
{
    protected $table = 'jadwal_mengajar';

    protected $fillable = [
        'guru_id',
        'kelas',
        'cabang',
        'kegiatan',
        'periode_id',
        'jam_masuk',
        'jam_keluar'
    ];

    public function guru(): BelongsTo
    {
        return $this->belongsTo(Guru::class);
    }

    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class);
    }

    public function getTahunAjaranAttribute()
    {
        return $this->periode->tahun_ajaran ?? '-';
    }

    public function dokumentasi()
    {
        return $this->hasMany(Dokumentasi::class, 'jadwal_mengajar_id', 'id'); // Sesuaikan nama model dan FK
    }
}
