<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
use App\Jobs\correoAnuncioAprobado;
use App\Jobs\correoAnuncioRechazado;

class AnuncioPendienteController extends Controller
{
    //
    public function index(){
        $permiso = 'Ver Anuncios Pendientes';
        if(permisos::tiene($permiso)){
            //mostrar todos los anuncios en tabla
            $anuncios = Publicacion::where('estado', 'pendiente')->orderBy('created_at', 'desc')->paginate(10);
            return view('administracion.anuncios_pendientes.index', compact('anuncios'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
    }

    public function show($id){
        $permiso = 'Ver Anuncios Pendientes';
        if(permisos::tiene($permiso)){
            //mostrar un anuncio especifico
            $titulo = 'Ver Anuncio Pendiente';
            $anuncio = Publicacion::where('id', $id)
                        ->where('estado', 'pendiente')->firstOrFail();
            $marcas = DB::table('publicaciones')
                        ->join('pub_marca', 'publicaciones.id', '=', 'pub_marca.id_publicacion')
                        ->join('marcas', 'pub_marca.id_marca', '=', 'marcas.id')
                        ->select('marcas.nombre')->distinct()->get();
            $media = Media::where('cod_publicacion', $anuncio->id)->get();
            $fotos = $media->where('tipo', 'imagen');
            $videos = $media->where('tipo', 'video');
            return view('administracion.anuncios_pendientes.show', compact('titulo', 'anuncio', 'marcas', 'fotos', 'videos'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
    }

    public function show_editar($id){
        $permiso = 'Editar Anuncios Pendientes';
        if(permisos::tiene($permiso)){
            //mostrar el formulario con datos
            $publicacion = Publicacion::where('id', $id)
                        ->where('estado', 'pendiente')->firstOrFail();
            $ofertas = Oferta::pluck('nombre');
            $inmuebles = Inmueble::pluck('nombre');
            //$lugar = Lugar::all();
            $estados = Lugar::where('tipo', 'Estado')->get();
            $ciudades = Lugar::where('tipo', 'Ciudad')->get();
            $zonas = Lugar::where('tipo', 'Zona')->get();
            $año = date("Y");
            $marcas = Marca::all();
            $agentes = User::where('agente', 'si')->get();
            $marcas_elegidas = PubMarca::where('id_publicacion', $publicacion->id)->pluck('id_marca');
            $media = Media::where('cod_publicacion', $publicacion->id)->get();
            $fotos = $media->where('tipo', 'imagen');
            $videos = $media->where('tipo', 'video');
            $titulo = 'Editar Anuncio Pendiente';
            return view('administracion.anuncios_pendientes.edit', compact('ofertas', 'inmuebles', 'estados', 'ciudades', 'zonas', 'año', 'publicacion', 'marcas', 'agentes', 'marcas_elegidas', 'fotos', 'videos', 'titulo'));
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
            if(isset($request->estado_pub)){
                $pub->estado = $request->estado_pub;
                //enviar correo de estado de actualizacion de anuncio
                $user = User::find($pub->id_usuario);
                if($request->estado_pub == 'rechazado'){
                    //correo de rechazo
                    correoAnuncioRechazado::dispatch($user->nombre, $user->correo, $pub, $request->texto_motivo);
                } else {
                    //correo de aprobado
                    correoAnuncioAprobado::dispatch($user->nombre, $user->correo, $pub);
                }
            }
            $pub->save();
        } 
        return redirect('admin/pendientes');
    }

    public function eliminar($id){
        if(permisos::tiene('Eliminar Anuncios Pendientes')){
            //eliminar el anuncio
            $anuncio = Publicacion::find($id);
            $anuncio->delete();
            return redirect('admin/pendientes');
        } else {
            $mensaje = 'No tienes los permisos necesarios para realizar esta accion.';
            return redirect('admin/pendientes')->withErrors(compact('mensaje'));
        }  
    }

}
