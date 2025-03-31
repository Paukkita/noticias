<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Faker\Guesser\Name;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
    //Relacion muchos a muchos
    public function noticias()
    {
        return $this->belongsToMany(Noticia::class);
    }


    /* public function name(){
        return $this->hasOne(Name::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    } */

    //oneToOne polimorfica
    /*    public function noticia(){
        return $this->morphOne(Noticia::class,'noticiaable');
    } */

    //oneToMany polimorfica
    /*  public function noticia(){
        return $this->morphMany(Noticia::class,'noticiaable');
    } */
    //ManyToMany polimorfica
    /*  public function noticia(){
        return $this->morphToMany(Noticia::class, 'noticiaable');
    } */
}
