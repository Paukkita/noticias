<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'fecha_publicacion',
        'descripcion',
        'imagen',
        'genero_id',
    ];
      //oneToOne polimorfica
    /*  public function noticiaable(){
        return $this->morphTo();
    } */

    //oneToMany polimorfica
    /* public function noticia(){
        return $this->morphTo();
    } */
    //ManyToMany polimorfica
   /*  public function user(){
        return $this->morphedByMany(User::class, 'noticiaable');
    } */
    //Relacion muchos a muchos
    public function users()
    {
        return $this->belongsToMany(User::class, 'noticia_user', 'noticia_id', 'user_id');
    }

    public function genero(){
        return $this->belongsTo(Genero::class);
    }
}