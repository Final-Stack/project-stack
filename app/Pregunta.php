<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    /*protected $casts = [
      'etiquetas' => 'array'
    ];*/

    public function usuario() {
        return $this->belongsTo('App\Usuario');
    }

    public function favorito() {
        return $this->hasOne('App\Favorito');
    }

    public function respuestas() {
        return $this->hasMany('App\Respuesta');
    }

    public function votos() {
        return $this->hasMany('App\Voto');
    }
}
