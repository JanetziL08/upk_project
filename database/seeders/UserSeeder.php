<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'ADMIN001',
            'role' => 'administrator',
            'id_ref' => 'NPP_ADMIN_001',
        ]);

        User::create([
            'username' => 'DOK001',
            'role' => 'dokter',
            'id_ref' => 'ID_DOKTER_001',
        ]);

        User::create([
            'username' => 'MHS001',
            'role' => 'pasien',
            'id_ref' => 'ID_PASIEN_001',
        ]);
    }
}
