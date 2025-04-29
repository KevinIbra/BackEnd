<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdeKerajinan extends Model
{
    use HasFactory;

    protected $table = 'ide_kerajinans';

    protected $fillable = [
        'id_ide',
        'judul',
        'bahan_dibutuhkan',
        'tingkat_kesulitan'
    ];

    public function favorits()
    {
        return $this->hasMany(Favorit::class, 'id_ide', 'id');
    }

    public function barangUnggahan()
    {
        return $this->hasMany(Barang_Unggahan::class, 'id_barang', 'id');
    }

    public function analisisAi()
    {
        return $this->hasMany(Analisis_Ai::class, 'id_barang', 'id');
    }
}