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
    public function index()
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
    public function show()
    {
        $usuario=User::find(Auth::id());
        $preguntas=$usuario->preguntas;


        $fechaCreacion = Carbon::parse($usuario->created_at);
        $fechaActual = Carbon::now();
        $diferencia = $fechaActual->diffInDays($fechaCreacion);
        if($diferencia>360){
            $diasDiferencia = 'Miembro desde hace' . $fechaActual->diffInYears($fechaCreacion) . 'año(s)';
        }elseif ($diferencia<1){
            $diasDiferencia = "La cuenta ha sido creada hoy";
        }else{
            $diasDiferencia = 'Miembro desde hace' . $fechaActual->diffInYears($fechaCreacion) . 'dias';
        }

        return view('user_profile' , ['usuario' => $usuario , 'preguntas' => $preguntas , 'tiempo' =>$diasDiferencia]);
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
