<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    public function respuesta()
    {
        return $this->belongsTo('App\Respuesta');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
