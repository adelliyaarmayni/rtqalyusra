<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'guru';

    protected $fillable = [
        'user_id',
        'nama_guru',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'pend_akhir',
        'gol_dar',
        'mk',
        'bagian',
        'cabang',
        'alamat',
        'no_hp',
        'email',
        'status_menikah',
        'jlh_hafalan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jadwalMengajar()
    {
        return $this->hasMany(JadwalMengajar::class, 'guru_id', 'id'); // Sesuaikan foreign key jika perlu
    }
}