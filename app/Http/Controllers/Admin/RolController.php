<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Rol;
use App\Models\Modulo;
use App\Models\Permiso_Rol;

class RolController extends Controller
{
    //
    public function index(){
        $permiso = 'Ver Roles';
        if(permisos::tiene($permiso)){
            //mostrar todos los roles en tabla
            $roles = Rol::orderBy('created_at', 'desc')->paginate(10);
            return view('administracion.roles.index', compact('roles'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
    }

    public function show($id){
        $permiso = 'Ver Roles';
        if(permisos::tiene($permiso)){
            //mostrar un rol especifico
            $titulo = 'Ver Rol';
            $rol = Rol::find($id);
            $modulos = Modulo::all();
            return view('administracion.roles.show', compact('titulo', 'modulos', 'rol'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
    }

    public function show_registrar(){
        $permiso = 'Registrar Roles';
        if(permisos::tiene($permiso)){
            //mostrar el formulario de registro
            $titulo = 'Registrar Rol';
            $modulos = Modulo::all();
            return view('administracion.roles.register', compact('titulo', 'modulos'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
    }
    
    public function show_editar($id){
        $permiso = 'Editar Roles';
        if(permisos::tiene($permiso)){
            //mostrar el formulario con datos
            $titulo = 'Editar Rol';
            $rol = Rol::find($id);
            $modulos = Modulo::all();
            $permisos2 = Permiso_Rol::where('id_rol', $id)->pluck('id_permiso');
            return view('administracion.roles.edit', compact('titulo', 'modulos', 'rol', 'permisos2'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
    }

    public function registrar(Request $request){
    	//insertar el rol
        $rol = new Rol;
        $rol->nombre = $request->nombre;
        $rol->descripcion = $request->descripcion;
        $rol->save();
        
        //insertar los permisos encontrados
        $todo = collect($request->all());
        foreach ($todo as $key => $value) {
            if(strcmp($key, $value) == 0){
                $permiso_rol = new Permiso_Rol;
                $permiso_rol->id_permiso = $value;
                $permiso_rol->id_rol = $rol->id;
                $permiso_rol->save();
            }
        }

        return redirect('admin/roles');
    }

    public function editar(Request $request, $id){
    	//actualizar el rol
        $rol = Rol::find($id);
        $rol->nombre = $request->nombre;
        $rol->descripcion = $request->descripcion;
        $rol->save();
        
        //eliminar los permisos asociados
        $permisos = Permiso_Rol::where('id_rol', $id)->delete();

        //volver a insertar los permisos encontrados
        $todo = collect($request->all());
        foreach ($todo as $key => $value) {
            if(strcmp($key, $value) == 0){
                $permiso_rol = new Permiso_Rol;
                $permiso_rol->id_permiso = $value;
                $permiso_rol->id_rol = $rol->id;
                $permiso_rol->save();
            }
        }

        return redirect('admin/roles');
    }

    public function eliminar($id){
        if(permisos::tiene('Eliminar Roles')){
            //eliminar los permisos asociados
            $permisos = Permiso_Rol::where('id_rol', $id)->delete();
            //eliminar el rol
            $rol = Rol::find($id);
            $rol->delete();
            return redirect('admin/roles');
        } else {
            $mensaje = 'No tienes los permisos necesarios para realizar esta accion.';
            return redirect('admin/roles')->withErrors(compact('mensaje'));
        }
            
    }
}
