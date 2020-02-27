@extends('layouts.layout')

@section('content')
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
                        echo '<mark class="rounded p-1 mr-1">'.$t.'</mark>';
                        }
                    @endphp
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
