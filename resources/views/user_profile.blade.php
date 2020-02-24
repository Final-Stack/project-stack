@extends('layouts.layout')

@section('content')
<img src="{{Storage::url($usuario->url_foto)}}">
<h1>{{$usuario->nombre}}</h1>
<p><img src="{{secure_asset('img/mail.png')}}">{{$usuario->email}}</p>
<p><img src="{{secure_asset('img/work.png')}}">{{$usuario->sector_donde_trabaja}}</p>
<p><img src="{{secure_asset('img/passage-of-time.png')}}">{{$tiempo}}</p>

@foreach($preguntas as $pregunta)
    <p>{{$pregunta}}</p>
@endforeach

@endsection
