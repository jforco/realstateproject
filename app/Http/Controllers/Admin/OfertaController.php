<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Oferta;

class OfertaController extends Controller
{
    //
    public function index(){
        $permiso = 'Ver Tipos de Oferta';
        if(permisos::tiene($permiso)){
            //mostrar todos los tipos de inmmueble en tabla
            $ofertas = Oferta::orderBy('created_at', 'desc')->paginate(10);
            return view('administracion.ofertas.index', compact('ofertas'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
           
    }

    public function show($id){
        $permiso = 'Ver Tipos de Oferta';
        if(permisos::tiene($permiso)){
            //mostrar un tipo de inmueble especifico
            $titulo = 'Ver Tipo de Inmueble';
            $oferta= Oferta::find($id);
            return view('administracion.ofertas.show', compact('titulo', 'oferta'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
            
    }

    public function show_registrar(){
        $permiso = 'Registrar Tipos de Oferta';
        if(permisos::tiene($permiso)){
            //mostrar el formulario de registro
            $titulo = 'Registrar Tipo de Oferta';
            return view('administracion.ofertas.register', compact('titulo'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }  
    }
    public function show_editar($id){
        $permiso = 'Editar Tipos de Oferta';
        if(permisos::tiene($permiso)){
            //mostrar el formulario con datos
            $oferta = Oferta::find($id);
            $titulo = 'Editar Tipo de Oferta';
            return view('administracion.ofertas.edit', compact('titulo', 'oferta'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
    }

    public function registrar(Request $request){
        //insertar el tipo de ofertas
        $oferta = new Oferta;
        $oferta->nombre = $request->nombre;
        $oferta->save();
 
        return redirect('admin/ofertas');
    }
    public function editar(Request $request, $id){
        //actualizar el tipo de oferta
        $oferta = Oferta::find($id);
        $oferta->nombre = $request->nombre;
        $oferta->save();
 
        return redirect('admin/ofertas');
    }
    public function eliminar($id){
        if(permisos::tiene('Eliminar Tipos de Oferta')){
            //eliminar el tipo de oferta
            $oferta = Oferta::find($id);
            $oferta->delete();
            return redirect('admin/ofertas');
        } else {
            $mensaje = 'No tienes los permisos necesarios para realizar esta accion.';
            return redirect('admin/ofertas')->withErrors(compact('mensaje'));
        }
            
    }
}
