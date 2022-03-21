<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Codigo;

class CodigoController extends Controller
{
    //
    public function index(){
        $permiso = 'Ver Codigos';
        if(permisos::tiene($permiso)){
            //mostrar todos codigos en tabla
            $codigos = Codigo::orderBy('created_at', 'desc')->paginate(10);
            return view('administracion.codigos.index', compact('codigos'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
           
    }

    public function show($id){
        $permiso = 'Ver Codigos';
        if(permisos::tiene($permiso)){
            //mostrar un codigo especifico
            $titulo = 'Ver Codigo';
            $codigo = Codigo::find($id);
            return view('administracion.codigos.show', compact('titulo', 'codigo'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
            
    }

    public function show_registrar(){
        $permiso = 'Registrar Codigos';
        if(permisos::tiene($permiso)){
            //mostrar el formulario de registro 
            $titulo = 'Registrar Código de Promocion';
            $codigo = $this->getCode();
            return view('administracion.codigos.register', compact('titulo', 'codigo'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }  
    }
    public function show_editar($id){
        $permiso = 'Editar Codigos';
        if(permisos::tiene($permiso)){
            //mostrar el formulario con datos
            $codigo = Codigo::find($id);
            $titulo = 'Editar Código de Promocion';
            return view('administracion.codigos.edit', compact('titulo', 'codigo'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
    }

    public function registrar(Request $request){
        //insertar la marca
        $codigo = new Codigo;
        $codigo->nombre = $request->nombre;
        $codigo->fecha_fin = $request->fecha_fin;
        $codigo->save();
 
        return redirect('admin/codigos');
    }
    public function editar(Request $request, $id){
        //actualizar la marca
        $codigo = Codigo::find($id);
        $codigo->fecha_fin = $request->fecha_fin;
        $codigo->save();
 
        return redirect('admin/codigos');
    }
    public function eliminar($id){
        if(permisos::tiene('Eliminar Codigos')){
            //eliminar la marca
            $codigo = Codigo::find($id);
            $codigo->delete();
            return redirect('admin/codigos');
        } else {
            $mensaje = 'No tienes los permisos necesarios para realizar esta accion.';
            return redirect('admin/codigos')->withErrors(compact('mensaje'));
        }
            
    }

    private function getCode(){
    	$caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789';
    	return substr(Str::shuffle(Str::repeat($caracteres,3)), 0, 5);
    }
}
