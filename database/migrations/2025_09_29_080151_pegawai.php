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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->bigIncrements('id_pegawai'); // primary key
            $table->unsignedBigInteger('id_pasien'); // foreign key
            $table->string('npp_pgw')->unique(); // nomor pokok pegawai unik
            $table->string('atribut_bagian'); // bagian/departemen
            $table->timestamps();

            // Relasi ke tabel pasien
            $table->foreign('id_pasien')->references('id_pasien')->on('pasien')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
