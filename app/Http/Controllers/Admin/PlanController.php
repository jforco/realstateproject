<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Plan;

class PlanController extends Controller
{
    //
    public function index(){
        $permiso = 'Ver Planes';
        if(permisos::tiene($permiso)){
            //mostrar todos los planes en tabla
            $planes = Plan::orderBy('created_at', 'desc')->paginate(10);
            return view('administracion.planes.index', compact('planes'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
           
    }

    public function show($id){
        $permiso = 'Ver Planes';
        if(permisos::tiene($permiso)){
            //mostrar un plan especifico
            $titulo = 'Ver Plan';
            $plan = Plan::find($id);
            return view('administracion.planes.show', compact('titulo', 'plan'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
            
    }

    public function show_registrar(){
        $permiso = 'Registrar Planes';
        if(permisos::tiene($permiso)){
            //mostrar el formulario de registro
            $titulo = 'Registrar Plan';
            return view('administracion.planes.register', compact('titulo'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }  
    }
    public function show_editar($id){
        $permiso = 'Editar Planes';
        if(permisos::tiene($permiso)){
            //mostrar el formulario con datos
            $plan = Plan::find($id);
            $titulo = 'Editar Plan';
            return view('administracion.planes.edit', compact('titulo', 'plan'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
    }

    public function registrar(Request $request){
        //insertar el plan
        //return $request;

        $plan = new Plan();
        $plan->nombre = $request->nombre;
        $plan->precio = $request->precio;
        $plan->foto_vendedor = $request->foto_vendedor;
        $plan->icono = $request->icono;
        $plan->prioridad = $request->prioridad;
        $plan->cant_fotos = $request->cant_fotos;
        $plan->fotos_empresa = $request->fotos_empresa;
        $plan->cant_videos = $request->cant_videos;
        $plan->video_empresa = $request->video_empresa;
        $plan->facebook = $request->facebook;
        $plan->portada = $request->portada;
        $plan->notificaciones = $request->notificaciones;
        $plan->elegir_agente = $request->elegir_agente;
        $plan->soporte = $request->soporte;
        $plan->es_promocion = $request->es_promocion;
        $plan->save();
 
        return redirect('admin/planes');
    }
    public function editar(Request $request, $id){
        //actualizar el plan
        $plan = Plan::find($id);
        $plan->nombre = $request->nombre;
        $plan->precio = $request->precio;
        $plan->foto_vendedor = $request->foto_vendedor;
        $plan->icono = $request->icono;
        $plan->prioridad = $request->prioridad;
        $plan->cant_fotos = $request->cant_fotos;
        $plan->fotos_empresa = $request->fotos_empresa;
        $plan->cant_videos = $request->cant_videos;
        $plan->video_empresa = $request->video_empresa;
        $plan->facebook = $request->facebook;
        $plan->portada = $request->portada;
        $plan->notificaciones = $request->notificaciones;
        $plan->elegir_agente = $request->elegir_agente;
        $plan->soporte = $request->soporte;
        $plan->es_promocion = $request->es_promocion;
        $plan->save();
 
        return redirect('admin/planes');
    }
    public function eliminar($id){
        if(permisos::tiene('Eliminar Planes')){
            //eliminar el plan
            $plan = Plan::find($id);
            $plan->delete();
            return redirect('admin/planes');
        } else {
            $mensaje = 'No tienes los permisos necesarios para realizar esta accion.';
            return redirect('admin/planes')->withErrors(compact('mensaje'));
        }
            
    }
}
