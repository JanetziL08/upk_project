<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    //
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_pasien';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_pasien',
        'nim',
        'prodi',
    ];

    // Relasi ke Pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }

    // Relasi ke User (jika pakai tabel user)
    public function user()
    {
        return $this->belongsTo(User::class, 'nim', 'id_ref');
    }
}
