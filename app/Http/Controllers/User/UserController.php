<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Telefono;
use App\Models\Publicacion;
use App\Models\Calificacion;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use App\Jobs\correoRecuperarPassword;
use App\Jobs\correoContacto;

class UserController extends Controller
{
    //
    public function contacto(){
    	return view('contacto');
    }
    public function contacto_process(Request $request){
      define("CLAVE_SECRETA", "6LeBmxEdAAAAAJpokUzUPeXnHU3Vbr_6If8jmEIe");
        
          # Comprobamos si enviaron el dato
          if (!isset($_POST["g-recaptcha-response"]) || empty($_POST["g-recaptcha-response"])) {
             
              $mensaje = "Debes completar el captcha";
              return redirect('contacto')->withErrors(compact('mensaje'));
          }

          
          $token = $_POST["g-recaptcha-response"];
          $verificado = $this->verificarToken($token, CLAVE_SECRETA);
          # Si no ha pasado la prueba
          if ($verificado) {
             
              correoContacto::dispatch($request->nombre, $request->correo, $request->mensaje)->onQueue('mails');
              $mensaje = "Tu mensaje se ha enviado correctamente. Nos contactaremos contigo lo antes posible";
              return redirect('')->withErrors(compact('mensaje'));
              
          } else {
            $mensaje = "Lo siento, parece que eres un robot";
            return redirect('contacto')->withErrors(compact('mensaje'));
              
          }
           
              
    }

   public function verificarToken($token, $claveSecreta)
            {
                // La api en donde verificamos el token
                $url = "https://www.google.com/recaptcha/api/siteverify";
               
                $datos = [
                    "secret" => $claveSecreta,
                    "response" => $token,
                ];
                // Crear opciones de la petición HTTP
                $opciones = array(
                    "http" => array(
                        "header" => "Content-type: application/x-www-form-urlencoded\r\n",
                        "method" => "POST",
                        "content" => http_build_query($datos), 
                    ),
                );
                # Preparar petición
                $contexto = stream_context_create($opciones);
                # Hacerla
                $resultado = file_get_contents($url, false, $contexto);
                
                if ($resultado === false) {
                    # Error haciendo petición
                    return false;
                }

              

                $resultado = json_decode($resultado);
                
                # está en exito
                $pruebaPasada = $resultado->success;
                
                return $pruebaPasada;
            }

    public function perfil(){
    	$user = Auth::user();
    	return view('user.perfil', compact('user'));
    }


 


    public function mis_anuncios(){
      $activos = Publicacion::where('id_usuario', Auth::id())
                  ->where('estado', 'aprobado')->simplePaginate(4, ['*'], 'aprobados_page');
      $activosCount = Publicacion::where('id_usuario', Auth::id())
                  ->where('estado', 'aprobado')->count();

      $pendientes = Publicacion::where('id_usuario', Auth::id())
                  ->where('estado', 'pendiente')->simplePaginate(4, ['*'], 'pendientes_page');
      $pendientesCount = Publicacion::where('id_usuario', Auth::id())
                  ->where('estado', 'pendiente')->count();

      $rechazados = Publicacion::where('id_usuario', Auth::id())
                  ->where('estado', 'rechazado')->simplePaginate(4, ['*'], 'rechazados_page');
      $rechazadosCount = Publicacion::where('id_usuario', Auth::id())
                  ->where('estado', 'rechazado')->count();

      $finalizados = Publicacion::withTrashed()->where('id_usuario', Auth::id())
                  ->whereNotNull('deleted_at')->simplePaginate(4, ['*'], 'finalizados_page');
      $finalizadosCount = Publicacion::withTrashed()->where('id_usuario', Auth::id())
                  ->whereNotNull('deleted_at')->count();
                  
      $nuevos = Publicacion::where('id_usuario', Auth::id())
                  ->where('estado', 'nuevo')->simplePaginate(4, ['*'], 'nuevos_page');
      $nuevosCount = Publicacion::where('id_usuario', Auth::id())
                  ->where('estado', 'nuevo')->count();            
     
      $flag = false;
      return view('user.mis-anuncios', compact('activos', 'pendientes', 'rechazados', 'finalizados','nuevos','nuevosCount', 'activosCount', 'pendientesCount', 'rechazadosCount', 'finalizadosCount', 'flag'));
    } 

    public function mis_anuncios_agente(){
      if(Auth::user()->agente == 'no'){
        return redirect('mis-anuncios');
      }
      $activos = Publicacion::where('id_agente', Auth::id())
                  ->where('estado', 'aprobado')->simplePaginate(4, ['*'], 'aprobados_page');
      $activosCount = Publicacion::where('id_agente', Auth::id())
                  ->where('estado', 'aprobado')->count();

      $pendientes = Publicacion::where('id_agente', Auth::id())
                  ->where('estado', 'pendiente')->simplePaginate(4, ['*'], 'pendientes_page');
      $pendientesCount = Publicacion::where('id_agente', Auth::id())
                  ->where('estado', 'pendiente')->count();

      $rechazados = Publicacion::where('id_agente', Auth::id())
                  ->where('estado', 'rechazado')->simplePaginate(4, ['*'], 'rechazados_page');
      $rechazadosCount = Publicacion::where('id_agente', Auth::id())
                  ->where('estado', 'rechazado')->count();

      $finalizados = Publicacion::withTrashed()->where('id_agente', Auth::id())
                  ->whereNotNull('deleted_at')->simplePaginate(4, ['*'], 'finalizados_page');
      $finalizadosCount = Publicacion::withTrashed()->where('id_agente', Auth::id())
                  ->whereNotNull('deleted_at')->count();

      $flag = true;
                  
      return view('user.mis-anuncios', compact('activos', 'pendientes', 'rechazados', 'finalizados', 'activosCount', 'pendientesCount', 'rechazadosCount', 'finalizadosCount', 'flag'));
    }

