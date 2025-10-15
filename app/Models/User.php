<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'user';          // tabel user
    protected $primaryKey = 'id_user';  // primary key
    public $timestamps = true;          // karena tabel user ada timestamps

    protected $fillable = [
        'username',
        'password',
        'role',
        'id_ref'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relasi ke Mahasiswa
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'nim', 'id_ref');
    }

    // Relasi ke Pegawai
    public function pegawai()
    {
        return $this->hasOne(Pegawai::class, 'npp_pgw', 'id_ref');
    }

    // Relasi ke Dosen
    public function dosen()
    {
        return $this->hasOne(Dosen::class, 'npp_dsn', 'id_ref');
    }

    // Relasi ke Administrator
    public function administrator()
    {
        return $this->hasOne(Administrator::class, 'npp', 'id_ref');
    }

    // Relasi ke Dokter
    public function dokter()
    {
        return $this->hasOne(Dokter::class, 'id_dokter', 'id_ref');
    }
    public function identity()
    {
        switch ($this->role) {
            case 'dokter':
                return $this->dokter;
            case 'administrator':
                return $this->administrator;
            case 'pasien':
                // pasien bisa mahasiswa / pegawai / dosen
                return $this->mahasiswa ?? $this->pegawai ?? $this->dosen;
        }
    }
    protected static function boot()
    {
        parent::boot();

        // Set password otomatis jika kosong
        static::creating(function ($user) {
            if (empty($user->password)) {
                $user->password = bcrypt($user->username);
            }

            // tandai belum ubah password
            $user->password_changed = false;
        });
    }

}
