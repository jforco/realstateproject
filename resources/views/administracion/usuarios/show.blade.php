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
		<a href="{{ url('admin/usuarios') }}" style="display: inline;">
			<button type="button" class="btn btn-default btn-sm">Volver</button></a>
		</a>
		<a href="{{ url('admin/usuarios/editar/'.$user->id) }}" style="display: inline;">
			<button type="button" class="btn btn-success btn-sm">Editar</button></a>
		</a>
		<!--Eliminar-->
		<form method="post" action="{{ url('admin/usuarios/eliminar/'.$user->id)}}" style="display: inline;" onsubmit="return confirm('Confirma que desea eliminar el elemento?');">
			@csrf
			<button type="submit" class="btn btn-danger btn-sm">Eliminar</button></a>
		</form>
	</div>
@stop

@section('content')
	<br>
	<div class="form-group">
		<label for="nombre">Nombre de Usuario</label>
		<p id="nombre">{{ $user->nombre }}</p>
	</div>
	<div class="form-group">
		<label for="correo">Correo</label>
		<p id="correo">{{ $user->correo }}</p>
	</div>
	<div class="form-group">
		<label for="genero">Genero</label>
		<p id="genero">{{ $user->genero }}</p>
	</div>
	<div class="form-group">
		<label for="avatar">Avatar</label>
		<p id="avatar">{{ $user->avatar }}</p>
		<img src="{{ url($user->avatar) }}" width="100px" height="100px">
		
	</div>
	<div class="form-group">
		<label for="fecha_nac">Fecha de Nacimiento</label>
		<p id="fecha_nac">{{ $user->fecha_nac }}</p>
	</div>
	<div class="form-group">
		<label for="url_perfil">url de perfil de facebook</label>

		<p id="url_perfil">{{ $user->url_perfil }}</p>
	</div>
	<div class="form-group">
		<label for="avatar">Habilitado como agente</label>
		<p id="avatar">{{ $user->agente }}</p>
	</div>
	<div class="form-group">
		<label for="creacion">Fecha de Creacion</label>
		<p id="creacion">{{ $user->created_at }}</p>
	</div>
	<div>
		<br>	
	</div>
	    
@stop