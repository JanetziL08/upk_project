<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'pendaftaran';
    protected $primaryKey = 'id_pendaftaran';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_pendaftaran',
        'id_pasien',
        'tanggal',
        'waktu',
        'keterangan',
        'status'
    ];
    public $timestamps = false;

    // Relasi ke pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }

    // Relasi ke jadwal dokter
    public function jadwalDokter()
    {
        return $this->belongsTo(JadwalDokter::class, 'id_jadwal', 'id_jadwal');
    }

}
