<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorit extends Model
{
    use HasFactory;

    protected $table = 'favorits';

    protected $fillable = [
        'id_favorit',
        'id_pengguna',
        'id_ide',
        'waktu_simpan'
    ];

    protected $casts = [
        'waktu_simpan' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_pengguna', 'id');
    }

    public function ideKerajinan()
    {
        return $this->belongsTo(IdeKerajinan::class, 'id_ide', 'id');
    }
}