<?php

namespace App\Http\Controllers;

use App\Pregunta;
use App\rc;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        $preguntas = DB::table('preguntas')
            ->join('users', 'users.id', '=', 'preguntas.id_usuario')
            ->select('preguntas.titulo','preguntas.id','preguntas.visita','preguntas.updated_at','preguntas.etiquetas', 'preguntas.descripcion', 'preguntas.estado', 'users.nombre')
            ->paginate(10);

        $respuestas = DB::table('respuestas')
            ->select(DB::raw('count(*) as numPreguntas, id_pregunta'))
            ->groupBy('id_pregunta')
            ->get();

        $votos = DB::table('votos')
            ->select(DB::raw('count(*) as numVotos, id_pregunta'))
            ->groupBy('id_pregunta')
            ->get();

        return view('index', [
            'preguntas' => $preguntas,
            'respuestas' =>$respuestas,
            'votos' => $votos
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
        //
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

    public function semana() {
        $preguntas = DB::table('preguntas')
            ->join('users', 'users.id', '=', 'preguntas.id_usuario')
            ->select('preguntas.titulo','preguntas.id','preguntas.visita','preguntas.updated_at','preguntas.etiquetas', 'preguntas.descripcion', 'preguntas.estado', 'users.nombre')
            ->where('preguntas.created_at', '>', Carbon::now()->startOfWeek())
            ->where('preguntas.created_at', '<', Carbon::now()->endOfWeek())
            ->paginate(10);

        $respuestas = DB::table('respuestas')
            ->select(DB::raw('count(*) as numPreguntas, id_pregunta'))
            ->groupBy('id_pregunta')
            ->get();

        $votos = DB::table('votos')
            ->select(DB::raw('count(*) as numVotos, id_pregunta'))
            ->groupBy('id_pregunta')
            ->get();

        return view('index', [
            'preguntas' => $preguntas,
            'respuestas' =>$respuestas,
            'votos' => $votos
        ]);
    }

    public function dia() {
        $preguntas = DB::table('preguntas')
            ->join('users', 'users.id', '=', 'preguntas.id_usuario')
            ->select('preguntas.titulo','preguntas.id','preguntas.visita','preguntas.updated_at','preguntas.etiquetas', 'preguntas.descripcion', 'preguntas.estado', 'users.nombre')
            ->whereDate('preguntas.created_at', Carbon::today())
            ->paginate(10);

        $respuestas = DB::table('respuestas')
            ->select(DB::raw('count(*) as numPreguntas, id_pregunta'))
            ->groupBy('id_pregunta')
            ->get();

        $votos = DB::table('votos')
            ->select(DB::raw('count(*) as numVotos, id_pregunta'))
            ->groupBy('id_pregunta')
            ->get();

        return view('index', [
            'preguntas' => $preguntas,
            'respuestas' =>$respuestas,
            'votos' => $votos
        ]);
    }

    public function mes() {
        $preguntas = DB::table('preguntas')
            ->join('users', 'users.id', '=', 'preguntas.id_usuario')
            ->select('preguntas.titulo','preguntas.id','preguntas.visita','preguntas.updated_at','preguntas.etiquetas', 'preguntas.descripcion', 'preguntas.estado', 'users.nombre')
            ->whereMonth('preguntas.created_at', '=', Carbon::now()->month)
            ->paginate(10);

        $respuestas = DB::table('respuestas')
            ->select(DB::raw('count(*) as numPreguntas, id_pregunta'))
            ->groupBy('id_pregunta')
            ->get();

        $votos = DB::table('votos')
            ->select(DB::raw('count(*) as numVotos, id_pregunta'))
            ->groupBy('id_pregunta')
            ->get();

        return view('index', [
            'preguntas' => $preguntas,
            'respuestas' =>$respuestas,
            'votos' => $votos
        ]);
    }

    public function populares() {
        $preguntas = DB::table('preguntas')
            ->join('users', 'users.id', '=', 'preguntas.id_usuario')
            ->select('preguntas.titulo','preguntas.id','preguntas.visita','preguntas.updated_at','preguntas.etiquetas', 'preguntas.descripcion', 'preguntas.estado', 'users.nombre')
            ->orderBy('preguntas.visita','DESC')
            ->paginate(10);

        $respuestas = DB::table('respuestas')
            ->select(DB::raw('count(*) as numPreguntas, id_pregunta'))
            ->groupBy('id_pregunta')
            ->get();

        $votos = DB::table('votos')
            ->select(DB::raw('count(*) as numVotos, id_pregunta'))
            ->groupBy('id_pregunta')
            ->get();

        return view('index', [
            'preguntas' => $preguntas,
            'respuestas' =>$respuestas,
            'votos' => $votos
        ]);
    }

    public function reciente() {
        $preguntas = DB::table('preguntas')
            ->join('users', 'users.id', '=', 'preguntas.id_usuario')
            ->select('preguntas.titulo','preguntas.id','preguntas.visita','preguntas.updated_at','preguntas.etiquetas', 'preguntas.descripcion', 'preguntas.estado', 'users.nombre')
            ->orderBy('preguntas.id','DESC')
            ->paginate(10);

        $respuestas = DB::table('respuestas')
            ->select(DB::raw('count(*) as numPreguntas, id_pregunta'))
            ->groupBy('id_pregunta')
            ->get();

        $votos = DB::table('votos')
            ->select(DB::raw('count(*) as numVotos, id_pregunta'))
            ->groupBy('id_pregunta')
            ->get();

        return view('index', [
            'preguntas' => $preguntas,
            'respuestas' =>$respuestas,
            'votos' => $votos
        ]);
    }

    public function activas() {
        $preguntas = DB::table('preguntas')
            ->join('users', 'users.id', '=', 'preguntas.id_usuario')
            ->select('preguntas.titulo','preguntas.id','preguntas.visita','preguntas.updated_at','preguntas.etiquetas', 'preguntas.descripcion', 'preguntas.estado', 'users.nombre')
            ->where('preguntas.estado','=', 1)
            ->paginate(10);

        $respuestas = DB::table('respuestas')
            ->select(DB::raw('count(*) as numPreguntas, id_pregunta'))
            ->groupBy('id_pregunta')
            ->get();

        $votos = DB::table('votos')
            ->select(DB::raw('count(*) as numVotos, id_pregunta'))
            ->groupBy('id_pregunta')
            ->get();

        return view('index', [
            'preguntas' => $preguntas,
            'respuestas' =>$respuestas,
            'votos' => $votos
        ]);
    }
}
