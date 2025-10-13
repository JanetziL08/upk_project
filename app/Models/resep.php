<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_resep';
    public $incrementing = false; // karena varchar
    protected $keyType = 'string';

    protected $fillable = [
        'id_resep',
        'id_pemeriksaan',
    ];

    // Relasi: satu resep punya banyak detail
    public function detailResep()
    {
        return $this->hasMany(detail_Resep::class, 'id_resep');
    }

    // Relasi ke pemeriksaan
    public function pemeriksaan()
    {
        return $this->belongsTo(pemeriksaan::class, 'id_pemeriksaan');
    }
}
