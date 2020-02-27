@extends('layouts.layout')

@section('content')
    <h1>{{$pregunta->titulo}}</h1>
    <p><strong>Fecha creacion:</strong>{{$pregunta->created_at}} <strong>Estado:</strong>@switch($pregunta->estado)
            @case(0)
            Sin resolver
            @break
            @case(1)
            Resuelta
            @break
        @endswitch <strong>Visitas:</strong>{{$pregunta->visita}}
    </p>
    <div>
        <p>{{$pregunta->descripcion}}</p>
        <p>{{$pregunta->etiquetas}}</p>
    </div>
    <h2>Respuestas</h2>
    <hr>

    @foreach($respuestas as $respuesta)
        {{$respuesta->descripcion}}
        {{$respuesta->created_at}}
        {{$respuesta->user->nombre}}
        @php
            $comentarios = \App\Comentario::where('respuesta_id' , '=' , $respuesta->id)->get();
        @endphp
        <h4>Comentarios</h4>
        <hr>
        @foreach($comentarios as $comentario)
            {{$comentario}}
        @endforeach
        <a id="add_comment_{{$respuesta->id}}" class="add_comment">Añadir comentario</a>
        '
        <form id="formu_comentar_{{$respuesta->id}}" action="/comentar" method="post" class="ocultar">
            @csrf
            <textarea class="form-control" name="comentario"></textarea>
            <input class="form-control" type="submit" value="Comentar" id="comentar">
            <input type="hidden" value="{{$respuesta->id}}" name="respuesta_id">
            <input type="hidden" value="{{$pregunta->id}}" name="pregunta_id">
        </form>
        <hr>
    @endforeach


    <h2>Solucionar pregunta</h2>
    <form id="formu_solucionar" action="/respuesta" method="post">
        @csrf
        <textarea class="form-control" name="solucion"></textarea>
        <input class="form-control" type="submit" value="Enviar solucion" id="solucionar">
        <input type="hidden" value="{{$pregunta->id}}" name="pregunta_id">
    </form>

    @if(Auth::user() != null)
        <div id="fav-container">
            <!-- comprobar si esta pregunta es favorita o no, y poner un icono u otro-->
            <input hidden id="idUsuario" value="{{Auth::user()->id}}">
            <input hidden id="idPregunta" value="{{$pregunta->id}}">
            <script src="{{secure_asset('js/favoritos.js')}}"></script>
        </div>
    @endif

@endsection
