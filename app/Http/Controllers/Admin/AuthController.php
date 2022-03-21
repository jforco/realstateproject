<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAdm;

class AuthController extends Controller
{
    public function show_login(){
        if(Auth::guard('admin')->check()){
            return redirect('admin');
        }
        return view('administracion.auth.login');
    }

    public function login(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|string|email|max:50',
            'password' => 'required|string|min:4',
        ]);
        
        $email = $request->email;
        $password = $request->password;
        if (Auth::guard('admin')->attempt(['correo' => $email, 'password' => $password], false)) {
            // Authentication passed...
            //$useradm = UserAdm::where('correo', $request->email)->firstOrFail();
            //Auth::guard('admin')->login($useradm);
            return redirect('admin');
        } else {
            $mensaje = 'Usuario o contraseña incorrecto!';
            return redirect('/admin/login')->withErrors(compact('mensaje'));
        }
        
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
