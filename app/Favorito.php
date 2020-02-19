<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    public function pregunta() {
        return $this->belongsTo('App\Pregunta');
    }

    public function usuario() {
        return $this->belongsTo('App\Usuario');
    }
}
