<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Oferta;
use App\Models\Inmueble;
use App\Models\Lugar;
use App\Models\Publicacion;
use App\Models\Plan;
use App\Models\Marca;
use App\Models\User;
use App\Models\Media;
use App\Models\PubMarca;
use App\Models\Favorito;
use App\Models\Calificacion;
use App\Models\Codigo;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Auth;
use App\Jobs\correoAgenteElegido;
use App\Jobs\correoAnuncioGuardado;
use App\Jobs\correoContactoVendedor_user;
use App\Jobs\correoContactoVendedor_guest;
use App\Jobs\correoAdminAnuncioGuardado;
use App\Jobs\KhipuConfirmation;
use Illuminate\Support\Facades\Mail;
use App\Mail\contactoVendedor_guest;
use App\Mail\contactoVendedor_user;
use DateTime;
use App\Models\UserAdm;

use Khipu;
use Carbon\Carbon;

class AnuncioController extends Controller
{
    //
    public function ver_planes(){
        if(Auth::user()->token != ""){
            return $this->mensajeError('', 'Por favor, activa tu cuenta para publicar.   Ingresa al link que hemos enviado a tu email');
        }
        //$planes = Plan::all();
        return view('anuncios.planes');
    }

    public function plan_elegido(Request $request){
        $costos = array(
            "autorenovacion"  => 50,
            "duracion30"  => 50,
            "duracion45"  => 70,
            "duracion60"  => 90,
            "destacado"  => 100,
            "facebook"  => 50,
            "whatsapp"  => 20,
            "instagram"  => 20,
            "mailing"  => 20,
            "borde"  => 40,
            "foto"  => 250,
            "video"  => 200,
            "recorrido"  => 400,
            "agente"  => 50,
            "gratuito"  => 0,
        );
        if(Auth::user()->token != ""){
            return $this->mensajeError('', 'Por favor, activa tu cuenta para publicar.   Ingresa al link que hemos enviado a tu email');
        }
        $cantidad_dias = -1;
        $cantidad_pago = -1;
        if(isset($request->gratuito) && $request->gratuito=='on'){
            $cantidad_dias = 15;
            $cantidad_pago = 0;
        } else {
            $cantidad_dias = 0;
            $cantidad_pago = 0;
            
            foreach ($request->all() as $clave=>$valor){
                if(isset($costos[$clave]) && $valor=='on'){
                    $cantidad_pago = $cantidad_pago + $costos[$clave];

                }    
            }
            if(isset($request->duracion30) && $request->duracion30=='on'){
                $cantidad_dias = $cantidad_dias + 30;
            }
            if(isset($request->duracion45) && $request->duracion45=='on'){
                $cantidad_dias = $cantidad_dias + 45;
            }
            if(isset($request->duracion60) && $request->duracion60=='on'){
                $cantidad_dias = $cantidad_dias + 60;
            }
        }
        
        //crear nueva publicacion, con codigo de publicacion
        $publicacion = new Publicacion();
        $publicacion->id_usuario = Auth::id();
        
        if(isset($request->autorenovacion) && $request->autorenovacion=='on'){
            $publicacion->autorenovacion = "si";
        } else {
            $publicacion->autorenovacion = "no";
        }
        if(isset($request->destacado) && $request->destacado=='on'){
            $publicacion->destacado = "si";
        } else {
            $publicacion->destacado = "no";
        }
        if(isset($request->facebook) && $request->facebook=='on'){
            $publicacion->facebook = "si";
        } else {
            $publicacion->facebook = "no";
        }
        if(isset($request->instagram) && $request->instagram=='on'){
            $publicacion->instagram = "si";
        } else {
            $publicacion->instagram = "no";
        }
        if(isset($request->whatsapp) && $request->whatsapp=='on'){
            $publicacion->whatsapp = "si";
        } else {
            $publicacion->whatsapp = "no";
        }
        if(isset($request->whatsapp) && $request->whatsapp=='on'){
            $publicacion->whatsapp = "si";
        } else {
            $publicacion->whatsapp = "no";
        }
        if(isset($request->mailing) && $request->mailing=='on'){
            $publicacion->mailing = "si";
        } else {
            $publicacion->mailing = "no";
        }
        if(isset($request->borde) && $request->borde=='on'){
            $publicacion->borde = "si";
        } else {
            $publicacion->borde = "no";
        }
        if(isset($request->foto) && $request->foto=='on'){
            $publicacion->fotos_prof = "si";
        } else {
            $publicacion->fotos_prof = "no";
        }
        if(isset($request->gratuito) && $request->gratuito=='on'){
            $publicacion->cant_fotos = 5;
        } else {
            $publicacion->cant_fotos = 15;
        }
        if(isset($request->video) && $request->video=='on'){
            $publicacion->video_prof = "si";
        } else {
            $publicacion->video_prof = "no";
        }
        if(isset($request->recorrido) && $request->recorrido=='on'){
            $publicacion->recorrido_prof = "si";
        } else {
            $publicacion->recorrido_prof = "no";
        }
        if(isset($request->agente) && $request->agente=='on'){
            $publicacion->agente = "si";
        } else {
            $publicacion->agente = "no";
        }
        $publicacion->cant_dias = $cantidad_dias;
        $publicacion->cant_pago = $cantidad_pago;
        $publicacion->correo_enviado = 'no';
        $publicacion->save();
        //poner codigo segun id
        $publicacion->codigo = $this->getCode($publicacion->id);
        $publicacion->estado = "nuevo";
        
        $publicacion->save();
        return redirect('anuncios/'.$publicacion->codigo.'/editar');
    }

