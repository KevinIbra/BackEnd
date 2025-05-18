<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdeKerajinan extends Model
{
    use HasFactory;

    protected $table = 'ide_kerajinans';

    protected $fillable = [
        'judul',
        'bahan_dibutuhkan',
        'tingkat_kesulitan',
        'deskripsi',
        'gambar'
    ];

    public function barangUnggahan()
    {
        return $this->hasMany(BarangUnggahan::class);
    }

    public function tutorial()
    {
        return $this->hasOne(Tutorial::class);
    }
}