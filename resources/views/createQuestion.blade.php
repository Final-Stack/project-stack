@extends('layouts.layout')

@section('content')
    <div class="container">
        <form action="{{route('pregunta.store')}}" method="post">
            @csrf
            <div class="form-group">
                <h2>Formula una pregunta</h2>
            </div>
            <div class="form-group">
                <strong>Titulo</strong> <br>
                <input type="text" name="titulo">
            </div>
            <div class="form-group">
                <strong>Descripcion</strong> <br>
                <textarea name="descripcion"></textarea>
            </div>
            <div class="form-group">
                <strong>Etiquetas</strong> <br>
                <input type="text" onkeyup="buscarEtiquetas()" id="tag" name="tag"> <input type="button" value="Añadir Etiqueta" onclick="añadirEtiqueta()">
            </div>

            <div id="tag_container" name="tag_container" class="mb-3">

            </div>

            <div id="vacioContainer" class="mb-3">
                <p>No se ha encontrado ninguna etiqueta</p>
            </div>

            <div type="text" id="etiquetas" class="mb-3">

            </div>

            <input type="hidden" id="tag_block" name="tag_block">
            <input type="submit" value="Formular pregunta">
        </form>
    </div>


@endsection
