@extends('adminlte::page')

@section('content_header')
    <h1>Escritorio</h1>
@stop

@section('content')
    <p>Bienvenido al panel de administracion de {{ env('SITIO_NAME') }}.</p>
    <form method="post" action="{{ url('admin/logout') }}">
        @csrf                            
        <input type="submit" class="logout-link" value="Cerrar Sesion">
    </form>
@stop