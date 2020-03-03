@extends('layouts.layout')

@section('content')
    <form action="{{route('pregunta.store')}}" id="formulario" method="post"
          class="p-4 mt-5 col-6 bg-white mx-auto align-bottom shadow">
        @csrf
        <div class="form-group text-center">
            <h2>Formula una pregunta</h2>
        </div>
        <div class="form-group">
            <h5><strong>Titulo</strong></h5>
            <input type="text" class="w-100 form-control" name="titulo" required>
        </div>
        <div class="form-group">
            <h5><strong>Descripcion</strong></h5>
            <textarea class="w-100 form-control" name="descripcion" required></textarea>
        </div>
        <div class="form-group ">
            <h5><strong>Etiquetas</strong></h5>
            <div class="row">
                <input class="col-12 col-sm-5 form-control ml-3 mr-3" type="text" onkeyup="buscarEtiquetas()"
                       id="tag" name="tag" required>
                <input class="col-12 col-sm-5 btn btn-info ml-3 mr-3" type="button"
                       value="Añadir Etiqueta" onclick="añadirEtiqueta()">
            </div>
        </div>

        <div id="tag_container" class="mb-3 d-flex flex-wrap">

        </div>

        <div id="vacioContainer" class="mb-3">
            <p>No se ha encontrado ninguna etiqueta</p>
        </div>

        <div type="text" id="etiquetas" class="mb-3">

        </div>

        <input type="hidden" id="tag_block" name="tag_block">
        <div class="col text-center ">
            <input class="mt-2 btn btn-primary" type="submit" value="Formular pregunta">
        </div>
    </form>

    <!-- JS  -->
    <script src="{{secure_asset('js/etiquetas.js')}}"></script>

@endsection
