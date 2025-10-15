<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    //
    protected $table = 'administrator';
    protected $primaryKey = 'npp';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'npp',
        'nama',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'npp', 'id_ref');
    }

}
