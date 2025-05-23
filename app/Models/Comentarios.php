<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comentarios extends Model
{
    use HasFactory;

    protected $fillable = [
        'contenido',
        'user_id',
        'repertorio_id',
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function repertorio(){
        return $this->belongsTo(Repertorios::class);
    }




}
