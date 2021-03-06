@extends('layouts.layout')

@section('content')

    <div class="row mt-4">
        <div class="col-md-9">
            <div class="main">
                @if(Auth::user() != null)
                    <div>
                        <h2 class="mb-3 float-left rango_pregunta">{{$titulo ?? 'Preguntas sin resolver'}}</h2>
                        <a class="float-right btn btn-primary" href="{{ route('pregunta.create')}} "
                           data-value="active">Hacer una pregunta</a>
                    </div>
                @endif

                <ul class="w-100 nav nav-tabs" role="tablist">
                    <li class="nav-item col-4 col-md-2 text-center">
                        <a class="nav-link" href="{{route('index.reciente')}}">Recientes</a>
                    </li>
                    <li class="nav-item col-4 col-md-2 text-center">
                        <a class="nav-link " href="{{route('index.activas')}}">Activas</a>
                    </li>
                    <li class="nav-item col-4 col-md-2 text-center">
                        <a class="nav-link" href="{{route('index.populares')}}">Populares</a>
                    </li>
                    <li class="nav-item col-4 col-md-2 text-center">
                        <a class="nav-link" href="{{route('index.hoy')}}">Hoy</a>
                    </li>
                    <li class="nav-item col-4 col-md-2 text-center">
                        <a class="nav-link" href="{{route('index.semana')}}">Semana</a>
                    </li>
                    <li class="nav-item col-4 col-md-2 text-center">
                        <a class="nav-link" href="{{route('index.mes')}}">Mes</a>
                    </li>
                </ul>
            </div>


            @foreach($preguntas as $pregunta)
                <div class="pregunta row border-bottom p-3"
                     onclick="window.location.href='{{route('pregunta.show',['id'=>$pregunta->pregunta_id])}}'">
                    <div class="d-flex col-3" id="info_pregunta">
                        <div class="votos text-center  col-4">
                            <p>
                                <img id="logo" src="{{secure_asset('img/like.png')}}" alt="logo"
                                     class="question_info d-sm-block d-md-none">
                                <span class="col-12 d-none d-md-block">Votos</span>
                            </p>
                            @foreach($votos as $voto)
                                @php
                                    $existenVotos = false;
                                    $votoNum = -1;
                                        if($pregunta->pregunta_id == $voto->pregunta_id)
                                        {
                                        $existenVotos = true;
                                        $votoNum = $voto->numVotos;
                                        }
                                @endphp
                                @if($existenVotos)
                                    @break
                                @endif
                            @endforeach
                            @if($existenVotos ?? '')
                                <p><span class="col-12">{{$votoNum}}</span></p>
                            @else
                                <p><span class="col-12">0</span></p>
                            @endif
                        </div>


                        <div class="respuestas text-center col-4">
                            <p>
                                <img id="logo" src="{{secure_asset('img/faqs.png')}}" alt="logo"
                                     class="question_info d-sm-block d-md-none">
                                <span class="d-none d-md-block">Respuestas</span>
                            </p>
                            @foreach($respuestas as $respuesta)
                                @php
                                    $existenRespuestas = false;
                                    $respuestasNum = -1;

                                    if($pregunta->pregunta_id == $respuesta->pregunta_id)
                                    {
                                    $existenRespuestas = true;
                                    $respuestasNum = $respuesta->numRespuestas;
                                    }
                                @endphp
                                @if($existenRespuestas)
                                    @break
                                @endif
                            @endforeach

                            @if($existenRespuestas ?? '')
                                <p><span class="col-12">{{$respuestasNum}}</span></p>
                            @else
                                <p><span class="col-12">0</span></p>
                            @endif
                        </div>
                        <div class="visitas text-center col-4 ">
                            <p>
                                <img id="logo" src="{{secure_asset('img/eye.png')}}" alt="logo"
                                     class="question_info d-sm-block d-md-none">
                                <span class="col-12 d-none d-md-block">Visitas</span>
                            </p>
                            <p><span class="col-12">{{$pregunta->visita}}</span></p>
                        </div>
                    </div>
                    <div class="col-9 contenido">
                        <h3><a href="{{route('pregunta.show',['id'=>$pregunta->pregunta_id])}}"
                               class="w-100">{{$pregunta->titulo}}</a>
                        </h3>
                        <div class="etiquetas float-left">
                            @php
                                $tag = $pregunta->etiquetas;
                                $tags = explode(",", $tag);
                                foreach ($tags as $t){
                                if ($t != '') {
                                    echo '<a class="pr-2" href="/buscarEtiquetas/'.$t.'"><mark class="rounded col text-capitalize">' . $t . '</mark><a/>';
                                }}
                            @endphp
                        </div>
                        <div class="float-right propietario">creada por <a
                                href="{{route('user.profile',['id'=>$pregunta->user_id])}}">{{$pregunta->nombre}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div id="paginacion">
                {{$preguntas->links()}}
            </div>

        </div>

        <aside class="col-md-2 d-md-block d-none h-100 aside">
            <div class="row etiquetas-titulo border">
                Etiquetas más usadas
            </div>
            @include('aside.aside')
        </aside>
    </div>
@endsection
