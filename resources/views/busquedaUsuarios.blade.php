
@extends('layouts.layout')

@section('content')
    <div class="container">
            <h2 class="mb-3 ">Búsqueda de usuarios</h2>
            <form method="POST" action="{{route('users.buscar')}}" class="float-left  search w-25" >
                @csrf
                <input type="text" placeholder="Filtrar por usuario" class="w-100 pl-4 mt-1 searchTerm" name="buscar">
                <svg id="lupa">
                    <path d="M18 16.5l-5.14-5.18h-.35a7 7 0 1 0-1.19 1.19v.35L16.5 18l1.5-1.5zM12 7A5 5 0 1 1 2 7a5 5 0 0 1 10 0z"></path>
                </svg>
            </form>
            <ul class="float-left w-75 nav nav-tabs pl-4 " role="tablist">
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

            <div class="row lista-usuarios ">
                @foreach($usuarios as $usuario)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                       <img class="float-left imgUsuario" src="#">
                        <div class="informacion-usuario">
                            <a href="{{route('user.profile',['id'=>$usuario->id])}}">{{$usuario->nombre}}</a>
                            <span>{{$usuario->email}}</span>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
@endsection