    public function ver_publicacion($codigo){
        $anuncio = Publicacion::where('codigo', $codigo)->firstOrFail();
        if($anuncio->estado!="aprobado"){
            //mostrar si es el dueño o el agente, o ADMIN 
            if((Auth::check() && (Auth::id() == $anuncio->id_usuario || Auth::id() == $anuncio->id_agente)) || auth('admin')->check()){
                $marcas_elegidas = DB::table('pub_marca')
                                ->join('marcas', 'pub_marca.id_marca', '=', 'marcas.id')
                                ->where('pub_marca.id_publicacion', $anuncio->id)
                                ->select('marcas.nombre')->distinct()->get();
                $media = Media::where('cod_publicacion', $anuncio->codigo)->get();
                $fotos = $media->where('tipo', 'imagen');
                if($anuncio->agente == 'si'){
                    $vendedor = $anuncio->get_agente;
                } else {
                    $vendedor = $anuncio->get_usuario;
                }
                return view('anuncios.ver', compact('anuncio', 'marcas_elegidas', 'fotos', 'vendedor'));
            } else {
                return $this->mensajeError('', 'Este anuncio aun esta en revisión y no es visible.');
            }
        } else {
            $fecha_limite = Carbon::now();
            if($anuncio->finish_at > $fecha_limite){
                $marcas_elegidas = DB::table('pub_marca')
                                ->join('marcas', 'pub_marca.id_marca', '=', 'marcas.id')
                                ->where('pub_marca.id_publicacion', $anuncio->id)
                                ->select('marcas.nombre')->distinct()->get();
                $media = Media::where('cod_publicacion', $anuncio->codigo)->get();
                $fotos = $media->where('tipo', 'imagen');
                $videos = $media->where('tipo', 'video');
                if($anuncio->agente == 'si'){
                    $vendedor = $anuncio->get_agente;
                } else {
                    $vendedor = $anuncio->get_usuario;
                }
                return view('anuncios.ver', compact('anuncio', 'marcas_elegidas', 'fotos', 'videos', 'vendedor'));    
            } else {
                return back();
            }
        }
    }

    public function editar_formulario($codigo){
        if(Auth::user()->token != ""){
            return $this->mensajeError('', 'Por favor, activa tu cuenta para publicar.   Ingresa al link que hemos enviado a tu email');
        }
        //obtener publicacion y verificar pertenencia
        $publicacion = Publicacion::where('codigo', $codigo)->firstOrFail();
        
        if($publicacion->estado == 'finalizado'){
            return redirect('');
        }else {
            if(Auth::id() == $publicacion->id_usuario || Auth::id() == $publicacion->id_agente){
                $ofertas = Oferta::pluck('nombre');
                $inmuebles = Inmueble::pluck('nombre');
                $estados = Lugar::where('tipo', 'Estado')->select('id', 'nombre', 'id_lugar')->get();
                $ciudades = Lugar::where('tipo', 'Ciudad')->select('id', 'nombre', 'id_lugar', 'posX', 'posY')->get();
                $zonas = Lugar::where('tipo', 'Zona')->select('id', 'nombre', 'id_lugar', 'posX', 'posY')->get();
                $año = date("Y");
                $marcas = Marca::all();
                $agentes = User::where('agente', 'si')->get();
                $marcas_elegidas = PubMarca::where('id_publicacion', $publicacion->id)->pluck('id_marca');
                $media = Media::where('cod_publicacion', $publicacion->codigo)->get();
                $fotos = $media->where('tipo', 'imagen');
                $videos = $media->where('tipo', 'video');
                return view('anuncios.nuevo', compact('ofertas', 'inmuebles', 'estados', 'ciudades', 'zonas', 'año', 'publicacion', 'marcas', 'agentes', 'marcas_elegidas', 'fotos', 'videos'));
            } else {
                return redirect('anuncios/'.$publicacion->codigo);
            }
        }      
    }

