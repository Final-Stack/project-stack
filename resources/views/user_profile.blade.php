@extends('layouts.layout')

@section('content')
<div id="profile_container">

    <div id="user_data">
        <img src="{{Storage::url($usuario->url_foto)}}" id="user_img">
        <div id="user">
            <h1 id="username">{{$usuario->nombre}}</h1>
            <h3 id="user_biography">{{$usuario->biografia ?? 'Sin biografia'}}</h3>
            <input class="form-control" type="button" value="Cambiar biografia" id="boton_cambio">
            <form style="display: none" id="formu_cambio" action="/user/{{$usuario->id}}" method="post">
                @csrf
                <textarea class="form-control" name="biografia"></textarea>
                <input class="form-control" type="submit" value="Confirmar cambio" id="confirmar_cambio">
                <input class="form-control" type="button" value="Cancelar cambio" id="cancelar_cambio">
            </form>
        </div>

    </div>


    <div id="user_information">
        <p><img src="{{secure_asset('img/mail.png')}}">{{$usuario->email}}</p>
        <p><img src="{{secure_asset('img/work.png')}}">{{$usuario->sector_donde_trabaja}}</p>
        <p><img src="{{secure_asset('img/passage-of-time.png')}}">{{$tiempo}}</p>
    </div>
    @foreach($preguntas as $pregunta)
        <p>{{$pregunta}}</p>
    @endforeach
</div>

@endsection
