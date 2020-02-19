<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voto extends Model
{
    public function respuesta() {
        return $this->belongsTo('App\Respuesta');
    }

    public function pregunta() {
        return $this->belongsTo('App\Pregunta');
    }
}
