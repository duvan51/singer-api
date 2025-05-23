<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepertorioSongCategory extends Model{
    
    protected $table = 'repertorio_song_category';
    
    protected $fillable = ['nombre', 'repertorio_id'];

    public function repertorioSongs(){
        return $this->hasMany(RepertorioSong::class);
    }

    public function repertorio()
    {
        return $this->belongsTo(Repertorios::class);
    }

    // En RepertorioSongCategory.php
    public function customSongs()
    {
    return $this->hasMany(CustomSong::class, 'repertorio_song_category_id');
    }


    
}
