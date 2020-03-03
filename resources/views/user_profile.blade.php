@extends('layouts.layout')

@section('content')
    <div id="user_container">
        <div id="profile_container">

            <div id="user_data" class="col-8 mt-4">
                <!-- o foto de la api de google o sino la guardada en nuestra base de datos -->
                @if(Auth::user() != null)
                    @if(Auth::user()->google_id != null)
                        <img src="{{$usuario->url_foto}}" id="user_img">
                    @else
                        <img src="{{secure_asset($usuario->url_foto)}}" id="user_img">
                    @endif
                @else
                    <img src="{{secure_asset($usuario->url_foto)}}" id="user_img">
                @endif
                <div id="user">
                    <h1 id="username" class="text-capitalize">{{$usuario->nombre}}</h1>
                    <h3 id="user_biography">{{$usuario->biografia ?? 'Sin biografia'}}</h3>

                    @if(Auth::user() != null && Auth::user()->id == $usuario->id)
                        <input class="form-control btn btn-info" type="button" value="Cambiar biografia"
                               id="boton_cambio">
                        <form style="display: none" id="formu_cambio" action="/user/{{$usuario->id}}" method="post">
                            @csrf
                            <textarea class="form-control" name="biografia" id="bio"></textarea>
                            <input class="form-control btn btn-success" type="submit" value="Confirmar cambio"
                                   id="confirmar_cambio">
                            <input class="form-control btn btn-danger" type="button" value="Cancelar cambio"
                                   id="cancelar_cambio">
                        </form>
                    @endif
                </div>

            </div>

            <div id="user_information" class="col-4 mt-4">
                <p><img class="mr-2" src="{{secure_asset('img/mail.png')}}">{{$usuario->email}}</p>
                <p><img class="mr-2" src="{{secure_asset('img/work.png')}}">{{$usuario->sector_donde_trabaja}}</p>
                <p><img class="mr-2" src="{{secure_asset('img/passage-of-time.png')}}">{{$tiempo}}</p>
            </div>

        </div>
        <br>
        <div id="divPreguntas">
            <h2 class="col-4 float-left">Preguntas</h2>
            <ul class="col-8 nav pl-4 col-8 float-right" role="tablist">
                <li class="nav-item float-right mr-3">
                    <button class="btn btn-success" onclick="mostrarRespuestas()">Respuestas</button>
                </li>
                <li class="nav-item float-right">
                    <button class="btn btn-warning" onclick="mostrarFavoritos()">Favoritos</button>
                </li>
            </ul>


            <table class="table table-borderless">
                <thead>
                <tr>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Visitas</th>
                    <th scope="col">Etiquetas</th>
                </tr>
                </thead>
                <tbody>
                @foreach($preguntas as $pregunta)
                    <tr>
                        <td><a href="/preguntas/{{$pregunta->id}}">{{$pregunta->titulo}}</a></td>
                        <td>{{$pregunta->descripcion}}</td>
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
                        <td>{{$pregunta->visita}}</td>
                        <td>
                            @php
                                $tag = $pregunta->etiquetas;
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


        <br>
        <div id="divRespuestas">
            <h2 class="col-4 float-left">Respuestas</h2>
            <ul class="col-8 nav pl-4 col-8 float-right" role="tablist">
                <li class="nav-item ">
                    <button class="btn btn-success mr-3" onclick="mostrarPreguntas()">Preguntas</button>
                </li>
                <li class="nav-item">
                    <button class="btn btn-warning" onclick="mostrarFavoritos()">Favoritos</button>
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
            <h2 class="col-4 float-left">Favoritos</h2>
            <ul class="col-8 nav pl-4 col-8 float-right" role="tablist">
                <li class="nav-item ">
                    <button class="btn btn-success mr-3" onclick="mostrarRespuestas()">Respuestas</button>
                </li>
                <li class="nav-item">
                    <button class="btn btn-warning" onclick="mostrarPreguntas()">Preguntas</button>
                </li>
            </ul>

            <table class="table table-borderless">
                <thead>
                <tr>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Visitas</th>
                    <th scope="col">Etiquetas</th>
                </tr>
                </thead>
                <tbody>
                @foreach($favoritos as $favorito)
                    <tr>
                        <td><a href="/preguntas/{{$favorito->pregunta_id}}">{{$favorito->titulo}}</a></td>
                        <td>{{$favorito->descripcion}}</td>
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
