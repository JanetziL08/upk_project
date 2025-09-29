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
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->bigIncrements('id_pendaftaran'); // Primary key
            $table->unsignedBigInteger('id_pasien'); // Foreign key ke pasien
            $table->date('tanggal');                 // Tanggal pendaftaran
            $table->time('waktu');                   // Waktu pendaftaran
            $table->text('keterangan')->nullable();  // Keterangan (opsional)
            $table->enum('status', [
                'TERKONFIRMASI',
                'MENUNGGU KONFIRMASI',
                'TIDAK TERKONFIRMASI'
            ])->default('MENUNGGU KONFIRMASI');      // Default status
            $table->timestamps();

            // Relasi
            $table->foreign('id_pasien')->references('id_pasien')->on('pasien')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
