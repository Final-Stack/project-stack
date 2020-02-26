<?php

use App\Pregunta;

$preguntas=Pregunta::all();

foreach ($preguntas as $pregunta){
    echo "<p>$pregunta->etiquetas</p>";
}
