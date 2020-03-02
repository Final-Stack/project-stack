@extends('layouts.layout')

@section('content')
    <div id="user_container">
        <div id="profile_container">

            <div id="user_data" class="col-8 mt-4">
                <img src="{{Storage::url($usuario->url_foto)}}" id="user_img">
                <div id="user">
                    <h1 id="username">{{$usuario->nombre}}</h1>
                    <h3 id="user_biography">{{$usuario->biografia ?? 'Sin biografia'}}</h3>

                    @if(Auth::user() != null && Auth::user()->id == $usuario->id)
                        <input class="form-control" type="button" value="Cambiar biografia" id="boton_cambio">
                        <form style="display: none" id="formu_cambio" action="/user/{{$usuario->id}}" method="post">
                            @csrf
                            <textarea class="form-control" name="biografia"></textarea>
                            <input class="form-control" type="submit" value="Confirmar cambio" id="confirmar_cambio">
                            <input class="form-control" type="button" value="Cancelar cambio" id="cancelar_cambio">
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
        <h2>Preguntas</h2>
        <hr>
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
                            echo '<mark class="rounded col text-capitalize">' . $t . '</mark>';
                        }}
                        @endphp
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <br>
        <div id="divRespuestas">
            <h2>Respuestas</h2>
            <hr>
            @foreach($respuestas as $respuesta)
                @php
                    $preguntarespondida = \App\Pregunta::where('id', '=' , $respuesta->pregunta_id)->first();
                @endphp
                <h3><a href="/preguntas/{{$preguntarespondida->id}}">{{$preguntarespondida->titulo}}</a></h3>


                <p><strong id="answer">{{$respuesta->descripcion}}</strong> <p>{{$respuesta->created_at}}</p></p>


            @endforeach
        </div>
        <div id="divFavoritos">
            <h2>Favoritos</h2>
            <hr>
            @foreach($favoritos as $favorito)
                <h3><a href="/preguntas/{{$favorito->pregunta_id}}">{{$favorito->pregunta_id}}</a></h3>
            @endforeach
        </div>

    </div>
    <script src="{{ secure_asset('js/profile.js') }}"></script>

@endsection
