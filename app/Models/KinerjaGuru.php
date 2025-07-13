<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KinerjaGuru extends Model
{
    protected $table = 'kinerja_guru';

    protected $fillable = [
        'nama_guru', 'periode_id', 'jumlahTelat'
    ];
}