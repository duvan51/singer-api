<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomSong extends Model
{
    use HasFactory;

    protected $fillable = [
        'repertorio_id',
        'original_song_id',
        'repertorio_song_category_id',
        'title',
        'lyrics',
        'key',
        // agrega otros campos que desees personalizar
    ];
    protected $casts = [
        'lyrics' => 'array', // ← Esto convierte automáticamente el JSON en array y viceversa
    ];

    public function song(){
        return $this->belongsTo(Song::class, 'original_song_id');
    }

    public function repertorio(){
        return $this->belongsTo(Repertorios::class, "repertorio_id");
    }
    
    public function repertorio_song_category(){
        return $this->belongsTo(RepertorioSongCategory::class, "repertorio_song_category_id");
    }
  
}

