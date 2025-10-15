<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("
            ALTER TABLE pendaftaran 
            MODIFY status ENUM('TERKONFIRMASI', 'MENUNGGU KONFIRMASI', 'TIDAK TERKONFIRMASI') 
            NOT NULL 
            DEFAULT 'MENUNGGU KONFIRMASI'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE pendaftaran 
            MODIFY status ENUM('TERKONFIRMASI', 'TIDAK TERKONFIRMASI') 
            NOT NULL 
            DEFAULT 'TIDAK TERKONFIRMASI'
        ");
    }
};
