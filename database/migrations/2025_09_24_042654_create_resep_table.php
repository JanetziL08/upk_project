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
        Schema::create('resep', function (Blueprint $table) {
            $table->bigIncrements('id_resep'); // primary key
            $table->unsignedBigInteger('id_pemeriksaan');
            $table->unsignedBigInteger('id_dokter');
            $table->timestamps();

            // foreign key
            $table->foreign('id_pemeriksaan')->references('id_pemeriksaan')->on('pemeriksaan')->onDelete('cascade');
            $table->foreign('id_dokter')->references('id_dokter')->on('dokter')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resep');
    }
};
