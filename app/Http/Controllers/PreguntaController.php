<?php

namespace App\Http\Controllers;

use App\Pregunta;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PreguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     * Busca y devuelve todas las preguntas que hayan coincidido con el criterio dado
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $preguntas = "";

        if ($request->buscar != null) {
            $preguntas = DB::table('preguntas')
                ->join('users', 'users.id', '=', 'preguntas.user_id')
                ->select('preguntas.titulo', 'preguntas.id', 'preguntas.visita', 'preguntas.updated_at', 'preguntas.etiquetas', 'preguntas.descripcion', 'preguntas.estado', 'users.nombre')
                ->where('titulo', 'like', '%' . $request->buscar . '%')
                ->paginate(10);
        } else {
            $preguntas = DB::table('preguntas')
                ->join('users', 'users.id', '=', 'preguntas.user_id')
                ->select('preguntas.titulo', 'preguntas.id', 'preguntas.visita', 'preguntas.updated_at', 'preguntas.etiquetas', 'preguntas.descripcion', 'preguntas.estado', 'users.nombre')
                ->paginate(10);
        }



       $respuestas = DB::table('respuestas')
            ->select(DB::raw('count(*) as numRespuestas, pregunta_id'))

            ->groupBy('pregunta_id')
            ->get();

        $votos = DB::table('votos')
            ->select(DB::raw('count(*) as numVotos, pregunta_id'))
            ->groupBy('pregunta_id')
            ->get();

        return view('index', [
            'preguntas' => $preguntas,
            'respuestas' => $respuestas,
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = User::find(Auth::id());

        $pregunta = new Pregunta();

        $pregunta->titulo = request('titulo');
        $pregunta->descripcion = request('descripcion');
        $pregunta->etiquetas = request('tag_block');
        $pregunta->estado = 0;
        $pregunta->visita = 0;
        $pregunta->user_id = $usuario->id;


        $pregunta->save();

        return redirect(route('index'));
    }

    /**
     * Display the specified resource.
     *
     * @param integer $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $pregunta = Pregunta::find($id);
        // sumarle +1 a las visitas
        $pregunta->visita -= -1;
        $pregunta->save();
        $respuestas=$pregunta->respuestas;


        return view('question', [
            'pregunta' => $pregunta,
            'respuestas' => $respuestas
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\rc $rc
     * @return \Illuminate\Http\Response
     */
    public function edit(rc $rc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\rc $rc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rc $rc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\rc $rc
     * @return \Illuminate\Http\Response
     */
    public function destroy(rc $rc)
    {
        //
    }

    public function semana()
    {
        $preguntas = DB::table('preguntas')
            ->join('users', 'users.id', '=', 'preguntas.user_id')
            ->select('preguntas.titulo', 'preguntas.id', 'preguntas.visita', 'preguntas.updated_at', 'preguntas.etiquetas', 'preguntas.descripcion', 'preguntas.estado', 'users.nombre')
            ->groupBy(DB::raw('week(preguntas.created_at)'),'preguntas.id')
            ->paginate(10);

        $respuestas = DB::table('respuestas')
            ->select(DB::raw('count(*) as numRespuestas, pregunta_id'))
            ->groupBy('pregunta_id')
            ->get();

        $votos = DB::table('votos')
            ->select(DB::raw('count(*) as numVotos, pregunta_id'))
            ->groupBy('pregunta_id')
            ->get();

        return view('index', [
            'preguntas' => $preguntas,
            'respuestas' => $respuestas,
            'votos' => $votos
        ]);
    }

    public function dia()
    {
        $preguntas = DB::table('preguntas')
            ->join('users', 'users.id', '=', 'preguntas.user_id')
            ->select('preguntas.titulo', 'preguntas.id', 'preguntas.visita', 'preguntas.updated_at', 'preguntas.etiquetas', 'preguntas.descripcion', 'preguntas.estado', 'users.nombre')
            ->groupBy(DB::raw('DATE(preguntas.created_at)'),'preguntas.id')
            ->paginate(10);

        $respuestas = DB::table('respuestas')
            ->select(DB::raw('count(*) as numRespuestas, pregunta_id'))
            ->groupBy('pregunta_id')
            ->get();

        $votos = DB::table('votos')
            ->select(DB::raw('count(*) as numVotos, pregunta_id'))
            ->groupBy('pregunta_id')
            ->get();

        return view('index', [
            'preguntas' => $preguntas,
            'respuestas' => $respuestas,
            'votos' => $votos
        ]);
    }

    public function mes()
    {
        $preguntas = DB::table('preguntas')
            ->join('users', 'users.id', '=', 'preguntas.user_id')
            ->select('preguntas.titulo', 'preguntas.id', 'preguntas.visita', 'preguntas.updated_at', 'preguntas.etiquetas', 'preguntas.descripcion', 'preguntas.estado', 'users.nombre')
            ->groupBy(DB::raw('month(preguntas.created_at)'),'preguntas.id')
            ->paginate(10);

        $respuestas = DB::table('respuestas')
            ->select(DB::raw('count(*) as numRespuestas, pregunta_id'))
            ->groupBy('pregunta_id')
            ->get();

        $votos = DB::table('votos')
            ->select(DB::raw('count(*) as numVotos, pregunta_id'))
            ->groupBy('pregunta_id')
            ->get();

        return view('index', [
            'preguntas' => $preguntas,
            'respuestas' => $respuestas,
            'votos' => $votos
        ]);
    }

    public function populares()
    {
        $preguntas = DB::table('preguntas')
            ->join('users', 'users.id', '=', 'preguntas.user_id')
            ->select('preguntas.titulo', 'preguntas.id', 'preguntas.visita', 'preguntas.updated_at', 'preguntas.etiquetas', 'preguntas.descripcion', 'preguntas.estado', 'users.nombre')
            ->orderBy('preguntas.visita', 'DESC')
            ->paginate(10);

        $respuestas = DB::table('respuestas')
            ->select(DB::raw('count(*) as numRespuestas, pregunta_id'))
            ->groupBy('pregunta_id')
            ->get();

        $votos = DB::table('votos')
            ->select(DB::raw('count(*) as numVotos, pregunta_id'))
            ->groupBy('pregunta_id')
            ->get();

        return view('index', [
            'preguntas' => $preguntas,
            'respuestas' => $respuestas,
            'votos' => $votos
        ]);
    }

    public function reciente()
    {
        $preguntas = DB::table('preguntas')
            ->join('users', 'users.id', '=', 'preguntas.user_id')
            ->select('preguntas.titulo', 'preguntas.id', 'preguntas.visita', 'preguntas.updated_at', 'preguntas.etiquetas', 'preguntas.descripcion', 'preguntas.estado', 'users.nombre')
            ->orderBy('preguntas.id', 'DESC')
            ->paginate(10);

        $respuestas = DB::table('respuestas')
            ->select(DB::raw('count(*) as numRespuestas, pregunta_id'))
            ->groupBy('pregunta_id')
            ->get();

        $votos = DB::table('votos')
            ->select(DB::raw('count(*) as numVotos, pregunta_id'))
            ->groupBy('pregunta_id')
            ->get();

        return view('index', [
            'preguntas' => $preguntas,
            'respuestas' => $respuestas,
            'votos' => $votos
        ]);
    }

    public function activas()
    {
        $preguntas = DB::table('preguntas')
            ->join('users', 'users.id', '=', 'preguntas.user_id')
            ->select('preguntas.titulo', 'preguntas.id', 'preguntas.visita', 'preguntas.updated_at', 'preguntas.etiquetas', 'preguntas.descripcion', 'preguntas.estado', 'users.nombre')
            ->where('preguntas.estado', '=', 0)
            ->paginate(10);

        $respuestas = DB::table('respuestas')
            ->select(DB::raw('count(*) as numRespuestas, pregunta_id'))
            ->groupBy('pregunta_id')
            ->get();

        $votos = DB::table('votos')
            ->select(DB::raw('count(*) as numVotos, pregunta_id'))
            ->groupBy('pregunta_id')
            ->get();

        return view('index', [
            'preguntas' => $preguntas,
            'respuestas' => $respuestas,
            'votos' => $votos
        ]);
    }

    public function buscarEtiquetas(Request $request) {
        $etiqueta = request()->all()['etiqueta'];

        $etiquetas = DB::table('preguntas')
            ->select('etiquetas')
            ->where('etiquetas', 'like','%' . $etiqueta . '%')
            ->get();

        return $etiquetas;
    }
}
