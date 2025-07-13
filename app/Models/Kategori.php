<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $fillable = ['kategori'];

    public function pertanyaanKinerja()
    {
        return $this->hasMany(Kategori::class, 'kategori_id', 'id'); // Sesuaikan nama model dan FK
    }
}