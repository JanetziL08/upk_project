<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model{
    use HasFactory;

    protected $table = 'pemeriksaan';
    protected $primaryKey = 'id_pemeriksaan';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'id_pasien',
        'id_dokter',
        'npp',
        'tanggal',
        'anamnesa',
        'diagnosa',
        'terapi',
    ];

    public funcion pasien(){
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }

    public function dokter(){
        return $this->belongsTo(Dokter::class, 'id_dokter','id_dokter');
    }

    public function administrator(){
        return $this->belongsTo(Administrator::class,'npp','npp');
    }

    public function resep(){
        return $this->hasMany(Resep::class,'id_pemeriksaan', 'id_pemeriksaan');
    }

}
