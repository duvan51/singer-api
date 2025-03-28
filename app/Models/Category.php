<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $fillable = ['name', 'image_url'];

    // Relación muchos a muchos con Song
    public function songs(): BelongsToMany
    {
        return $this->belongsToMany(Song::class, 'category_song');
    }

    
}
