<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    public function usuario() {
        return $this->belongsTo('App\Usuario');
    }

    public function pregunta() {
        return $this->belongsTo('App\Pregunta');
    }

    public function votos() {
        return $this->hasMany('App\Voto');
    }

    public function comentarios() {
        return $this->hasMany('App\Comentario');
    }
}
