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
        Schema::create('unit_mobils', function (Blueprint $table) {
            $table->id('id_unit_mobil');
            $table->foreignId('id_jenis_mobil');
            $table->string('plat_nomor', 50)->unique();
            $table->string('warna');
            $table->enum('status_mobil', ['tersedia', 'dipesan', 'dirental', 'perawatan'])->default('tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_mobils');
    }
};
