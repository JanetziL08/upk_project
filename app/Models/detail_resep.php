<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailResep extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_detail';
    public $incrementing = false; // varchar
    protected $keyType = 'string';

    protected $fillable = [
        'id_detail',
        'id_resep',
        'id_obat',
        'aturan_pakai',
    ];

    // Relasi ke resep
    public function resep()
    {
        return $this->belongsTo(Resep::class, 'id_resep');
    }

    // Relasi ke obat
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}

