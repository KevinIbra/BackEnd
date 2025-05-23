<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    use HasFactory;

    protected $table = 'tutorials';

    protected $fillable = [
        'judul',
        'deskripsi',
        'video_url',
        'ide_kerajinan_id'
    ];

    public function ideKerajinan()
    {
        return $this->belongsTo(IdeKerajinan::class);
    }
}