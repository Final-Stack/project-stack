<?php

namespace App\Http\Controllers;

use App\Pregunta;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->buscar != null) {
            $usuarios = DB::table('users')
                ->where('nombre', 'like', '%' . $request->nombre . '%')
                ->get();
        } else {
            $usuarios = User::all();
        }

        return view('busquedaUsuarios', [
            'usuarios' => $usuarios
        ]);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\rc $rc
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $usuario = User::find(Auth::id());
        $preguntas = $usuario->preguntas;

        $fechaCreacion = Carbon::parse($usuario->created_at);
        $fechaActual = Carbon::now();
        $diferencia = $fechaActual->diffInDays($fechaCreacion);

        switch ($diferencia) {
            case $diferencia = 0:
                $diasDiferencia = "La cuenta ha sido creada hoy";
                break;
            case $diferencia < 1 && $diferencia < 360;
                $diasDiferencia = 'Miembro desde hace ' . $fechaActual->diffInYears($fechaCreacion) . ' dias';
                break;
            case $diferencia > 360:
                $diasDiferencia = 'Miembro desde hace ' . $fechaActual->diffInYears($fechaCreacion) . ' año(s)';
                break;
        }


        return view('user_profile', ['usuario' => $usuario, 'preguntas' => $preguntas, 'tiempo' => $diasDiferencia]);
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
        $usuario = User::find($id);

        $usuario->biografia = request('biografia');

        $usuario->update();

        return redirect(route('index'));
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

    public function reciente()
    {
        $usuarios = DB::table('users')
            ->orderBy('created_at', 'ASC')
            ->get();

        return view('busquedaUsuarios', [
            'usuarios' => $usuarios
        ]);
    }

    public function preguntas()
    {
        $usuarios = DB::table('users')
            ->join('preguntas', 'preguntas.user_id', '=', 'users.id')
            ->select(DB::raw('count(preguntas.id)'), 'users.id', 'users.nombre', 'users.email', 'users.url_foto')
            ->orderBy(DB::raw('count(preguntas.id)'), 'ASC')
            ->groupBy('users.id')
            ->get();

        return view('busquedaUsuarios', [
            'usuarios' => $usuarios
        ]);
    }

    public function respuestas()
    {
        $usuarios = DB::table('users')
            ->join('respuestas', 'respuestas.user_id', '=', 'users.id')
            ->select(DB::raw('count(respuestas.id)'), 'users.id', 'users.nombre', 'users.email', 'users.url_foto')
            ->orderBy(DB::raw('count(respuestas.id)'), 'ASC')
            ->groupBy('users.id')
            ->get();

        return view('busquedaUsuarios', [
            'usuarios' => $usuarios
        ]);
    }

    /**
     * Funcion que se devuelve una tupla de la tabla favoritos si coincide con los parametros pasados
     *
     * @param int $idUsuario
     * @param int $idPregunta
     * @return \Illuminate\Support\Collection
     */
    public function getFavorito(int $idUsuario, int $idPregunta)
    {
        /* DB::select("Select * from favoritos where id_usuario = " . $idUsuario . " AND id_pregunta = " . $idPregunta)
         ->get();
        */
        $fav = DB::table('favoritos')
            ->select("*")
            ->where('id_usuario', "=", $idUsuario, "and")
            ->where('id_pregunta', "=", $idPregunta)
            ->get();
        $favorito = null;

        if ($fav == null || sizeof($fav) <= 0) {
            return "";
        } else {
            return $fav;
        }
    }

    /**
     * Funcion que sube pone un nuevo favorito a unn usuario sobre una pregunta
     *
     * @param int $idUsuario
     * @param int $idPregunta
     * @return \Exception|string
     */
    public function setFavorito(int $idUsuario, int $idPregunta)
    {
        try {
            DB::table('favoritos')->insert(
                ['id_usuario' => $idUsuario, 'id_pregunta' => $idPregunta]
            );
            return 'correcto';
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Borrar el favorito
     *
     * @param int $idUsuario
     * @param int $idPregunta
     * @return \Exception|string
     */
    public function unsetFavorito(int $idUsuario, int $idPregunta)
    {
        try {
            DB::table('favoritos')->where('id_usuario', '=', $idUsuario, 'and')
                ->where('id_pregunta', '=', $idPregunta)
                ->delete();
            return 'correcto';
        } catch (\Exception $e) {
            return $e;
        }
    }
}
