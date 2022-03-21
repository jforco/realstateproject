<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\User;
use Socialite;
use Carbon\Carbon;

class SocialAuthController extends Controller
{
    //
    // Metodo encargado de la redireccion a Facebook
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }
    
    // Metodo encargado de obtener la información del usuario
    public function handleProviderCallback($provider)
    {
        // Obtenemos los datos del usuario
        $social_user = Socialite::driver($provider)->user(); 
        // Comprobamos si el usuario ya existe
        if ($user = User::where('correo', $social_user->email)->first()) { 
            return $this->authAndRedirect($user); // Login y redirección
        } else {  
            // En caso de que no exista creamos un nuevo usuario con sus datos.
            $user = new User();
            $user->nombre = $social_user->name;
            $user->correo = $social_user->email;
            //formating genre
            /*$genero = collect($social_user->user)['gender'];
            if($genero == 'male'){
            	$user->genero = 'masculino';
            } else {
            	$user->genero = 'femenino';
            }*/
            $user->genero = 'masculino';
            //formating birthday
            /*$fecha = collect($social_user->user)['birthday'];
            $user->fecha_nac = Carbon::createFromFormat('m/d/Y', $fecha);
            */
            $user->fecha_nac = Carbon::now();
            //$user->avatar = $social_user->avatar;
            $user->url_perfil = $social_user->profileUrl;
            $user->save();
            return $this->authAndRedirect($user); // Login y redirección
        }
    }
 
    // Login y redirección
    public function authAndRedirect($user)
    {
        Auth::login($user);
 
        return redirect()->to('');
    }
}
