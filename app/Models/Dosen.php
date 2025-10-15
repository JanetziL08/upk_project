<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pasien;
use App\Models\User; 

class Dosen extends Model
{
 protected $table = 'dosen';
    protected $primaryKey = 'npp_dsn'; // kalau memang PK nya npp_dsn
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'npp_dsn',
        'prodi_dsn',
        'id_pasien',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien', 'id_pasien');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'npp_dsn', 'id_ref');
    }
}
