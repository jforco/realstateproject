<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permiso;
use App\Models\Permiso_Rol;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class permisos
{
    //
    public static function tiene($permiso){
    	try{
            $id_rol = Auth::guard('admin')->user()->id_rol;
            $id_permiso = Permiso::where('nombre', $permiso)->firstOrFail()->id;
            $existe = Permiso_Rol::where('id_rol', $id_rol)
                    ->where('id_permiso', $id_permiso)->firstOrFail();
            return true;
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

}
