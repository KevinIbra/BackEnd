<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangUnggahan extends Model
{
    use HasFactory;

    protected $table = 'barang_unggahans';

    protected $fillable = [
        'nama_barang',
        'deskripsi',
        'foto',
        'ide_kerajinan_id'
    ];

    public function ideKerajinan()
    {
        return $this->belongsTo(IdeKerajinan::class);
    }
}