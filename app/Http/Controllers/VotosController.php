<?php

namespace App\Http\Controllers;

use App\Voto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class VotosController extends Controller
{
    /**
     * Devuelve el total de votos dado una id de pregunta
     *
     * @param int $preguntaId
     * @return mixed
     */
    public function countAllByPreguntaId(int $preguntaId)
    {

        $votos = Voto::where('pregunta_id', $preguntaId)->count();

        return $votos;
    }

    /**
     * Votar o quitar el voto dado el usuario y el id pregunta
     *
     * @param string $accion
     * @param int $idUsuario
     * @param int $idPregunta
     * @return mixed
     */
    public function votacion(string $accion, int $idUsuario, int $idPregunta)
    {
        $existeVoto = DB::table('votos')
            ->select(DB::raw('*'))
            ->where('user_id', '=', $idUsuario, 'and')
            ->where('pregunta_id', '=', $idPregunta)
            ->get();

        switch ($accion) {
            case"mas":
                if (sizeof($existeVoto) == 0) {
                    // no tiene voto esta persona, hay que votar
                    $voto = new Voto;
                    $voto->pregunta_id = $idPregunta;
                    $voto->user_id = $idUsuario;
                    $voto->save();

                } // else-> tiene voto esta persona, no se hace nada
                break;
            case "menos":
                if (sizeof($existeVoto) > 0) {
                    // tiene voto esta persona, hay que quitar voto
                    DB::table('votos')
                        ->where('user_id', '=', $idUsuario, 'and')
                        ->where('pregunta_id', '=', $idPregunta)
                        ->delete();

                } // else->no tiene voto esta persona, no se hace nada
                break;
        }
        // luego se devuelve el total de votos
        return $this->countAllByPreguntaId($idPregunta);
    }

    public function getVoto(int $idUsuario, int $idPregunta)
    {
        $existeVoto = DB::table('votos')
            ->select(DB::raw('*'))
            ->where('user_id', '=', $idUsuario, 'and')
            ->where('pregunta_id', '=', $idPregunta)
            ->get();
        return $this->countAllByPreguntaId($idPregunta);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $comentario = new Comentario();

        $comentario->descripcion = request('comentario');
        $comentario->respuesta_id = request('respuesta_id');
        $comentario->user_id = Auth::user()->id;

        $comentario->save();

        // al guardar refrescar la pagina
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\rc $rc
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
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
    public function update(Request $request, $id)
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
}
