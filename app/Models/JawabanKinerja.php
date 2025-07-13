<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanKinerja extends Model
{
    protected $table = 'jawaban_kinerjas';

    protected $fillable = [
        'kinerja_id', 'kategori_id', 'jawaban'
    ];
}
