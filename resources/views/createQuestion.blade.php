@extends('layout')

@section('content')
    <form action="/">
        @csrf
        <h2>Formula una pregunta</h2>
        <strong>Titulo</strong>
        <p><input type="text"></p>
        <strong>Descripcion</strong>
        <p><textarea></textarea></p>
        <strong>Etiquetas</strong>
        <p><input type="text" id="tag"><input type="button" id="add_tag" value="Añadir etiqueta"></p>
        <div id="tag_container">

        </div>
        <input type="submit" value="Formular pregunta">
    </form>

@endsection