 	public function guardar_formulario(Request $request, $codigo){
        if(Auth::user()->token != ""){
            return $this->mensajeError('', 'Por favor, activa tu cuenta para publicar.   Ingresa al link que hemos enviado a tu email');
        }
        $pub = Publicacion::where('codigo', $codigo)->first();
        if(!empty($pub)){
            $pub->direccion = $request->direccion;
            $pub->descripcion = $request->descripcion;
            $pub->estado_inmueble = $request->estado;
            $pub->tipo_inmueble = $request->inmueble;
            $pub->tipo_oferta = $request->oferta;
            $pub->moneda = $request->moneda;
            $pub->precio = $request->precio;
            if($request->entrega == 'fecha'){
                $pub->fecha_entrega = $request->fecha_entrega;
            } 
            //estado
            $pub->estado_lugar = $request->estado_lugar;
            //ciudad
            if($request->ciudad != "none"){
                if($request->ciudad == "Otra Ciudad" && isset($request->nueva_ciudad)){
                    //guardar nueva ciudad
                    $lugar = new Lugar;
                    $lugar->nombre = $request->nueva_ciudad;
                    $lugar->posX = $request->posX;
                    $lugar->posY = $request->posY;
                    //obtener el id del lugar
                    $id_lugar_temp = Lugar::where('nombre', $pub->estado_lugar)->select('id')->firstOrFail();
                    $lugar->id_lugar = $id_lugar_temp->id;
                    $lugar->tipo = 'Ciudad';
                    $lugar->save();
                    //asignar a la publicacion 
                    $pub->ciudad = $lugar->nombre;
                } else {
                    $pub->ciudad = $request->ciudad;
                }
            }
            //zona
            if($request->zona != "none"){ 
                if($request->zona == "Otra Zona" && isset($request->nueva_zona)){
                    //guardar nueva ciudad
                    $lugar = new Lugar;
                    $lugar->nombre = $request->nueva_zona;
                    $lugar->posX = $request->posX;
                    $lugar->posY = $request->posY;
                    //obtener el id del lugar
                    $id_lugar_temp = Lugar::where('nombre', $pub->ciudad)->select('id')->firstOrFail();
                    $lugar->id_lugar = $id_lugar_temp->id;
                    $lugar->tipo = 'Zona';
                    $lugar->save();
                    //asignar a la publicacion 
                    $pub->zona = $lugar->nombre;
                } else {
                    $pub->zona = $request->zona;
                }
            } else {
                $pub->zona = '';
            }

            $pub->sup_terreno = $request->sup_terreno;
            $pub->sup_construido = $request->sup_construida;
            $pub->sup_terraza = $request->sup_terraza;
            $pub->año_construccion = $request->año;
            $pub->cant_baños = $request->baños;
            $pub->cant_dormitorios = $request->dormitorios;
            $pub->cant_parqueos = $request->parqueos; 
            $pub->cant_pisos = $request->pisos;
            if(isset($request->elevador)){
                $pub->elevador = 'si';
            } else {
                $pub->elevador = 'no';
            }
            if(isset($request->baulera)){
                $pub->baulera = 'si';
            } else {
                $pub->baulera = 'no';
            }
            if(isset($request->piscina)){
                $pub->piscina = 'si';
            } else {
                $pub->piscina = 'no';
            }
            if(isset($request->amoblado)){
                $pub->amoblado = 'si';
            } else {
                $pub->amoblado = 'no';
            }
            $pub->latitud = $request->posX;
            $pub->longitud = $request->posY;
            $pub->precision_punto = $request->precision;
            
            if(!is_null($request->portada)){
                $imagen = Media::where('original', $request->portada)
                        ->where('cod_publicacion', $pub->codigo)
                        ->where('tipo', 'imagen')->first();
                $pub->portada = $imagen->nombre;
            }
            $pub->id_agente = $request->agente;
            
            //marcas
            if(isset($request->marcas)){
                //eliminar
                PubMarca::where('id_publicacion', $pub->id)->delete();
                //insertar
                $var = collect($request->marcas);
                foreach ($var as $marca) {
                    if($marca == 'Ninguna'){
                        break;
                    }
                    $relacion = new PubMarca();
                    $relacion->id_publicacion = $pub->id;
                    $relacion->id_marca = $marca;
                    $relacion->save();
                }
            }
            
            if($pub->estado =='nuevo'&& $pub->cant_pago !=0){   
                $id = $pub->id;
                $pub->estado = 'Por pagar';
                $respuesta = self::iniciar_pago($id);
                $pub->paymentID = $respuesta->getPaymentId();
                $pub->save();  
                correoAnuncioGuardado::dispatch(Auth::user(),$pub)->onQueue('mails'); 
                if ($pub->id_agente > 0) {
                    //enviar correo al agente
                    $agente = User::find($pub->id_agente);
                    correoAgenteElegido::dispatch($agente->correo, $agente->nombre, Auth::user(), $pub)->onQueue('mails');
                }
                return redirect()->away($respuesta->getPaymentUrl());

            }else{
                $pub->estado = "pendiente";
                $pub->save(); 
                //enviar correos
                correoAnuncioGuardado::dispatch(Auth::user(),$pub)->onQueue('mails'); 
                if ($pub->id_agente > 0) {
                    //enviar correo al agente
                    $agente = User::find($pub->id_agente);
                    correoAgenteElegido::dispatch($agente->correo, $agente->nombre, Auth::user(), $pub)->onQueue('mails');
                }
            }
        } 
        return redirect('mis-anuncios');
    }