    public function mis_favoritos(){
      $anuncios = Auth::user()->favoritos()
                    ->paginate(6);
      return view('user.favoritos', compact('anuncios'));
    }

    public function editar(Request $request){
    	//return $request;
      $user = User::find($request->id);
    	$user->nombre = $request->nombre;
    	$user->genero = $request->genero;
    	if(isset($request->agente)){
    		$user->agente = $request->agente;
    	} else {
    		$user->agente = 'no';
    	}
    	$user->save();

      //guardar telefonos
      Telefono::where('id_usuario', $user->id)->delete();

      if(isset($request->telefonos)){
        $i = 0;
        foreach ($request->telefonos as $tel) {
          if(!is_null($tel)){
            $telefono = new Telefono();
            $telefono->telefono = $tel;
            $telefono->codigo = $request->codigos[$i];
            $telefono->id_usuario = $user->id;
            $telefono->save();

            $i++;
          }
            
        }
      }

    	return redirect('perfil');
    }

    public function cambiarContra(Request $request){
    	$user = User::find($request->id);
    	if (Hash::check($request->password1, $user->password)) {
    		if($request->password2 == $request->password3){
    			$user->password = Hash::make($request->password2);
    			$user->save();
    			return $this->mensajeError('perfil', 'Contraseña cambiada con éxito');
    		} else {
    			return $this->mensajeError('perfil', 'Las nuevas contraseñas no coinciden. Por favor, intenta de nuevo.');
    		}
		} else {
			return $this->mensajeError('perfil', 'Esa no es su contraseña actual.   Ingrese su contraseña actual para realizar el cambio.');
		}
   	}

   	public function cambiarAvatar(Request $request){
   		$this->validate($request, [
   			'avatar' => 'required|image'
   		]);
    	$user = User::find($request->id);
    	$extension = $request->file('avatar')->getClientOriginalExtension();
    	$imagen = Image::make($request->file('avatar'));
    	if($imagen->height()<=$imagen->width()){
    		$imagen->crop($imagen->height(), $imagen->height());
    	} else {
    		$imagen->crop($imagen->width(), $imagen->width());
    	}
      
    	$imagen->resize(150, 150);
    	$direccion = 'img/profiles/'.$user->id.'.'.$extension;
    	$imagen->save($direccion);
    	$user->avatar = $direccion;
    	$user->save();
    	return redirect('perfil');
   	}

   	public function recuperacion_ver(){
   		return view('user.recuperarContra.recuperacion_vista');
   	}

   	public function recuperacion_enviar(Request $request){
   		if($user = User::where('correo', $request->correo)->first()){
   			//enviar correo
   			$user->token = Str::random(45);
   			$user->save();
   			correoRecuperarPassword::dispatch($user)->onQueue('mails');

        $mensajeExito = 'Se ha enviado un correo para re establecer tu contraseña a la dirección proporcionada. Por favor accede a tu correo e ingresa al último e-mail que te enviamos.';
        return $this->mensajeError('recuperar_contra', $mensajeExito);
   		}
   		$mensajeError = 'Este correo no pertenece a ningun Usuario.';
      return $this->mensajeError('recuperar_contra', $mensajeError);
   	}

   	public function recuperacion_nuevo_password($token){
   		if($user = User::where('token', $token)->first()){
   			return view('user.recuperarContra.nuevoPassword', compact('token'));
   		} else {
   			return $this->mensajeError('', 'url inválida.');
   		}
   	}

   	public function recuperacion_confirmacion(Request $request){
   		if($user = User::where('token', $request->token)->first()){
   			if($request->password1 == $request->password2){
   				$user->password = Hash::make($request->password2);
   				$user->token = '';
    			$user->save();
    			return $this->mensajeError('', 'Contraseña cambiada con éxito');
   			} else {
   				return $this->mensajeError('', 'Las contraseñas no coinciden.');
   			}

   		} else {
			return $this->mensajeError('', 'url inválida.');
   		}
   	}

    public function registrarAgente(){
      $user = Auth::user();
      $user->agente = 'si';
      $user->save();
      return redirect('perfil');
    }

    public function eliminarRegistroAgente(){
      $user = Auth::user();
      $user->agente = 'no';
      $user->save();
      return redirect('perfil');
    }
   	public function mensajeError($url, $mensaje){
    	return redirect($url)->withErrors(compact('mensaje'));
    }

    public function eliminarCuenta(){
      $user = Auth::user();
      $user->delete();
      return redirect('');
    }

    public function ver_agente($id){
      $agente = User::find($id);
      if($agente->agente == 'si'){
        $anuncios = Publicacion::where('id_agente', $agente->id)
                    ->where('estado', 'aprobado')->take(10)->get();
        $reviews = Calificacion::where('id_agente', $agente->id)->get();
        return view('user.agente', compact('agente', 'anuncios', 'reviews'));
      } else {
        return $this->mensajeError('', 'Este usuario no es agente.');
      }
    }

}
