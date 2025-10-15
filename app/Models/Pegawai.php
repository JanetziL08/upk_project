<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    // 
    protected $table = 'pegawai';
    protected $primaryKey = 'id_pasien';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_pasien',
        'npp_pgw',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'npp_pgw', 'id_ref');
    }

}
