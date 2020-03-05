@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row p-2 mb-3">
            <h2 class="mb-3 col-12">Búsqueda de usuarios</h2>
            <form method="POST" action="{{route('users.buscar')}}" class="col-12 col-sm-4 search ">
                @csrf
                <input type="text" placeholder="Filtrar por usuario" class="w-100 pl-3 mt-1 searchTerm" name="buscar">
            </form>
            <ul class="col-8 nav pl-4 " role="tablist">
                <li class="nav-item ">
                    <a class="nav-link" href="{{route('users.reciente')}}">Nuevos Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-right" href="{{route('users.preguntas')}}">Con más preguntas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('users.respuestas')}}">Con más respuestas</a>
                </li>
            </ul>
        </div>

        <div class="lista-usuarios">
            @foreach($usuarios as $usuario)
                <div class="col border">
                    @if($usuario->google_id == null)
                        <img class="imgUsuario float-left m-2" src="{{secure_asset($usuario->url_foto)}}">
                    @else
                        <img class="imgUsuario float-left m-2" src="{{($usuario->url_foto)}}">
                    @endif
                    <div style="width: 100% ;">
                        <a class="d-block"
                           href="{{route('user.profile',['id'=>$usuario->id])}}">{{$usuario->nombre}}</a>
                        <span class="d-block" style="font-size: 12px;">{{$usuario->email}}</span>
                    </div>
                </div>
            @endforeach
        </div>
        {{$usuarios->links()}}
    </div>
@endsection
