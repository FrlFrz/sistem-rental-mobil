<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JenisMobil;

class UnitMobil extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_unit_mobil';

    protected $fillable = [
        'id_jenis_mobil',
        'plat_nomor',
        'warna',
        'status_mobil',
    ];

    public function jenis_mobil() {
        return $this->belongsTo(JenisMobil::class, 'id_jenis_mobil');
    }
}
