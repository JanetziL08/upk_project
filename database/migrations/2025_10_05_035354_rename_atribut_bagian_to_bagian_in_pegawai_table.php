<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->renameColumn('atribut_bagian', 'bagian');
        });
    }

    public function down(): void
    {
        Schema::table('pegawai', function (Blueprint $table) {
            $table->renameColumn('bagian', 'atribut_bagian');
        });
    }
};
