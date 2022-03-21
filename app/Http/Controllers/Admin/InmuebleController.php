<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inmueble;

class InmuebleController extends Controller
{
    //
    public function index(){
        $permiso = 'Ver Tipos de Inmueble';
        if(permisos::tiene($permiso)){
            //mostrar todos los tipos de inmmueble en tabla
            $inmuebles = Inmueble::orderBy('created_at', 'desc')->paginate(10);
            return view('administracion.inmuebles.index', compact('inmuebles'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
           
    }

    public function show($id){
        $permiso = 'Ver Tipos de Inmueble';
        if(permisos::tiene($permiso)){
            //mostrar un tipo de inmueble especifico
            $titulo = 'Ver Tipo de Inmueble';
            $inmueble = Inmueble::find($id);
            return view('administracion.inmuebles.show', compact('titulo', 'inmueble'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
            
    }

    public function show_registrar(){
        $permiso = 'Registrar Tipos de Inmueble';
        if(permisos::tiene($permiso)){
            //mostrar el formulario de registro
            $titulo = 'Registrar Tipo de Inmueble';
            return view('administracion.inmuebles.register', compact('titulo'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }  
    }
    public function show_editar($id){
        $permiso = 'Editar Tipos de Inmueble';
        if(permisos::tiene($permiso)){
            //mostrar el formulario con datos
            $inmueble = Inmueble::find($id);
            $titulo = 'Editar Tipo de Inmueble';
            return view('administracion.inmuebles.edit', compact('titulo', 'inmueble'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
    }

    public function registrar(Request $request){
        //insertar el tipo de inmueble
        $inmueble = new Inmueble;
        $inmueble->nombre = $request->nombre;
        $inmueble->save();
 
        return redirect('admin/inmuebles');
    }
    public function editar(Request $request, $id){
        //actualizar el tipo de inmueble
        $inmueble = Inmueble::find($id);
        $inmueble->nombre = $request->nombre;
        $inmueble->save();
 
        return redirect('admin/inmuebles');
    }
    public function eliminar($id){
        if(permisos::tiene('Eliminar Tipos de Inmueble')){
            //eliminar el tipo de inmueble
            $inmueble = Inmueble::find($id);
            $inmueble->delete();
            return redirect('admin/inmuebles');
        } else {
            $mensaje = 'No tienes los permisos necesarios para realizar esta accion.';
            return redirect('admin/inmuebles')->withErrors(compact('mensaje'));
        }
            
    }
}
