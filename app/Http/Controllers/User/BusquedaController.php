<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Oferta;
use App\Models\Inmueble;
use App\Models\Lugar;
use App\Models\Publicacion;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BusquedaController extends Controller
{
    public function index(){
    	$ofertas = Oferta::pluck('nombre');
        $inmuebles = Inmueble::pluck('nombre');
        $ciudades = Lugar::where('tipo', 'Ciudad')->pluck('nombre');
        $fecha_limite = $this->getFechaActual();
        $anuncios = DB::table('publicaciones')
                        ->where('destacado', '=', 'si')
                        ->where('publicaciones.estado', 'aprobado')
                        ->where('publicaciones.destacado_finish_at', '>', $fecha_limite)
                        ->orderBy('publicaciones.updated_at', 'desc')
                        ->select('publicaciones.*')->get();
    	return view('index', compact('ofertas', 'inmuebles', 'ciudades', 'anuncios'));
    }

    public function buscar(Request $request){
        $ofertas = Oferta::pluck('nombre');
        $inmuebles = Inmueble::pluck('nombre');
        
        $estados = Lugar::where('tipo', 'Estado')->select('id', 'nombre')->get();
        $ciudades = Lugar::where('tipo', 'Ciudad')->select('id', 'nombre', 'id_lugar', 'posX', 'posY')->get();
        $zonas = Lugar::where('tipo', 'Zona')->select('id', 'nombre', 'id_lugar', 'posX', 'posY')->get();
        
        //datos del request
        $tipo_inmueble = $request->inmueble;
        $tipo_oferta = $request->oferta;

        //obtener estado
        if(isset($request->estado)){
            $estado_seleccionado = $request->estado;    
        } else {
            $ciudadX = Lugar::where('nombre', $request->ciudad)->first();
            $estadoX = Lugar::where('id', $ciudadX->id_lugar)->first();
            $estado_seleccionado = $estadoX->nombre;
        }

        $precio_minimo = '';
        $precio_maximo = '';
        $moneda = '';
        $orden = '';

        $fecha_limite = $this->getFechaActual();

        $query = Publicacion::query();
        $query = $query->where('estado_lugar', $estado_seleccionado)
                ->where('tipo_oferta', $tipo_oferta)
                ->where('tipo_inmueble', $tipo_inmueble)
                ->where('estado', 'aprobado')
                ->where('finish_at', '>', $fecha_limite);

        //obtener ciudad, zona 
        $ciudad_seleccionada = '';
        $zona_seleccionada = '';
        if(isset($request->ciudad)){
            $ciudad_seleccionada = $request->ciudad;
            if($ciudad_seleccionada != 'none'){
                $query = $query->where('ciudad', $ciudad_seleccionada);
                //mapa
                $ciudad_eloquent = $ciudades->firstWhere('nombre', $ciudad_seleccionada);
                $latitud_mapa = $ciudad_eloquent->posX;
                $longitud_mapa = $ciudad_eloquent->posY;
                if(isset($request->zona)){
                    $zona_seleccionada = $request->zona;
                    if($zona_seleccionada != 'none'){
                        $query = $query->where('zona', $zona_seleccionada);
                        //mapa
                        $zona_eloquent = $zonas->firstWhere('nombre', $zona_seleccionada);
                        $latitud_mapa = $zona_eloquent->posX;
                        $longitud_mapa = $zona_eloquent->posY;
                    }
                }
            } else {
                $estado_eloquent = Lugar::where('nombre', $estado_seleccionado)->first();
                $latitud_mapa = $estado_eloquent->posX;
                $longitud_mapa = $estado_eloquent->posY;
            }
        }

        if(isset($request->precio_min) && (isset($request->precio_max))){
            if($request->precio_max == 'Maximo'){
                $precio_minimo = $request->precio_min;
                $precio_maximo = $request->precio_max;
                $query = $query->where('precio', '>=', $precio_minimo);
            } else {
                if($request->precio_min <= $request->precio_max){
                    $precio_minimo = $request->precio_min;
                    $precio_maximo = $request->precio_max;
                } else {
                    $precio_minimo = $request->precio_max;
                    $precio_maximo = $request->precio_min;
                }   
                $query = $query->where('precio', '>=', $precio_minimo);
                $query = $query->where('precio', '<=', $precio_maximo);
            }
        }

        if(isset($request->monedas)){
            $monedas = $request->monedas;

            $query->where(function($query2) use ($monedas){
                $m = $monedas;
                foreach ($monedas as $m) {
                    $query = $query2->orWhere('moneda', $m);
                }
            }); 
            if(count($monedas) > 1){
                $moneda = 'todas';
            } else {
                $moneda = $monedas[0];
            }
        }

        if(isset($request->dormitorios)){
            $dormitorios = $request->dormitorios;
            $query->where(function($query2) use ($dormitorios){
                $d = $dormitorios;
                foreach ($dormitorios as $cantidad) {
                    if($cantidad == '4'){
                        $query2->orWhere('cant_dormitorios', '>=', $cantidad);
                    } else {
                        $query2->orWhere('cant_dormitorios', $cantidad);
                    }
                }
            }); 
        } else {
            $dormitorios = collect(["1", "2", "3", "4"]);
        }
        
        $anuncios_mapa = $query->get(); 
                    
        if(isset($request->orden)){
            $orden = $request->orden;
            switch ($orden) {
                case 'reciente':
                    $query = $query->orderBy('updated_at', 'desc');
                    break;

                case 'barato':
                    $query = $query->orderBy('precio', 'asc');
                    break;

                case 'caro':
                    $query = $query->orderBy('precio', 'desc');
                    break;

                default:
                    $query = $query->orderBy('updated_at', 'desc');
            }
        } else {
            $query = $query->orderBy('updated_at', 'desc');
        }

        $anuncios = $query->paginate(10);
        $anuncios->appends(request()->input())->links();
        $tipo_vista = 'lista';
        return view('busquedas.busqueda2', compact('anuncios', 'tipo_inmueble', 'tipo_oferta', 'ofertas', 
        'inmuebles', 'estados', 'estado_seleccionado', 'ciudades', 'ciudad_seleccionada', 'zonas', 
        'zona_seleccionada', 'precio_minimo', 'precio_maximo', 'moneda', 'dormitorios', 'orden', 
        'latitud_mapa', 'longitud_mapa', 'anuncios_mapa', 'tipo_vista'));                
            
    }

    private function getFechaActual(){
        return Carbon::now();
    }
}
