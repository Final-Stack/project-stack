@extends('layouts.layout')

@section('content')

    <!-- si esta resuelta poner un div con borde verde o amarillo si no esta resuelta-->
    <div class="container">
        @if($pregunta->estado == 0)
            <div class="card mt-4 mb-4 rounded-0 no-resuelta">
                @else
                    <div class="card mt-4 mb-4 rounded-0 resuelta">
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
                                <span class="text-secondary">Visitas</span> {{$pregunta->visita}}
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
                            <div>
                                <div class="col mt-3">Respuesta</div>
                                <div class="card-body text-black-50 m-4 rounded">
                                    {{$respuesta->descripcion}}
                                </div>
                                <div class="card-header">
                                    {{$respuesta->created_at}}
                                    <div class="d-flex justify-content-end">
                                        Repuesta enviada por&nbsp<a class="text-primary"
                                                                    href="{{route('user.profile',['id'=>$pregunta->user_id])}}">
                                            {{$respuesta->user->nombre}}
                                        </a>
                                    </div>
                                </div>

                                @php
                                    $comentarios = \App\Comentario::where('respuesta_id' , '=' , $respuesta->id)->get();
                                @endphp
                                <div class="card-footer border-0">
                                    <div class="col mt-3">Comentarios {{sizeof($comentarios)}}</div>
                                    <hr class="border-0">
                                    @foreach($comentarios as $comentario)
                                        <div class="col row no-gutters">
                                            <div class="col">
                                                {{$comentario->descripcion}}
                                            </div>
                                            <div class="col">
                                                <span class="text-secondary">Comentado por <a
                                                        class="text-primary"
                                                        href="{{route('user.profile',['id'=>$comentario->user_id])}}">{{$comentario->user->nombre}}</a> el </span> {{$comentario->created_at}}
                                            </div>
                                        </div>
                                    @endforeach
                                    <hr>
                                    @if($pregunta->estado == 0)
                                        <a id="add_comment_{{$respuesta->id}}"
                                           class="add_comment btn btn-link text-primary">Añadir
                                            comentario</a>
                                        <div class="row">
                                            <form id="formu_comentar_{{$respuesta->id}}"
                                                  action="{{route('respuesta.comentar')}}"
                                                  method="post"
                                                  class="ocultar offset-1 col-10 form-group">
                                                @csrf
                                                <textarea class="form-control" name="comentario"
                                                          maxlength="191"></textarea>
                                                <input class="form-control btn btn-primary" type="submit"
                                                       value="Comentar"
                                                       id="comentar">
                                                <input type="hidden" value="{{$respuesta->id}}" name="respuesta_id">
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        @if($pregunta->estado == 0)
                            <div class="no-gutters col border-top">
                                <div class="h2 mt-3">Añadir respuesta</div>
                                <form id="formu_solucionar" action="{{route('pregunta.responder')}}" method="post"
                                      class="form-group">
                                    @csrf
                                    <textarea class="form-control" name="solucion" maxlength="191"></textarea>
                                    <input class="form-control btn btn-primary" type="submit" value="Enviar respuesta"
                                           id="solucionar">
                                    <input type="hidden" value="{{$pregunta->id}}" name="pregunta_id">
                                </form>
                            </div>
                        @endif
                    </div>
            </div>
    </div>
@endsection