    public function iniciar_pago($id){
        $pub = Publicacion::where('id', $id)->first();
        $cantidadtotal = $pub->cant_pago;
        $detalle = 'pago de anuncio';
            //PROCESO DE PAGO
            $config = new Khipu\Configuration();
            $config->setSecret(env('KHIPU_SECRET'));
            $config->setReceiverId(env('KHIPU_RECEIVER_ID')); 
            $cliente = new Khipu\ApiClient($config);

            $khipu = new Khipu\Client\PaymentsApi($cliente);

            try {
                //datos del cliente
                $opts = array(
                    "payer_name" => "Lucasas",
                    "send_email" => false,
                    "transaction_id" => $pub->codigo,
                    "return_url" => "https://lucasas.com/pagoexitoso/".$pub->codigo,
                    "cancel_url" => "https://lucasas.com/pagocancelado",
                    //"notify_url" => "https://lucasas.com/notificacion",
                    //"notify_api_version" => "1.3"
                );
                $resp = $khipu->paymentsPost($detalle, "CLP", $cantidadtotal, $opts);
                return $resp;
                //$paymentUrl = $resp->getPaymentUrl(); // URL de cobro
                //$transaccion_id = $resp->getPaymentId(); // id de transaccion
                //return $paymentUrl;
            } catch(Exception $e) {
                echo $e->getMessage();
            }

    }        
    public function pago_exitoso($id){
        //iniciar job de verificacion
        KhipuConfirmation::dispatch($id)->onQueue('confirmation');
        return view('anuncios.pagoexitoso');
    }

    public function pago_cancelado(){
        return view('anuncios.pagocancelado');
    }

    public function notify(Request $request){
        $a = new Codigo();
        $a->nombre = implode("|",$request->all());
        $a->save();

        $receiver_id = env('KHIPU_RECEIVER_ID');
        $secret = env('KHIPU_SECRET');
        
        $notification_token = $request->notification_token; //Parámetro notification_token
        //$amount = 0;
        
        try {
            $configuration = new Khipu\Configuration();
            $configuration->setSecret($secret);
            $configuration->setReceiverId($receiver_id);
            $client = new Khipu\ApiClient($configuration);
            $payments = new Khipu\Client\PaymentsApi($client);
    
            $response = $payments->paymentsGet($notification_token);
            if ($response->getReceiverId() == $receiver_id) {
                $pub = Publicacion::where('codigo', $response->getTransactionId())->firstOrFail();
                if ($response->getStatus() == 'done' && $response->getAmount() == $pub->cant_pago) {
                    // marcar el pago como completo y entregar el bien o servicio
                    //USAR getTransactionId() PARA OBTENER PUBLICACION Y COMPARAR PRECIO
                    $pub->estado = "pendiente";
                }
            } 
        } catch (Exception $exception) {
            print_r($exception->getResponseObject());
        }
    }

