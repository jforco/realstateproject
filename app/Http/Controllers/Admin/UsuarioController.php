<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Intervention\Image\ImageManagerStatic as Image;

class UsuarioController extends Controller
{
    //
    public function index(){
        $permiso = 'Ver Usuarios';
        if(permisos::tiene($permiso)){
            //mostrar todos los usuarios en tabla
            $users = User::where('agente', 'no')->orderBy('created_at', 'desc')->paginate(10);
            return view('administracion.usuarios.index', compact('users'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
           
    }

    public function show($id){
        $permiso = 'Ver Usuarios';
        if(permisos::tiene($permiso)){
            //mostrar un usuario especifico
            $titulo = 'Ver Usuario';
            $user = User::where('agente', 'no')->find($id);
            return view('administracion.usuarios.show', compact('titulo', 'user'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
    }

    public function show_registrar(){
        $permiso = 'Registrar Usuarios';
        if(permisos::tiene($permiso)){
            //mostrar el formulario de registro
            $titulo = 'Registrar Usuario';
            return view('administracion.usuarios.register', compact('titulo'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }
    }

    public function show_editar($id){
        $permiso = 'Editar Usuarios';
        if(permisos::tiene($permiso)){
            //mostrar el formulario con datos
            $titulo = 'Editar Usuario';
            $user = User::where('agente', 'no')->find($id);
            return view('administracion.usuarios.edit', compact('titulo', 'user'));
        } else {
            return view('administracion.restringido', [ 'titulo' => $permiso]);
        }  
    }

    public function registrar(Request $request){
        //insertar el usuario
        $user = new User;
        $user->nombre = $request->nombre;
        $user->correo = $request->correo;
        $user->genero = $request->genero;
        if(!empty($request->file('avatar'))){
        	$extension = $request->file('avatar')->getClientOriginalExtension();
	    	$imagen = Image::make($request->file('avatar'));
	    	if($imagen->height()<=$imagen->width()){
	    		$imagen->crop($imagen->height(), $imagen->height());
	    	} else {
	    		$imagen->crop($imagen->width(), $imagen->width());
	    	}
	    	$imagen->resize(150, 150);
	    	$direccion = 'img/profiles/'.$user->id.'.'.$extension;
	    	$imagen->save($direccion);
	    	$user->avatar = $direccion;
        }
        if(!empty($request->fecha_nac)){
        	$user->fecha_nac = $request->fecha_nac;
        }
        if(!empty($request->agente)){
        	$user->agente = $request->agente;
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('admin/usuarios');
    }

    public function editar(Request $request, $id){
        //actualizar el usuario
        $user = User::where('agente', 'no')->find($id);
        $user->nombre = $request->nombre;
        $user->correo = $request->correo;
        $user->genero = $request->genero;
        if(!empty($request->file('avatar'))){
        	$extension = $request->file('avatar')->getClientOriginalExtension();
	    	$imagen = Image::make($request->file('avatar'));
	    	if($imagen->height()<=$imagen->width()){
	    		$imagen->crop($imagen->height(), $imagen->height());
	    	} else {
	    		$imagen->crop($imagen->width(), $imagen->width());
	    	}
	    	$imagen->resize(150, 150);
	    	$direccion = 'img/profiles/'.$user->id.'.'.$extension;
	    	$imagen->save($direccion);
	    	$user->avatar = $direccion;
        }
        if(!empty($request->fecha_nac)){
        	$user->fecha_nac = $request->fecha_nac;
        } else {
            $user->fecha_nac = null;
        }
        if(!empty($request->agente)){
        	$user->agente = $request->agente;
        } else {
            $user->agente = "no";
        }
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect('admin/usuarios');
    }
    public function eliminar($id){
        if(permisos::tiene('Eliminar Usuarios')){
            //eliminar el usuario
            $user = User::where('agente', 'no')->find($id);
            $user->delete();
            return redirect('admin/usuarios');
        } else {
            $mensaje = 'No tienes los permisos necesarios para realizar esta accion.';
            return redirect('admin/usuarios')->withErrors(compact('mensaje'));
        }
            
    }
}
