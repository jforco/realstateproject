<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lugar extends Model
{
    //
    use SoftDeletes;
    
    protected $table = 'lugares';

    public function lugar()
    {
        return $this->belongsTo('App\Models\Lugar', 'id_lugar', 'id');
    }
}
