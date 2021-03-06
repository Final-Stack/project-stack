<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\User;

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

            $existUser = User::where('email', $user->email)->first();

            if ($existUser) {

                Auth::login($existUser);

                return redirect()->route('index');

            } else {
                // create a new user
                $newUser = new User;
                $newUser->nombre = $user->name;
                $newUser->email = $user->email;
                $newUser->google_id = $user->id;
                $newUser->password = Hash::make('123');
                $newUser->url_foto = $user->avatar;
                $newUser->sector_donde_trabaja = 'S-1';
                $newUser->save();
                Auth::login($newUser);

                return redirect()->route('index');

            }

        } catch (Exception $e) {
            dd(($e));
        }
    }
}
