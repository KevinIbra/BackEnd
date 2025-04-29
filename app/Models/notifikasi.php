<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifikasis';
    
    protected $fillable = [
        'id_pengguna',
        'pesan',
        'waktu_kirim',
        'sudah_dibaca'
    ];

    protected $casts = [
        'waktu_kirim' => 'datetime',
        'sudah_dibaca' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }
}