<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    protected $primaryKey = 'id_pasien';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pasien',
        'nama',
        'tanggal',
        'alamat',
        'no_telp',
        'tipe_pasien'
    ];
    public $timestamps = false;

    // Relasi ke pendaftaran
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'id_pasien', 'id_pasien');
    }
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'id_pasien', 'id_pasien');
    }

    public function pegawai()
    {
        return $this->hasOne(Pegawai::class, 'id_pasien', 'id_pasien');
    }

    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'id_pasien', 'id_pasien');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_pasien', 'id_ref');
    }

}
