@extends('layout')


@extends('layout')

    @section('content')
        <div class="container ">
            <div class="main">
                <h2 class=" ">Preguntas más recientes</h2>

                <a class="grid--cell s-btn s-btn__muted s-btn__outlined" href="/preguntas/formular" data-value="active">Hacer una pregunta</a>


                <ul class="mt-2 nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home">Activas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#">Mas recientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#">Populares</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#">Hoy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#">Semana</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#">Mes</a>
                    </li>
                </ul>
            </div>
            <div class="lista-preguntas">
                @foreach($preguntas as $pregunta)
                    <div onclick="window.location.href='preguntas/{{$pregunta->id}}'">
                        <div class="votos">
                            <span>{{count($pregunta->votos->id_persona)}}</span>
                        </div>
                        <div class="respuestas">
                            <span>{{count($pregunta->respuestas->id)}}</span>
                        </div>
                        <div class="visitas">
                            <span>{{$pregunta->visita}}</span>
                        </div>
                    </div>
                    <div>
                        <h3><a href="preguntas/{{$pregunta->id}}" class="w-100">{{$pregunta->titulo}}</a></h3>
                        <div class="etiquetas">
                            {{$pregunta->eqtiquetas}}
                        </div>
                        <span>modificada hace {{$pregunta->updated_at}} {{$pregunta->usuario->nombre}}</span>
                    </div>
                @endforeach
            </div>
         </div>
    @endsection
