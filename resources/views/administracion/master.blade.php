@extends('adminlte::page')



@section('content_header')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            @yield('contenido_titulo')
        </div>
    </div>
</div>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-10">
    		@yield('contenido')
        </div>
    </div>

@stop