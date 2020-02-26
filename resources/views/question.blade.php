@extends('layouts.layout')

@section('content')
    <p>{{$pregunta}}</p>
    <div id="fav-container">
        <!-- comprobar si esta pregunta es favorita o no, y poner un icono u otro-->
        <input hidden id="idUsuario" value="{{Auth::user()->id}}">
        <input hidden id="idPregunta" value="{{$pregunta->id}}">
    </div>
    <script src="{{secure_asset('js/favoritos.js')}}"></script>
@endsection
