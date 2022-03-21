<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lugar;

class LugarController extends Controller
{
    //
    public function index(){
        $permiso = 'Ver Lugares';
        if(permisos::tiene($permiso)){
            //mostrar todos los lugares en tabla
            $lugares = Lugar::orderBy('created_at', 'desc')->paginate(10);
            return view('administracion.lugares.index', compact('lugares'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
           
    }

    public function show($id){
        $permiso = 'Ver Lugares';
        if(permisos::tiene($permiso)){
            //mostrar un lugar especifico
            $titulo = 'Ver Lugar';
            $lugar = Lugar::find($id);
            return view('administracion.lugares.show', compact('titulo', 'lugar'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
            
    }

    public function show_registrar(){
        $permiso = 'Registrar Lugares';
        if(permisos::tiene($permiso)){
            //mostrar el formulario de registro
            $titulo = 'Registrar Lugar';
            $lugares = Lugar::all();
            return view('administracion.lugares.register', compact('titulo', 'lugares'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }  
    }
    public function show_editar($id){
        $permiso = 'Editar Lugares';
        if(permisos::tiene($permiso)){
            //mostrar el formulario con datos
            $lug = Lugar::find($id);
            $titulo = 'Editar Lugar';
            $lugares = Lugar::all();
            return view('administracion.lugares.edit', compact('titulo', 'lugares', 'lug'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
    }
    public function registrar(Request $request){
        //insertar el Lugar
        $lugar = new Lugar;
        $lugar->nombre = $request->nombre;
        $lugar->posX = $request->posx;
        $lugar->posY = $request->posy;
        $lugar->id_lugar = $request->lugar;
        $lugar->tipo = $request->tipo;
        $lugar->save();
 
        return redirect('admin/lugares');
    }
    public function editar(Request $request, $id){
        //actualizar el Lugar
        $lugar = Lugar::find($id);
        $lugar->nombre = $request->nombre;
        $lugar->posX = $request->posx;
        $lugar->posY = $request->posy;
        $lugar->id_lugar = $request->lugar;
        $lugar->tipo = $request->tipo;
        $lugar->save();
 
        return redirect('admin/lugares');
    }
    public function eliminar($id){
        if(permisos::tiene('Eliminar Lugares')){
            //eliminar el Lugar
            $lugar = Lugar::find($id);
            $lugar->delete();
            return redirect('admin/lugares');
        } else {
            $mensaje = 'No tienes los permisos necesarios para realizar esta accion.';
            return redirect('admin/lugares')->withErrors(compact('mensaje'));
        }
            
    }
}
