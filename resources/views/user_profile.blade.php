@extends('layouts.layout')

@section('content')
    <div id="user_container">
        <div id="profile_container" class="p-3 row">

            <div id="user_data" class="col-12 col-sm-8 mt-4 flex-wrap">
                <!-- o foto de la api de google o sino la guardada en nuestra base de datos -->
                @if(Auth::user() != null)
                    @if(Auth::user()->google_id == null)
                        <img src="{{secure_asset($usuario->url_foto)}}" id="user_img"
                             class="float-md-left-left mx-auto ">
                    @else
                        <img src="{{$usuario->url_foto}}" id="user_img" class="float-sm-left">
                    @endif
                @else
                    <img src="{{secure_asset($usuario->url_foto)}}" id="user_img" class="">
                @endif
                <div id="user" class="row no-gutters">
                    <h1 id="username" class="text-capitalize text-center col-12">{{$usuario->nombre}}</h1>
                    <h5 id="user_biography"
                        class="text-center text-break col-12">{{$usuario->biografia ?? 'Sin biografia'}}</h5>

                    @if(Auth::user() != null && Auth::user()->id == $usuario->id)
                        <input class="btn btn-info col" type="button" value="Cambiar biografia"
                               id="boton_cambio">
                        <form style="display: none" id="formu_cambio" action="/user/{{$usuario->id}}" method="post">
                            @csrf
                            <textarea class="form-control" name="biografia" id="bio" maxlength="190"></textarea>
                            <input class="form-control btn btn-success" type="submit" value="Confirmar cambio"
                                   id="confirmar_cambio">
                            <input class="form-control btn btn-danger" type="button" value="Cancelar cambio"
                                   id="cancelar_cambio">
                        </form>
                    @endif
                </div>
            </div>

            <div id="user_information" class="row col-sm-4 mt-4 mx-auto">
                <p class="w-100"><i class="fas fa-envelope-square mr-2 fa-2x"></i>{{$usuario->email}}</p>
                <p class="w-100"><i class="fas fa-briefcase mr-2 fa-2x"></i>{{$usuario->sector_donde_trabaja}}</p>
                <p class="w-100 text-nowrap"><i class="fas fa-history mr-2 fa-2x"></i>{{$tiempo}}</p>
            </div>

        </div>
        <br>
        <div id="divPreguntas">

            <h3 class="col-4 float-left">Preguntas</h3>
            <ul class="col-8  col-md-7 col-lg-5  nav float-right pl-3 mb-3" role="tablist">
                <li class="nav-item float-right col-6 col-sm-3 col-md-4 col-lg-5">
                    <button class="btn btn-success" onclick="mostrarRespuestas()">Respuestas</button>
                </li>
                <li class="nav-item float-right pl-4 col-6 col-sm-3 col-md-4 col-lg-5">
                    <button class="btn btn-warning ml-2" onclick="mostrarFavoritos()">Favoritos</button>
                </li>
            </ul>

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
                        <td><a href="/preguntas/{{$pregunta->id}}">{{$pregunta->titulo}}</a></td>
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
                        <td>
                            @php
                                $tag = $pregunta->etiquetas;
                                $tags = explode(",", $tag);
                                foreach ($tags as $t){
                                if ($t != '') {
                                    echo '<mark class="rounded col text-capitalize mb-2 mr-2">' . $t . '</mark> <br><br>';
                                }}
                            @endphp
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


        <br>
        <div id="divRespuestas">
            <h4 class="col-4 float-left">Respuestas</h4>
            <ul class="col-8  col-md-7 col-lg-5  nav float-right pl-3 mb-3" role="tablist">
                <li class="nav-item float-right col-6 col-sm-3 col-md-4 col-lg-5">
                    <button class="btn btn-success mr-3" onclick="mostrarPreguntas()">Preguntas</button>
                </li>
                <li class="nav-item float-right col-6 col-sm-3 col-md-4 col-lg-5">
                    <button class="btn btn-warning ml-2" onclick="mostrarFavoritos()">Favoritos</button>
                </li>
            </ul>

            @foreach($respuestas as $respuesta)
                @php
                    $preguntarespondida = \App\Pregunta::where('id', '=' , $respuesta->pregunta_id)->first();
                @endphp
                <h3><a href="/preguntas/{{$preguntarespondida->id}}">{{$preguntarespondida->titulo}}</a></h3>


                <p><strong id="answer">{{$respuesta->descripcion}}</strong> <p>{{$respuesta->created_at}}</p></p>


            @endforeach
        </div>
        <div id="divFavoritos">
            <h3 class="col-4 float-left">Favoritos</h3>
            <ul class="col-8  col-md-7 col-lg-5  nav float-right pl-2 mb-3" role="tablist">
                <li class="nav-item float-right col-6 col-sm-3 col-md-4 col-lg-5">
                    <button class="btn btn-success mr-3" onclick="mostrarRespuestas()">Respuestas</button>
                </li>
                <li class="nav-item float-right col-6 col-sm-3 col-md-4 col-lg-5">
                    <button class="btn btn-warning ml-3" onclick="mostrarPreguntas()">Preguntas</button>
                </li>
            </ul>
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
                        <td><a href="/preguntas/{{$favorito->pregunta_id}}">{{$favorito->titulo}}</a></td>
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
                        <td>
                            @php
                                $tag = $favorito->etiquetas;
                                $tags = explode(",", $tag);
                                foreach ($tags as $t){
                                if ($t != '') {
                                    echo '<mark class="rounded col text-capitalize mr-2">' . $t . '</mark>';
                                }}
                            @endphp
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <script src="{{ secure_asset('js/profile.js') }}"></script>
@endsection
