<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pegawai', function (Blueprint $table) {
            // Tambahkan kolom baru 'bagian'
            $table->string('bagian')->nullable()->after('npp_pgw');
            // sesuaikan posisi 'after' dengan kolom yang sudah ada, misalnya setelah kolom 'nama'
        });
    }

    public function down(): void
    {
        Schema::table('pegawai', function (Blueprint $table) {
            // Hapus kolom 'bagian' jika migrasi dibatalkan
            $table->dropColumn('bagian');
        });
    }
};

