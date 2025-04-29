<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekomendasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_ide',
        'id_analisis',
        'skor_relavansi'
    ];

    protected $casts = [
        'skor_relavansi' => 'float'
    ];

    public function ide()
    {
        return $this->belongsTo(IdeKerajinan::class, 'id_ide');
    }

    public function analisis()
    {
        return $this->belongsTo(Analisis_Ai::class, 'id_analisis');
    }
}