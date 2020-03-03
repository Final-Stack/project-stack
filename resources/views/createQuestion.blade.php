@extends('layouts.layout')

@section('content')
        <form action="{{route('pregunta.store')}}" id="formulario" method="post" class="p-4 mt-5 col-sm-12 col-md-6 bg-white mx-auto align-bottom">
            @csrf
            <div class="form-group text-center">
                <h2>Formula una pregunta</h2>
            </div>
            <div class="form-group">
                <h5><strong class="">Titulo</strong></h5>
                <input type="text" class="w-100" name="titulo" required>
            </div>
            <div class="form-group">
                <h5><strong class="">Descripcion</strong></h5>
                <textarea class="w-100" name="descripcion" required></textarea>
            </div>
            <div class="form-group ">
                <h5><strong class="">Etiquetas</strong></h5>
                <input class="col-sm-12 col-md-7 col-xl-8  mr-3 mb-2" type="text" onkeyup="buscarEtiquetas()" id="tag" name="tag" required> <input class="col-sm-12 col-md-4 col-xl-3  btn btn-info" type="button" value="Añadir Etiqueta" onclick="añadirEtiqueta()">
            </div>

            <div id="tag_container" name="tag_container" class="mb-3 d-flex flex-wrap">

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
