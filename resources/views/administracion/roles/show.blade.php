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
		<a href="{{ url('admin/roles') }}" style="display: inline;">
			<button type="button" class="btn btn-default btn-sm">Volver</button></a>
		</a>
		<a href="{{ url('admin/roles/editar/'.$rol->id) }}" style="display: inline;">
			<button type="button" class="btn btn-success btn-sm">Editar</button></a>
		</a>
		<!--Eliminar-->
		<form method="post" action="{{ url('admin/roles/eliminar/'.$rol->id)}}" style="display: inline;" onsubmit="return confirm('Confirma que desea eliminar el elemento?');">
			@csrf
			<button type="submit" class="btn btn-danger btn-sm">Eliminar</button></a>
		</form>
	</div>

@stop

@section('content')
	<br>
	<div class="form-group">
		<label for="nombre">Nombre de Rol</label>
		<p id="nombre">{{ $rol->nombre }}</p>
	</div>
	<div class="form-group">
		<label for="descripcion">Descripcion</label>
		<p id="descripcion">{{ $rol->descripcion }}</p>
	</div>
	<div class="form-group">
		<label for="creacion">Fecha de Creacion</label>
		<p id="creacion">{{ $rol->created_at }}</p>
	</div>
	<div>
		<h3>Permisos</h3>
		@forelse($modulos as $modulo)
			<h4><b>{{ $modulo->nombre }}</b></h4>
			@forelse($modulo->permisosValidos($modulo->id, $rol->id) as $permiso)
				<p>{{ $permiso->nombre }}</p>
			@empty
				<p>ningun permiso</p>
			@endforelse

		@empty
		<p>none</p>
		@endforelse
		<br>	
	</div>
	    
@stop