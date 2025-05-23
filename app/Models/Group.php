<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    
    protected $table = 'group';

    
    use HasFactory;

    protected $fillable = ['nombre', 'fecha', 'user_id'];


    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function creator(){
        return $this->belongsTo(User::class, 'user_id');
    }

    
    public function repertorios(){
        return $this->hasMany(Repertorios::class);
    }

}


