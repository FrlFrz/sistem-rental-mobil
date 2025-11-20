<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jenis_mobils', function (Blueprint $table) {
            $table->id('id_jenis_mobil');
            $table->string('merek');
            $table->year('tahun');
            $table->integer('kapasitas');
            $table->string('foto_mobil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_mobils');
    }
};
