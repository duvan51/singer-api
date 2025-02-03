<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $table = 'song';

    protected $fillable = [
        'name',
        'autor',
        'song',
    ];
    protected $casts = [
        'song' => 'array', // Cast 'song' como un array
    ];

}
