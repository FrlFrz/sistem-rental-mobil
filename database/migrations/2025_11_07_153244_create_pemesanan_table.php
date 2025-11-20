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
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mobil_id')->constrained('mobil');
            $table->string('nama_penyewa');
            $table->string('nik_penyewa', 11);
            $table->string('telepon_penyewa', 15);
            $table->string('alamat_penyewa', 100);
            $table->enum('jaminan_penyewa', ['paspor', 'stnk', 'bpkb', 'sim']);
            $table->dateTime('tgl_mulai');
            $table->dateTime('tgl_selesai');
            $table->decimal('total_biaya', 10, 2)->default(0);
            $table->uuid('verification_token')->unique();
            $table->enum('status_pemesanan', ['dipesan', 'sedang_dirental', 'selesai', 'dibatalkan'])
                  ->default('dipesan');
            $table->foreignId('diserahkan_oleh')->nullable()->constrained('users');
            $table->timestamp('tgl_verifikasi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};
