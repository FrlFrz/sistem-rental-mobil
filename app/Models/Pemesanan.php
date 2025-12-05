<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UnitMobil;

class Pemesanan extends Model
{
    use HasFactory;
    protected $table = 'pemesanan';

    protected $fillable = [
        'id_unit_mobil',
        'user_id',
        'nama_penyewa',
        'nik_penyewa',
        'telepon_penyewa',
        'alamat_penyewa',
        'jaminan_penyewa',
        'foto_ktp_sim',
        'tgl_mulai',
        'durasi_rental',
        'tgl_selesai',
        'total_biaya',
        'verification_token',
        'status_pemesanan',
        'diserahkan_oleh',
        'tgl_verifikasi'
    ];

    public function unitMobil()
    {
        return $this->belongsTo(UnitMobil::class, 'id_unit_mobil');
    }
}
