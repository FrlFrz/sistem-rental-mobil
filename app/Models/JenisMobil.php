<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UnitMobil;

class JenisMobil extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jenis_mobil';

    protected $fillable = [
        'merek',
        'tahun',
        'harga_rental_per_hari',
        'kapasitas',
        'transmisi',
        'foto_mobil',
    ];

    public function unit_mobils() {
        return $this->hasMany(UnitMobil::class, 'id_jenis_mobil');
    }
}
