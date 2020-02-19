<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public function preguntas() {
        return $this->hasMany('App\Pregunta');
    }

    public function respuestas() {
        return $this->hasMany('App\Respuesta');
    }

    public function favoritos() {
        return $this->hasMany('App\Pregunta');
    }
}
