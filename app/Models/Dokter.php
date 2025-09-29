<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    //
    protected $table = 'dokter';
    protected $primaryKey = 'id_dokter';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'id_dokter',
        'nama',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_dokter', 'username');
    }

}
