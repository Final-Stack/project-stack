<?php

namespace App\Http\Controllers;

use App\Pregunta;
use App\rc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $preguntasUsuario = DB::table('preguntas')
            ->join('usuarios', 'usuarios.id', '=', 'preguntas.id_usuario')
            ->select('preguntas.titulo','preguntas.id','preguntas.visita','preguntas.updated_at','preguntas.etiquetas', 'preguntas.descripcion', 'preguntas.estado', 'usuarios.nombre')
            ->paginate(10);

        return view('index', [
            'preguntas' => $preguntasUsuario
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createQuestion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pregunta = new Pregunta();

        $pregunta->titulo = request('titulo');
        $pregunta->descripcion = request('descripcion');
        $pregunta->etiquetas = request('tag');

        $pregunta->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\rc  $rc
     * @return \Illuminate\Http\Response
     */
    public function show(rc $rc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\rc  $rc
     * @return \Illuminate\Http\Response
     */
    public function edit(rc $rc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\rc  $rc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rc $rc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\rc  $rc
     * @return \Illuminate\Http\Response
     */
    public function destroy(rc $rc)
    {
        //
    }
}
