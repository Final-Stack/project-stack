
@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="main">
            <h2 class="mb-3 ">Búsqueda de usuarios</h2>

            <form method="POST" action="buscarUsuario">
                @csrf

                <div class="w-25 search">
                    <input type="text" class="searchTerm" name="buscar" placeholder="Filtrar por  usuario">
                    <button type="submit" class="searchButton">
                        <img id="lupa" src="{{secure_asset('img/magnifying-glass.png')}}">
                    </button>
                </div>
            </form>

        </div>
    </div>
@endsection
