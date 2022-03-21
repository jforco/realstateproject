<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Modulo extends Model
{
    //
    public function permisos()
    {
        return $this->hasMany('App\Models\Permiso', 'id_modulo', 'id');
    }

    public function permisosValidos($id_modulo, $id_rol){
    	return DB::table('modulos')
    			->join('permisos', 'permisos.id_modulo', '=', 'modulos.id')
    			->join('permisos_rol', 'permisos.id', '=', 'permisos_rol.id_permiso')
    			->where('modulos.id', $id_modulo)
    			->where('permisos_rol.id_rol', $id_rol)
    			->select('permisos.nombre')->get();

    }
}
