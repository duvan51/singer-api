<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Los atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_picture',
    ];

    /**
     * Los atributos que deben ocultarse al serializar.
     *
     * @var array<int, string>
     */
    protected $hidden = [
     
        'remember_token',
    ];

    /**
     * Los atributos que deben convertirse a tipos de datos específicos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Laravel 10+ permite 'hashed' para encriptar automáticamente
    ];

    /**
     * Mutador para encriptar la contraseña automáticamente antes de guardarla en la base de datos.
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => bcrypt($value),
        );
    }

     /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function favoriteSongs() {
        return $this->belongsToMany(Song::class, 'favorites', 'user_id', 'song_id');
    }




    
}
