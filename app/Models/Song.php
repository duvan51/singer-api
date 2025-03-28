<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_song');
    }

}
