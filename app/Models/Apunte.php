<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apunte extends Model
{

    //Campos que se agregaran
    protected $fillable = [
        'titulo', 'texto', 'imagen', 'user_id', 'modulo_id'
    ];

    //Obtiene la categoría de la receta via FK
    public function modulo()
    {
        return $this->belongsTo(ModuloApunte::class);
    }

    //Obtiene la información del usuario via FK
    public function autor() {
        return $this->belongsTo(User::class, 'user_id');
    }

    //lIKES RECIBIDOS POR UN APUNTE
    public function likes(){
        return $this->belongsToMany(User::class, 'likes_apunte');
    }

    use HasFactory;
}
