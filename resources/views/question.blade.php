@extends('layouts.layout')

@section('content')

    <!-- TODO  si esta resuelta poner un div con borde verde o amarillo si no esta resuelta-->
    <div class="container">
        @if($pregunta->estado == 0)
            <div class="card mt-4 rounded-0 no-resuelta">
                @else
                    <div class="card mt-4 rounded-0 resuelta">
                        @endif
                        <div class="row">
                            <div class="h1 card-title col-12 m-3">
                                {{$pregunta->titulo}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5 ml-3 mt-3 mb-3">
                                <span class="text-secondary">Preguntado</span> {{$pregunta->created_at}}
                            </div>
                            <div class="col-2 mt-3 mb-3">
                                <span class="text-secondary">Veces visitado</span> {{$pregunta->visita}}
                            </div>
                            <div class="col-2 m-1">
                                @if(Auth::user() != null)
                                    <div id="fav-container">
                                        <!-- comprobar si esta pregunta es favorita o no, y poner un icono u otro-->
                                        <input hidden id="idUsuario" value="{{Auth::user()->id}}">
                                        <input hidden id="idPregunta" value="{{$pregunta->id}}">
                                        <script src="{{secure_asset('js/favoritos.js')}}"></script>
                                    </div>
                                @endif
                            </div>
                            <div class="col-2 mt-3 mb-3 mr-3 ">
                                <div class="col d-flex flex-row ">
                                    <p class="align-content-center mr-2 text-secondary">Votos</p>
                                    <div class="d-flex flex-column">
                                        <i class="fas fa-arrow-up green ml-2"></i>
                                        <i class="fas fa-arrow-down red ml-2"></i>
                                    </div>
                                    <div class="ml-2">
                                        {{$pregunta->votos}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-bottom"></div>

                        <div class="card-body text-black-50 m-4 rounded">
                            <div>
                                {{$pregunta->descripcion}}
                            </div>
                        </div>
                        <div class="card-footer border">
                            @php
                                $tag = $pregunta->etiquetas;
                                $tags = explode(",", $tag);
                                foreach ($tags as $t){
                                echo '<mark class="rounded p-1 mr-1">'.$t.'</mark>';
                                }
                            @endphp
                        </div>
                        <div class="row">
                            <div class="h3 card-title col-12 m-3">
                                Respuestas {{sizeof($respuestas)}}
                            </div>
                        </div>
                        <hr>
                        <!-- Zona de respuestas-->
                        @foreach($respuestas as $respuesta)
                            <div class="">
                                <div class="card-body text-black-50 m-4 rounded">
                                    {{$respuesta->descripcion}}
                                </div>
                                <div class="card-header">
                                    {{$respuesta->created_at}}
                                    <div class="d-flex justify-content-end">
                                        Repuesta enviada por
                                        {{$respuesta->user->nombre}}
                                    </div>
                                </div>

                                @php
                                    $comentarios = \App\Comentario::where('respuesta_id' , '=' , $respuesta->id)->get();
                                @endphp
                                <div class="h4 col">Comentarios</div>
                                <hr>
                                @foreach($comentarios as $comentario)
                                    {{$comentario}}
                                @endforeach
                                <a id="add_comment_{{$respuesta->id}}" class="add_comment">Añadir comentario</a>
                                <form id="formu_comentar_{{$respuesta->id}}" action="/comentar" method="post"
                                      class="ocultar">
                                    @csrf
                                    <textarea class="form-control" name="comentario"></textarea>
                                    <input class="form-control" type="submit" value="Comentar" id="comentar">
                                    <input type="hidden" value="{{$respuesta->id}}" name="respuesta_id">
                                </form>
                                <hr>
                            </div>
                        @endforeach

                        <h2>Añadir respuesta</h2>
                        <form id="formu_solucionar" action="/respuesta" method="post">
                            @csrf
                            <textarea class="form-control" name="solucion"></textarea>
                            <input class="form-control" type="submit" value="Enviar solucion" id="solucionar">
                            <input type="hidden" value="{{$pregunta->id}}" name="pregunta_id">
                        </form>
                    </div>
            </div>


@endsection
