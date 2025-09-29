<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->bigIncrements('id_pasien');     // Primary key
            $table->string('nama');                 // Nama pasien
            $table->date('tanggal_lahir');          // Tanggal lahir
            $table->text('alamat');                 // Alamat
            $table->string('no_telp', 20)->nullable(); // Nomor telepon (boleh null)
            $table->string('tipe_pasien');          // Tipe pasien (Umum/BPJS/Asuransi)
            $table->timestamps();                   // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
