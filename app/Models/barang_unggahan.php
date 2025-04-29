<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang_Unggahan extends Model
{
    use HasFactory;

    protected $table = 'barang_unggahans';

    protected $fillable = [
        'id_barang',
        'id_pengguna',
        'url_gambar',
        'waktu_unggah'
    ];

    protected $casts = [
        'waktu_unggah' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna', 'id');
    }

    public function ideKerajinan()
    {
        return $this->belongsTo(IdeKerajinan::class, 'id_barang', 'id');
    }
}