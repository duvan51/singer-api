<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Repertorios extends Model{
    use HasFactory;
    protected $fillable = [
        'group_id',
        'nombre', // u otros campos como 'descripcion', 'fecha', etc.
        'fecha'
    ];

    public function group(){   
        return $this->belongsTo(Group::class);
    }

    public function repertorioSongs(){
        return $this->hasMany(RepertorioSong::class, 'repertorio_id');
    }

    public function repertorio_song_category()
    {
        return $this->hasMany(RepertorioSongCategory::class, 'repertorio_id');
    }

    public function comentarios(){
        return $this->hasMany(Comentarios::class, 'repertorio_id');
    }

    public function customSong(){
        return $this->hasMany(CustomSong::class, 'repertorio_id');
    }


}



