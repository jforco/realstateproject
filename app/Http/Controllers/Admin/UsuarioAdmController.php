<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAdm; 
use App\Models\Rol;

class UsuarioAdmController extends Controller
{
    
    public function index(){
        $permiso = 'Ver Usuarios ADM';
        if(permisos::tiene($permiso)){
            //mostrar todos los usuarios en tabla
            $users = UserAdm::orderBy('created_at', 'desc')->paginate(10);
            return view('administracion.usuariosAdm.index', compact('users'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
           
    }

    public function show($id){
        $permiso = 'Ver Usuarios ADM';
        if(permisos::tiene($permiso)){
            //mostrar un usuario especifico
            $titulo = 'Ver Usuario';
            $user = UserAdm::find($id);
            return view('administracion.usuariosAdm.show', compact('titulo', 'user'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
    }

    public function show_registrar(){
        $permiso = 'Registrar Usuarios ADM';
        if(permisos::tiene($permiso)){
            //mostrar el formulario de registro
            $titulo = 'Registrar Usuario';
            $roles = Rol::all();
            return view('administracion.usuariosAdm.register', compact('titulo', 'roles'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
    }

    public function show_editar($id){
        $permiso = 'Editar Usuarios ADM';
        if(permisos::tiene($permiso)){
            //mostrar el formulario con datos
            $titulo = 'Editar Usuario';
            $user = UserAdm::find($id);
            $roles = Rol::all();
            return view('administracion.usuariosAdm.edit', compact('titulo', 'roles', 'user'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }  
    }

    public function registrar(Request $request){
        //insertar el usuario
        $user = new UserAdm;
        $user->nombre = $request->nombre;
        $user->correo = $request->correo;
        $user->telefono = $request->telefono;
        $user->id_rol = $request->id_rol;
        $user->password = Hash::make($request->password);
        $user->save();
 
        return redirect('admin/usuariosAdm');
    }

    public function editar(Request $request, $id){
        //actualizar el usuario
        $user = UserAdm::find($id);
        $user->nombre = $request->nombre;
        $user->correo = $request->correo;
        $user->telefono = $request->telefono;
        $user->id_rol = $request->id_rol;
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->save();
 
        return redirect('admin/usuariosAdm');
    }
    public function eliminar($id){
        if(permisos::tiene('Eliminar Usuarios ADM')){
            //eliminar el usuario
            $user = UserAdm::find($id);
            $user->delete();
            return redirect('admin/usuariosAdm');
        } else {
            $mensaje = 'No tienes los permisos necesarios para realizar esta accion.';
            return redirect('admin/usuariosAdm')->withErrors(compact('mensaje'));
        }
            
    }
        
}
