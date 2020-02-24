
@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="main">
            <h2 class="mb-3 ">Búsqueda de usuarios</h2>

            <form method="POST" action="{{route('users.buscar')}}">
                @csrf
                <div class="w-25 search">
                    <input type="text" class="searchTerm" name="nombre" placeholder="Filtrar por  usuario">
                    <button type="submit" class="searchButton">
                        <img id="lupa" src="{{secure_asset('img/magnifying-glass.png')}}">
                    </button>

                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link"  href="{{route('users.reciente')}}">Nuevos Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link "  href="{{route('users.preguntas')}}">Con más preguntas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"  href="{{route('users.respuestas')}}">Con más respuestas</a>
                        </li>
                    </ul>
                </div>
            </form>

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
    </div>
@endsection