    public function guardar_favorito(Request $request){
        if(Auth::check()){
            if($request->tipo == 1){
                //guardar favorito
                $favorito = new Favorito();
                $favorito->id_usuario = Auth::id();
                $favorito->id_publicacion = $request->id;
                $favorito->save();
                return response()->json(['response' => 'saved']);
            } else {
                //borrar favorito
                try{
                    $favorito = Favorito::where('id_usuario', Auth::id())
                                ->where('id_publicacion', $request->id)->firstOrFail();
                    $favorito->delete();
                    return response()->json(['response' => 'deleted']);
                } catch(ModelNotFoundException $m){
                    return response()->json(['response' => 'notFound']);
                }
            }

                
        }
        return response()->json(['response' => 'fail']);
    }

    private function getCode($id){
        //$caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
        return Str::padLeft($id, 6, "0");
    } 

    public function mensajeError($url, $mensaje){
        return redirect($url)->withErrors(compact('mensaje'));
    }

    public function validarUsuarioActivo(){
        if(Auth::user()->token != ""){
            return $this->mensajeError('', 'Por favor, activa tu cuenta para publicar.   Ingresa al link que hemos enviado a tu email');
        }
    }

    //mensaje al vendedor
    public function contactar_vendedor(Request $request){
        //return $request;
        try{
            $anuncio = Publicacion::find($request->id);
            $mensaje = $request->mensaje;
            //$mensaje = filter_var($request->mensaje, FILTER_SANITIZE_STRING);
            
            if($anuncio->id_agente > 0){
                $correo = $anuncio->get_agente->correo;
                $nombre = $anuncio->get_agente->nombre;
            } else {
                $correo = $anuncio->get_usuario->correo;
                $nombre = $anuncio->get_usuario->nombre;
            }
            if(Auth::check()){
                $user = Auth::user();
                correoContactoVendedor_user::dispatch($correo, $nombre, $anuncio, $mensaje, $user)->onQueue('mails');
            } else {
                $telefono = $request->telefono;
                correoContactoVendedor_guest::dispatch($correo, $nombre, $anuncio, $mensaje, $telefono)->onQueue('mails');
            }
            return 'exito';
        } catch(Exception $e){
            return 'fail';
        }
    }

    public function exito_publicacion(Request $request){
        $pub = Publicacion::where('codigo', $request->codigo)->firstOrFail();
        if($pub->estado == 'aprobado'){
            $pub->estado = 'vendido';
            $pub->save();
            $pub->delete();
        }
        if($request->vista == 'usuario'){
            return redirect('mis-anuncios');
        } else if($request->vista == 'agente'){
            return redirect('mis-anuncios-agente');
        } else {
            return redirect('');
        }
    }

    public function eliminar_publicacion(Request $request){
        $pub = Publicacion::where('codigo', $request->codigo)->firstOrFail();
        $pub->delete();
        if($request->vista == 'usuario'){
            return redirect('mis-anuncios');
        } else if($request->vista == 'agente'){
            return redirect('mis-anuncios-agente');
        } else {
            return redirect('');
        }
    }

    public function calificar_agente(Request $request){
        $anuncio = Publicacion::where('codigo', $request->codigo)->first();

        if($anuncio->id_agente > 0){
            //hacer todo
            $agente = User::find($anuncio->id_agente);
            if($anuncio->calificado == 'si'){
                //eliminar anterior
                $model1 = Calificacion::where('id_usuario', $request->usuario)
                            ->where('id_agente', $request->agente)
                            ->where('cod_anuncio', $request->codigo)->first();
                $model1->delete();
            } else { 
                //cambiar estado de anuncio
                $anuncio->calificado = 'si';
                $anuncio->save();
            }

            //insertarlo
            $calif = new Calificacion();
            $calif->id_usuario = $request->usuario;
            $calif->id_agente = $request->agente;
            $calif->cod_anuncio = $request->codigo;
            $calif->puntaje = $request->puntaje;
            $calif->comentario = filter_var($request->comentario, FILTER_SANITIZE_STRING);
            $calif->save();

            //actualizar datos 
            $calificaciones = Calificacion::where('id_agente', $request->agente)->get();
            $agente->cant_puntajes = $calificaciones->count();
            $agente->puntaje_promedio = $calificaciones->sum('puntaje') / $agente->cant_puntajes;
            $agente->save();
        }
            
        return redirect('mis-anuncios');
    }

}