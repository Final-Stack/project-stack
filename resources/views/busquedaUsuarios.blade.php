
@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row p-2 mb-3">
            <h2 class="mb-3 col-12">Búsqueda de usuarios</h2>
            <form method="POST" action="{{route('users.buscar')}}" class="col-4 search " >
                @csrf
                <input type="text" placeholder="Filtrar por usuario" class="w-100 pl-4 mt-1 searchTerm" name="buscar">
                <svg id="lupa">
                    <path d="M18 16.5l-5.14-5.18h-.35a7 7 0 1 0-1.19 1.19v.35L16.5 18l1.5-1.5zM12 7A5 5 0 1 1 2 7a5 5 0 0 1 10 0z"></path>
                </svg>
            </form>
            <ul class="col-8 nav pl-4 " role="tablist">
                <li class="nav-item ">
                    <a class="nav-link"  href="{{route('users.reciente')}}">Nuevos Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-right"  href="{{route('users.preguntas')}}">Con más preguntas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{route('users.respuestas')}}">Con más respuestas</a>
                </li>
            </ul>
        </div>

        <div class="lista-usuarios ">
            @foreach($usuarios as $usuario)
                <div class="">
                    <img class="imgUsuario float-left m-2" src="#">
                    <div style="width: 100% ;">
                        <a class="d-block" href="{{route('user.profile',['id'=>$usuario->id])}}">{{$usuario->nombre}}</a>
                        <span class="d-block" style="font-size: 12px;">{{$usuario->email}}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
