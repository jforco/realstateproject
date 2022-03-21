<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calificacion extends Model
{
    //
    use SoftDeletes;
    
    protected $table = 'calificaciones';

    public function nombre_usuario()
    {
        return $this->belongsTo('App\Models\User', 'id_usuario');
    }
}
