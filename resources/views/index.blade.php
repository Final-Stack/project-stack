@extends('layout')

    @section('content')
        <div class="container ">
            <div class="main">
                <div>
                    <h2 class="mb-3 float-left">Preguntas más recientes</h2>
                    <a class="float-right btn btn-primary" href="/create" data-value="active">Hacer una pregunta</a>
                </div>

                <ul class="w-100 nav nav-tabs" role="tablist">
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
            <div class="lista-preguntas row border-bottom p-2">
                @foreach($preguntas as $pregunta)
                    <div class="d-flex col-5" onclick="window.location.href='preguntas/{{$pregunta->id}}'">
                        <div class="votos text-center  col-4">
                            <span class="col-12"></span>
                            <span>Votos</span>
                        </div>
                        <div class="respuestas text-center  col-4">
                            <span>Respuestas</span>
                        </div>
                        <div class="visitas text-center col-4">
                            <span class="col-12">{{$pregunta->visita}}</span>
                            <span class="col-12">Visitas</span>
                        </div>
                    </div>
                    <div class="col-5">
                        <h3><a href="preguntas/{{$pregunta->id}}" class="w-100">{{$pregunta->titulo}}</a></h3>
                        <div class="etiquetas">
                            {{$pregunta->etiquetas}}
                        </div>
                        <span>modificada hace {{$pregunta->updated_at}} <a>{{$pregunta->nombre}}</a></span>
                    </div>
                @endforeach
            </div>
         </div>
    @endsection
