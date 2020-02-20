@extends('layouts.layout')

    @section('content')
        <div class="container ">
            <div class="main">
                <div>
                    <h2 class="mb-3 float-left">Preguntas más recientes</h2>
                        <a class="float-right btn btn-primary" href="{{ route('pregunta.create')}} " data-value="active">Hacer una pregunta</a>
                </div>

                <ul class="w-100 nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link"  href="{{route('index.reciente')}}">Mas recientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link "  href="/activas">Activas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="/populares">Populares</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="/hoy">Hoy</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="/semana">Semana</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"  href="/mes">Mes</a>
                    </li>
                </ul>
            </div>

                @foreach($preguntas as $pregunta)
                <div class="pregunta row border-bottom p-3 ">
                        <div class="d-flex col-5" onclick="window.location.href='preguntas/{{$pregunta->id}}'">
                            <div class="votos text-center  col-4">
                                @foreach($votos as $voto)
                                    @if($pregunta->id = $voto->id_pregunta)
                                        <span class="col-12">{{$voto->numVotos}}</span>
                                    @endif
                                @endforeach
                                <span class="col-12">Votos</span>
                            </div>
                            <div class="respuestas text-center  col-4">
                                @foreach($respuestas as $respuesta)
                                    @if($pregunta->id = $respuesta->id_pregunta)
                                        <span class="col-12">{{$respuesta->numPreguntas}}</span>
                                    @endif
                                @endforeach
                                <span>Respuestas</span>
                            </div>
                            <div class="visitas text-center col-4 ">
                                <span class="col-12">{{$pregunta->visita}}</span>
                                <span class="col-12">Visitas</span>
                            </div>
                        </div>
                        <div class="col-5 ">
                            <h3><a href="preguntas/{{$pregunta->id}}" class="w-100">{{$pregunta->titulo}}</a></h3>
                            <div class="etiquetas float-left">
                                <mark class="p-1">{{json_decode($pregunta->etiquetas)}}</mark>
                            </div>
                            <span class="float-right ">creada por <a href="">{{$pregunta->nombre}}</a></span>
                        </div>
                </div>
                @endforeach
            {{$preguntas->links()}}
         </div>
    @endsection
