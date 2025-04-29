<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analisis_Ai extends Model
{
    use HasFactory;

    protected $table = 'analisis_ais';

    protected $fillable = [
        'id_analisis',
        'id_barang',
        'jenis_barang',
        'skor_akurasi'
    ];

    protected $casts = [
        'skor_akurasi' => 'float'
    ];

    public function ideKerajinan()
    {
        return $this->belongsTo(IdeKerajinan::class, 'id_barang', 'id');
    }
}