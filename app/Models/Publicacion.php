<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publicacion extends Model
{
    //
    use SoftDeletes;
    protected $table = 'publicaciones';

    public function plan(){
    	return $this->hasOne('App\Models\Plan', 'id', 'id_plan');
    }
    public function get_usuario(){
    	return $this->hasOne('App\Models\User', 'id', 'id_usuario');
    }
    public function get_agente(){
    	return $this->hasOne('App\Models\User', 'id', 'id_agente');
    }
    public function favorito($user_id){
        try{
            $favorito = Favorito::where('id_usuario', $user_id)
                    ->where('id_publicacion', $this->id)->firstOrFail();
            return true;
        } catch(ModelNotFoundException $m){
            return false;
        }
    } 
    public function calificacion(){
        return $this->hasOne('App\Models\Calificacion', 'cod_anuncio', 'codigo');
    }
}
