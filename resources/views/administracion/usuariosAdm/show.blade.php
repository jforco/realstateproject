@extends('adminlte::page')

@section('title')
	{{ $titulo }}
@endsection

@section('css')
	<link rel="stylesheet" href="{{ asset('css/formularios.css') }}">
@endsection

@section('content_header')
	<h1 style="display: inline;">{{ $titulo }}</h1>
	<div class="pull-right">
		<a href="{{ url('admin/usuariosAdm') }}" style="display: inline;">
			<button type="button" class="btn btn-default btn-sm">Volver</button></a>
		</a>
		<a href="{{ url('admin/usuariosAdm/editar/'.$user->id) }}" style="display: inline;">
			<button type="button" class="btn btn-success btn-sm">Editar</button></a>
		</a>
		<!--Eliminar-->
		<form method="post" action="{{ url('admin/usuariosAdm/eliminar/'.$user->id)}}" style="display: inline;" onsubmit="return confirm('Confirma que desea eliminar el elemento?');">
			@csrf
			<button type="submit" class="btn btn-danger btn-sm">Eliminar</button></a>
		</form>
	</div>

@stop

@section('content')
	<br>
	<div class="form-group">
		<label for="nombre">Nombre de Usuario ADM</label>
		<p id="nombre">{{ $user->nombre }}</p>
	</div>
	<div class="form-group">
		<label for="correo">Correo</label>
		<p id="correo">{{ $user->correo }}</p>
	</div>
	<div class="form-group">
		<label for="telefono">Telefono</label>
		<p id="telefono">{{ $user->telefono }}</p>
	</div>
	<div class="form-group">
		<label for="rol">Rol</label>
		@isset($user->rol->nombre)
		<p id="rol">{{ $user->rol->nombre }}</p>
		@endisset
		@empty($user->rol->nombre)
		<p id="rol" style="color: red;">Sin Rol Valido</p>
		@endempty
	</div>
	<div class="form-group">
		<label for="creacion">Fecha de Creacion</label>
		<p id="creacion">{{ $user->created_at }}</p>
	</div>
	<div>
		<br>	
	</div>
	    
@stop