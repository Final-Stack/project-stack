@extends('layouts.layout')

@section('content')
    <!-- ID de la pregunta-->
    <input hidden id="idPregunta" value="{{$pregunta->id}}">
    <!-- si esta resuelta poner un div con borde verde o amarillo si no esta resuelta-->
    <div class="container">
        @if($pregunta->estado == 0)
            <div class="card mt-4 mb-4 rounded-0 no-resuelta">
                @else
                    <div class="card mt-4 mb-4 rounded-0 resuelta">
                        @endif
                        <div class="row no-gutters">
                            <div class="h1 card-title col-12 m-3">
                                {{$pregunta->titulo}}
                            </div>
                        </div>
                        <div class="row no-gutters">
                            <div class="col-8 col-md-5 m-3">
                                <span
                                    class="text-secondary">Preguntado</span> {{Carbon\Carbon::parse($pregunta->created_at)->locale('es')->isoFormat('LLLL')}}
                            </div>
                            <div class="col-2 col-md-2 m-3 text-nowrap">
                                <span class="text-secondary">Visitas</span> {{$pregunta->visita}}
                            </div>
                            <div class="col-3 col-md-1 mr-3 ml-3">
                                @if(Auth::user() != null)
                                    <div id="fav-container">
                                        <!-- comprobar si esta pregunta es favorita o no, y poner un icono u otro-->
                                        <input hidden id="idUsuario" value="{{Auth::user()->id}}">
                                        <script src="{{secure_asset('js/favoritos.js')}}"></script>
                                    </div>
                                @endif
                            </div>
                            <div class="col-2 col-md-1 mt-3 mb-3 mr-3 ">
                                <div class="col d-flex flex-row ">
                                    <p class="align-content-center mr-2 text-secondary">Votos</p>
                                    <div class="d-flex flex-column">
                                        @if(Auth::user() != null)
                                            <i class="fas fa-arrow-up fa-2x green ml-2" id="up"></i>
                                            <i class="fas fa-arrow-down fa-2x red ml-2"></i>
                                        @endif
                                    </div>
                                    <div class="ml-2">
                                        <script src="{{secure_asset('js/votos.js')}}"></script>
                                        <span id="votos-count"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(Auth::user() != null && Auth::user()->id == $pregunta->user_id && $pregunta->estado == 0)
                            <div class="row no-gutters">
                                <div class="col-12"></div>
                                <a href="{{route('pregunta.resuelta',['preguntaId'=>$pregunta->id])}}"
                                   class="btn btn-outline-success ml-3 mb-3">Dar como resuelta</a>
                            </div>
                        @endif
                        <div class="border-bottom"></div>

                        <div class="card-body text-black-50 m-4 rounded">
                            <div>
                                {{$pregunta->descripcion}}
                            </div>
                        </div>
                        <div class="ml-3 mb-3">Preguntado por <a
                                href="{{route('user.profile',['id'=>$pregunta->user->id])}}">{{$pregunta->user->nombre}}</a>
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
                        <div class="row no-gutters">
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
                                    {{Carbon\Carbon::parse($respuesta->created_at)->locale('es')->isoFormat('LLLL')}}
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
                                                        href="{{route('user.profile',['id'=>$comentario->user_id])}}">{{$comentario->user->nombre}}</a> el </span> {{Carbon\Carbon::parse($comentario->created_at)->locale('es')->isoFormat('LLLL')}}
                                            </div>
                                        </div>
                                    @endforeach
                                    <hr>
                                    @if(Auth::user() != null)
                                        <a id="add_comment_{{$respuesta->id}}"
                                           class="add_comment btn btn-link text-primary">Añadir
                                            comentario</a>
                                        <div class="row no-gutters">
                                            <form id="formu_comentar_{{$respuesta->id}}"
                                                  action="{{route('respuesta.comentar')}}"
                                                  method="post" class="ocultar offset-1 col-10 form-group">
                                                @csrf
                                                <textarea class="form-control" name="comentario"
                                                          maxlength="191"></textarea>
                                                <div class="row no-gutters">
                                                    <input class="btn btn-primary btn-block mt-3 offset-3 col-6"
                                                           type="submit"
                                                           value="Comentar" id="comentar">
                                                </div>
                                                <input type="hidden" value="{{$respuesta->id}}" name="respuesta_id">
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        @if(Auth::user() != null)
                            <div class="no-gutters col border-top">
                                <div class="h2 mt-3">Añadir respuesta</div>
                                <form id="formu_solucionar" action="{{route('pregunta.responder')}}" method="post"
                                      class="form-group">
                                    @csrf
                                    <textarea class="form-control" name="solucion" maxlength="191"></textarea>
                                    <div class="row no-gutters">
                                        <input class="btn btn-primary btn-block mt-3 offset-3 col-6" type="submit"
                                               value="Enviar respuesta"
                                               id="solucionar">
                                    </div>
                                    <input type="hidden" value="{{$pregunta->id}}" name="pregunta_id">
                                </form>
                            </div>
                        @endif
                    </div>
            </div>
    </div>
@endsection
