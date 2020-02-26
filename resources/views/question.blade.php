@extends('layouts.layout')

@section('content')
    <p>{{$pregunta}}</p>

    @if(Auth::user() != null)
        <div id="fav-container">
            <!-- comprobar si esta pregunta es favorita o no, y poner un icono u otro-->
            <input hidden id="idUsuario" value="{{Auth::user()->id}}">
            <input hidden id="idPregunta" value="{{$pregunta->id}}">
            <script src="{{secure_asset('js/favoritos.js')}}"></script>
        </div>
    @endif
@endsection
