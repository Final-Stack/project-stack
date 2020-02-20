@extends('layouts.layout')

@section('content')
    <form action="/" method="post">
        @csrf
        <h2>Formula una pregunta</h2>
        <strong>Titulo</strong>
        <p><input type="text" name="titulo"></p>
        <strong>Descripcion</strong>
        <p><textarea name="descripcion"></textarea></p>
        <strong>Etiquetas</strong>
        <p><input type="text" id="tag" name="tag"><input type="button" id="add_tag" value="Añadir etiqueta"></p>
        <div id="tag_container" name="tag_container">

        </div>
        <input type="hidden" id="tag_block" name="tag_block">
        <input type="submit" value="Formular pregunta">
    </form>

@endsection
