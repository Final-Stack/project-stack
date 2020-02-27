<?php

use App\Pregunta;

$preguntas = Pregunta::all();

$evitarRepetidos = [];
foreach ($preguntas as $pregunta) {
    $tag = $pregunta->etiquetas;
    $tags = explode(",", $tag);
    foreach ($tags as $t) {
        if (!in_array($t, $evitarRepetidos)) {
            array_push($evitarRepetidos, $t);
            echo '<div class="row border">
                        <mark class="rounded col text-capitalize">
                            <i class="fas fa-tag"></i>
                            ' . $t . '</mark>
                  </div>';
        }
    }
}
