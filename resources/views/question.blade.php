@extends('layouts.layout')

@section('content')

    <!-- TODO  si esta resuelta poner un div con borde verde o amarillo si no esta resuelta-->
    <div class="container">
        @switch($pregunta->estado)
            @case(0)
            <div class="card mt-4 rounded-0 resuelta">

                @break
                @case(1)
                <div class="card mt-4 rounded-0 no-resuelta">

                    @break
                    @endswitch


                    <div class="h1 card-title col-12 m-3">
                        {{$pregunta->titulo}}
                    </div>

                    <div class="row">
                        <div class="col-5 m-3">
                            Preguntado: {{$pregunta->created_at}}
                        </div>
                        <div class="col-2 m-3">
                            Visitas: {{$pregunta->visita}}
                        </div>
                        <div class="col-1">
                            @if(Auth::user() != null)
                                <div id="fav-container">
                                    <!-- comprobar si esta pregunta es favorita o no, y poner un icono u otro-->
                                    <input hidden id="idUsuario" value="{{Auth::user()->id}}">
                                    <input hidden id="idPregunta" value="{{$pregunta->id}}">
                                    <script src="{{secure_asset('js/favoritos.js')}}"></script>
                                </div>
                            @endif
                        </div>

                        <div class="mt-3 col-2">
                            Votar ≤åΩ
                        </div>
                    </div>
                    <div class="border-bottom"></div>

                    <div class="card-body text-black-50 m-4 rounded">
                        <div>
                            {{$pregunta->descripcion}}
                        </div>
                    </div>

                    <div class="card-footer">
                        @php
                            $tag = $pregunta->etiquetas;
                            $tags = explode(",", $tag);
                            foreach ($tags as $t){
                            echo '<mark class="rounded p-1 mr-1">'.$t.'</mark>';
                            }
                        @endphp

                    </div>

                </div>


            </div>









            <h1>{{$pregunta->titulo}}</h1>
            <p><strong>Fecha creacion:</strong>{{$pregunta->created_at}}
                <strong>Estado:</strong>@switch($pregunta->estado)
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



@endsection
