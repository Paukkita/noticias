<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatHistory extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'role',
        'content',
    ];
    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
