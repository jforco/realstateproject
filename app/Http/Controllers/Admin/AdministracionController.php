<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\UserAdm;

class AdministracionController extends Controller
{
    //
    public function index(){
        return view('administracion.index');
    }
}
