<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Marca;

class MarcaController extends Controller
{
    //
    public function index(){
        $permiso = 'Ver Marcas';
        if(permisos::tiene($permiso)){
            //mostrar todas las marcas en tabla
            $marcas = Marca::orderBy('created_at', 'desc')->paginate(10);
            return view('administracion.marcas.index', compact('marcas'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
           
    }

    public function show($id){
        $permiso = 'Ver Marcas';
        if(permisos::tiene($permiso)){
            //mostrar una marca especifica
            $titulo = 'Ver Marcas';
            $marca= Marca::find($id);
            return view('administracion.marcas.show', compact('titulo', 'marca'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
            
    }

    public function show_registrar(){
        $permiso = 'Registrar Marcas';
        if(permisos::tiene($permiso)){
            //mostrar el formulario de registro 
            $titulo = 'Registrar Marca';
            return view('administracion.marcas.register', compact('titulo'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }  
    }
    public function show_editar($id){
        $permiso = 'Editar Marcas';
        if(permisos::tiene($permiso)){
            //mostrar el formulario con datos
            $marca = Marca::find($id);
            $titulo = 'Editar Marca';
            return view('administracion.marcas.edit', compact('titulo', 'marca'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
    }

    public function registrar(Request $request){
        //insertar la marca
        $marca = new Marca;
        $marca->nombre = $request->nombre;
        $marca->save();
 
        return redirect('admin/marcas');
    }
    public function editar(Request $request, $id){
        //actualizar la marca
        $marca = Marca::find($id);
        $marca->nombre = $request->nombre;
        $marca->save();
 
        return redirect('admin/marcas');
    }
    public function eliminar($id){
        if(permisos::tiene('Eliminar Marcas')){
            //eliminar la marca
            $marca = Marca::find($id);
            $marca->delete();
            return redirect('admin/marcas');
        } else {
            $mensaje = 'No tienes los permisos necesarios para realizar esta accion.';
            return redirect('admin/marcas')->withErrors(compact('mensaje'));
        }
            
    }
}
