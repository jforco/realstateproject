<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Telefono;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Jobs\correoActivarCuenta;
use App\Jobs\correoCuentaActivada;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        //return $request;
        if($this->existe_email($request->correo)){
    		return $this->mensajeError('El correo ' . $request->correo . ' ya esta en uso.   Por favor utiliza un correo diferente.');
    	}
    	if($request->password1 != $request->password2){
    		return $this->mensajeError('Las contraseñas no coinciden.');
    	}
    	$user = new User();
    	$user->nombre = $request->nombre;
    	$user->correo = $request->correo;
    	$user->genero = $request->genero;
    	$user->password = Hash::make($request->password1);
        $user->token = Str::random(50);
        if($request->inmobiliaria){
            $user->inmobiliaria = 'si';
        } else {
            $user->inmobiliaria = 'no';
        }
    	$user->save();
        $telefono = new Telefono();
        $telefono->codigo = $request->codigo;
        $telefono->telefono = $request->telefono;
        $telefono->id_usuario = $user->id;
        
        $telefono->save();
    	Auth::login($user, true);
        //enviar correo de confirmacion
        correoActivarCuenta::dispatch($user->correo, $user->token, $user->nombre)->onQueue('mails');
        
    	return $this->mensajeError('Bienvenido! Por favor ingresa al correo de confirmación para activar tu cuenta.');
    }

    public function login(Request $request){
    	$email = $request->correo;
        $password = $request->password;
        if (Auth::attempt(['correo' => $email, 'password' => $password], true)) {
            return redirect('');
        } else {
        	return $this->mensajeError('Usuario o contraseña incorrecto!');
        }
    }

    private function existe_email($correo){
    	if($user = User::where('correo', $correo)->first()){
    		return true;
    	} else {
    		return false;
    	}
    }
    public function mensajeError($mensaje){
    	return redirect('')->withErrors(compact('mensaje'));
    }

    public function logout(){
    	Auth::logout();
		return redirect('');
    }

    public function activar($token){
        if($user = User::where('token', $token)->first()){
            $user->token = "";
            $user->save();
            //enviar correo de confirmacion
            correoCuentaActivada::dispatch($user->correo, $user->nombre)->onQueue('mails');
            return $this->mensajeError('Perfecto! tu cuenta esta activa. Ya puedes comenzar a publicar anuncios.');
        } else {
            return $this->mensajeError('url inválida.');
        }
    }

}
