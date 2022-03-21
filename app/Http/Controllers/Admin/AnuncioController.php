<?php

namespace App\Http\Controllers\Admin;
require '../vendor/autoload.php';
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\correoAnuncioAprobado;
use App\Jobs\correoAnuncioRechazado;
use App\Models\Publicacion;
use App\Models\Media;
use Illuminate\Support\Facades\DB;
use App\Models\Oferta;
use App\Models\Inmueble;
use App\Models\Lugar;
use App\Models\Plan;
use App\Models\Marca;
use App\Models\User;
use App\Models\PubMarca;
use Illuminate\Support\Str;
use Carbon\Carbon;
use DateTime;
use Auth;
use Illuminate\Support\Facades\Date;
use Symfony\Component\ErrorHandler\Debug;
use Khipu;

use function Psy\debug;

class AnuncioController extends Controller
{
    //
    public function index(Request $request){
        if(isset($request->nueva_ciudad)){
            
        }
        $permiso = 'Ver Anuncios';
        if(permisos::tiene($permiso)){
            

            //mostrar todos los anuncios en tabla
            $anuncios = Publicacion::orderBy('created_at', 'desc')->paginate(10);
            return view('administracion.anuncios.index', compact('anuncios'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
    }




// nueva funcion para mostrar todos y filtrar
   public function filtrar_anuncio(Request $request){
             $estado = $request->estado['$estado'];
             $cualquiera = 'todos';

          if($estado == $cualquiera){
            $media = Publicacion::get();
          }else{
            $media = Publicacion::where('estado', $estado)->get();
          }          
            return response()->json(['response' => $media]);
                
        }

    
        
    

    public function show($id){
        $permiso = 'Ver Anuncios';
        if(permisos::tiene($permiso)){
            //mostrar un anuncio especifico
            $titulo = 'Ver Anuncio';
            $anuncio = Publicacion::find($id);
            $marcas_elegidas = DB::table('publicaciones')
                        ->join('pub_marca', 'publicaciones.id', '=', 'pub_marca.id_publicacion')
                        ->join('marcas', 'pub_marca.id_marca', '=', 'marcas.id')
                        ->select('marcas.nombre')->distinct()->get();
            $media = Media::where('cod_publicacion', $anuncio->id)->get();
            $fotos = $media->where('tipo', 'imagen');
            if($anuncio->agente == 'si'){
                $vendedor = $anuncio->get_agente;
            } else {
                $vendedor = $anuncio->get_usuario;
            }
            return view('administracion.anuncios.show', compact('titulo', 'anuncio', 'marcas_elegidas', 'fotos', 'vendedor'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
    }

    public function show_editar($id){
        $permiso = 'Editar Anuncios';
        if(permisos::tiene($permiso)){
            //mostrar el formulario con datos
            $publicacion = Publicacion::find($id);
            $ofertas = Oferta::pluck('nombre');
            $inmuebles = Inmueble::pluck('nombre');
            $estados = Lugar::where('tipo', 'Estado')->get();
            $ciudades = Lugar::where('tipo', 'Ciudad')->get();
            $zonas = Lugar::where('tipo', 'Zona')->get();
            $año = date("Y");
            $marcas = Marca::all();
            $agentes = User::where('agente', 'si')->get();
            $marcas_elegidas = PubMarca::where('id_publicacion', $publicacion->id)->pluck('id_marca');
            $media = Media::where('cod_publicacion', $publicacion->codigo)->get();
            $fotos = $media->where('tipo', 'imagen');
            $videos = $media->where('tipo', 'video');
            $titulo = 'Editar Anuncio';
            return view('administracion.anuncios.edit', compact('ofertas', 'inmuebles', 'estados', 'ciudades', 'zonas', 'año', 'publicacion', 'marcas', 'agentes', 'marcas_elegidas', 'fotos', 'videos', 'titulo'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
    }

    public function editar(Request $request, $codigo){
        //actualizar la marca
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
            //video_yt
            if(isset($request->video_yt)){
                $string1 = Str::of($request->video_yt)->trim();
                $string1 = Str::of($string1)->split('/[=]+/');
                $pub->video_yt = $string1[1];
            }
            //estado y duracion
            if(isset($request->estado_pub)){
                
                if($pub->estado != $request->estado){
                    if($request->estado_pub == "aprobado" && $pub->finish_at == NULL){
                        //duracion
                        $meses = $pub->cant_dias / 30;
                        $meses = floor($meses);
                        $dias = $pub->cant_dias % 30;
                        $fecha_limite = Carbon::now();
                        $fecha_limite->addMonth($meses);
                        $fecha_limite->addDays($dias);
                        $pub->finish_at = $fecha_limite; 
                        //destacado
                        if($pub->destacado == 'si'){
                            $fecha_destacado_limite = Carbon::now();
                            $fecha_destacado_limite->addDays(15);
                            $pub->destacado_finish_at = $fecha_destacado_limite;
                        }
                   
                    }
                    $pub->estado = $request->estado_pub;
                    
                }
            }
            $pub->save();
            $correo = Publicacion::select( 'usuarios.correo')
                ->join('usuarios', 'publicaciones.id_usuario', '=', 'usuarios.id')
                ->where('publicaciones.id', $pub->id)
                ->get();
                $nombre = Publicacion::select( 'usuarios.nombre')
                ->join('usuarios', 'publicaciones.id_usuario', '=', 'usuarios.id')
                ->where('publicaciones.id', $pub->id)
                ->get();
              //  var_dump($correo);
              
              if($pub->estado=="rechazado"){
                $mensaje = $request->mensajerechazado;
                correoAnuncioRechazado::dispatch(Auth::user(),$pub,$mensaje)->onQueue('mails'); 
            }
              if($pub->estado=='aprobado'){
                correoAnuncioAprobado::dispatch(Auth::user(),$pub)->onQueue('mails'); 
              }
            
        } 
        return redirect('admin/anuncios');
    }

    public function eliminar($id){
        if(permisos::tiene('Eliminar Anuncios')){
            //eliminar el anuncio
            $anuncio = Publicacion::find($id);
            $anuncio->delete();
            return redirect('admin/anuncios');
        } else {
            $mensaje = 'No tienes los permisos necesarios para realizar esta accion.';
            return redirect('admin/anuncios')->withErrors(compact('mensaje'));
        }  
    }

}
