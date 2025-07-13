<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class DetailKehadiran extends Model
{
    protected $table = 'detail_kehadiran';

    protected $fillable = [
        'namasantri_id',
        'jadwal_mengajar_id',
        'tanggal',
        'status_kehadiran',
        'bukti',
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class, 'namasantri_id');
    }

    public function jadwal()
    {
        return $this->belongsTo(JadwalMengajar::class, 'jadwal_mengajar_id');
    }
}
