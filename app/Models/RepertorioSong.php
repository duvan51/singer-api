<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepertorioSong extends Model
{
    protected $table = 'repertorio_song';


    protected $fillable = [
        'repertorio_id',
        'song_id',
        'repertorio_song_category_id',
        // otros campos que desees permitir para asignación masiva
    ];

    public function repertorio()
    {
        return $this->belongsTo(Repertorios::class);
    }

    public function song()
    {
        return $this->belongsTo(Song::class);
    }

    public function repertorio_song_category()
    {
        return $this->belongsTo(RepertorioSongCategory::class, 'repertorio_song_category_id');
    }

}
