<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_ide',
        'langkah_langkah',
        'url_video'
    ];

    public function ide()
    {
        return $this->belongsTo(IdeKerajinan::class, 'id_ide');
    }
}