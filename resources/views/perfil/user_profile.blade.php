@extends('layouts.layout')

@section('content')
    <div id="user_container">

        <!-- Contenedor del perfil del usuario con su información-->
        <div id="profile_container" class="row m-2">

            <!-- Información principal-->
            <div id="user_data" class="col-12 col-md-8">
                <!-- o foto de la api de google o sino la guardada en nuestra base de datos -->
                <div class="col-12 text-center">
                    @if(Auth::user() != null && Auth::user()->google_id != null)
                        <img src="{{$usuario->url_foto}}" id="user_img" class="rounded-circle border" alt="user_img">
                    @else
                        <img src="{{secure_asset($usuario->url_foto)}}" id="user_img" class="rounded-circle border"
                             alt="user_img">
                    @endif
                </div>

                <div id="user" class="row no-gutters text-center mt-2">
                    <div id="username" class="col-12 h1 text-capitalize">{{$usuario->nombre}}</div>
                    <div id="user_biography"
                         class="col-12 h5 text-black-50">{{$usuario->biografia ?? 'Sin biografia'}}</div>
                    @if(Auth::user() != null && Auth::user()->id == $usuario->id)
                        <div class="col-12 d-flex justify-content-center">
                            <p class="btn btn-link" id="boton_cambio">Cambiar biografia
                                <i class="fas fa-edit"></i>
                            </p>
                            <form style="display: none" id="formu_cambio"
                                  action="{{route('pregunta.actualizar',['id'=>$usuario->id])}}" method="post">
                                @csrf
                                <div class="row no-gutters">
                                    <textarea class="form-control" name="biografia" id="bio" maxlength="190"></textarea>
                                    <input class="col-6 col-md-5 btn btn-success m-md-3" type="submit"
                                           value="Confirmar cambio" id="confirmar_cambio">
                                    <input class="col-6 col-md-5 btn btn-danger m-md-3" type="button" value="Cancelar cambio"
                                           id="cancelar_cambio">
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Información secundaria-->
            <div id="user_information" class="col-12 col-md-4 mt-3 mt-md-0">
                <div class="row no-gutters">
                    <p class="col-12 text-nowrap">
                        <i class="fas fa-envelope-square mr-2 fa-2x"></i>{{$usuario->email}}
                    </p>
                    <p class="col-12 text-nowrap">
                        <i class="fas fa-briefcase mr-2 fa-2x"></i>{{$usuario->sector_donde_trabaja}}
                    </p>
                    <p class="col-12 text-nowrap">
                        <i class="fas fa-history mr-2 fa-2x"></i>{{$tiempo}}
                    </p>
                </div>
            </div>

        </div>

        <div class="mt-3 overflow-auto">
            <div id="divPreguntas">
                <!-- Tab list-->
                <div class="row no-gutters">
                    <div class="h3 active">Preguntas</div>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" onclick="mostrarRespuestas()">Respuestas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" onclick="mostrarFavoritos()">Favoritos</a>
                        </li>
                    </ul>
                </div>

                <table id="tabla" class="table table-borderless table-bordered table-striped mt-3 ">
                    <thead>
                    <tr>
                        <th scope="col">Titulo</th>
                        <th class="d-none d-md-block" scope="col">Descripcion</th>
                        <th scope="col">Estado</th>
                        <th scope="col"> Visitas</th>
                        <th scope="col">Etiquetas</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($preguntas as $pregunta)
                        <tr>
                            <td><a href="{{route('pregunta.show',['id'=>$pregunta->id])}}">{{$pregunta->titulo}}</a>
                            </td>
                            <td class="d-none d-md-block">{{$pregunta->descripcion}}</td>
                            <td>
                                @switch($pregunta->estado)
                                    @case(0)
                                    Sin resolver
                                    @break
                                    @case(1)
                                    Resuelta
                                    @break
                                @endswitch
                            </td>
                            <td class="text-center">{{$pregunta->visita}}</td>
                            <td class="d-flex flex-wrap">
                                @php
                                    $tag = $pregunta->etiquetas;
                                    $tags = explode(",", $tag);
                                    foreach ($tags as $t){
                                    if ($t != '') {
                                        echo '<mark class="rounded text-capitalize mb-2 mr-2 pl-2 pr-2">' .$t. '</mark>';
                                    }}
                                @endphp
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div id="divRespuestas">
                <!-- Tab list-->
                <div class="row no-gutters">
                    <div class="h3">Respuestas</div>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" onclick="mostrarPreguntas()">Preguntas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" onclick="mostrarFavoritos()">Favoritos</a>
                        </li>
                    </ul>
                </div>

                <table class="table table-borderless table-bordered table-striped col-12 mt-3">
                    <thead>
                    <tr>
                        <th scope="col">Pregunta</th>
                        <th class="d-none d-md-block" scope="col">Respuesta</th>
                        <th scope="col">Fecha</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($respuestas as $respuesta)
                        @php
                            $preguntarespondida = \App\Pregunta::where('id', '=' , $respuesta->pregunta_id)->first();
                        @endphp
                        <tr>
                            <td>
                                <a href="{{route('pregunta.show',['id'=>$preguntarespondida->id])}}">{{$preguntarespondida->titulo}}</a>
                            </td>
                            <td class="d-none d-md-block">{{$respuesta->descripcion}}</td>
                            <td><strong
                                    id="answer"></strong> {{Carbon\Carbon::parse($respuesta->created_at)->locale('es')->isoFormat('LLLL')}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <div id="divFavoritos">
                <!-- Tab list-->
                <div class="row no-gutters">
                    <div class="h3">Favoritos</div>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" onclick="mostrarRespuestas()">Respuestas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" onclick="mostrarPreguntas()">Preguntas</a>
                        </li>
                    </ul>
                </div>

                <table class="table table-borderless table-bordered table-striped col-12 mt-3">
                    <thead>
                    <tr>
                        <th scope="col">Titulo</th>
                        <th class="d-none d-md-block" scope="col">Descripcion</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Visitas</th>
                        <th scope="col">Etiquetas</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($favoritos as $favorito)
                        <tr>
                            <td>
                                <a href="{{route('pregunta.show',['id'=>$favorito->pregunta_id])}}">{{$favorito->titulo}}</a>
                            </td>
                            <td class="d-none d-md-block">{{$pregunta->descripcion}}</td>
                            <td>
                                @switch($favorito->estado)
                                    @case(0)
                                    Sin resolver
                                    @break
                                    @case(1)
                                    Resuelta
                                    @break
                                @endswitch
                            </td>
                            <td>{{$favorito->visita}}</td>
                            <td class="d-flex flex-wrap">
                                @php
                                    $tag = $favorito->etiquetas;
                                    $tags = explode(",", $tag);
                                    foreach ($tags as $t){
                                    if ($t != '') {
                                        echo '<mark class="rounded text-capitalize mr-2 mb-2 pl-2 pr-2">' . $t . '</mark>';
                                    }}
                                @endphp
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="{{ secure_asset('js/profile.js') }}"></script>
@endsection
