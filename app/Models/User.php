<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    //
    use Notifiable;
    use SoftDeletes;

    protected $table = 'usuarios';

    public function telefonos()
    {
        return $this->hasMany('App\Models\Telefono', 'id_usuario', 'id');
    }

    public function favoritos(){
    	return $this->belongsToMany('App\Models\Publicacion', 'favoritos', 'id_usuario', 'id_publicacion');
    }

    public function calificaciones()
    {
        return $this->hasMany('App\Models\Calificacion', 'id_agente', 'id');
    }
}
