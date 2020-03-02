<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\User as u;

class GoogleController extends Controller
{
    /**
     * Lleva a la api de google para elegir cuenta de google con la que meterse.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Pilla el usuario de google y lo compara o crea en la base de datos
     * nuestra para iniciar sesion o registrarse.
     *
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $existUser = u::where('email',$user->email)->first();

            if ($existUser) {

                Auth::login($existUser);

                return redirect()->route('index');

            } else {
                $newUser = u::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('123456dummy')
                ]);

                Auth::login($newUser);

                return redirect('/home');
                */
                return "else del finduser al meterse con google ";
            }

        } catch (Exception $e) {
            dd(($e));
        }
    }
}
