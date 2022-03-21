<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class UserAdm extends Authenticatable
{
    //
    protected $table = 'usuarioadm';

    public function rol()
    {
        return $this->hasOne('App\Models\Rol', 'id', 'id_rol');
    }
}
