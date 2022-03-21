@extends('adminlte::page')

@section('title')
	{{ $titulo }}
@endsection

@section('content_header')
	<h1 class="d-inline">{{ $titulo }}</h1>
	<div class="pull-right">
		<a href="{{ url('admin/inmuebles') }}" style="display: inline;">
			<button type="button" class="btn btn-default btn-sm">Volver</button></a>
		</a>
		<a href="{{ url('admin/inmuebles/editar/'.$inmueble->id) }}" class="d-inline">
			<button type="button" class="btn btn-success btn-sm">Editar</button></a>
		</a>
		<!--Eliminar-->
		<form method="post" action="{{ url('admin/inmuebles/eliminar/'.$inmueble->id)}}" class="d-inline" onsubmit="return confirm('Confirma que desea eliminar el elemento?');">
			@csrf
			<button type="submit" class="btn btn-danger btn-sm">Eliminar</button></a>
		</form>
	</div>
@stop

@section('content')
	<br>
	<div class="form-group">
		<label for="nombre">Nombre de Tipo de Inmueble</label>
		<p id="nombre">{{ $inmueble->nombre }}</p>
	</div>
	<div class="form-group">
		<label for="creacion">Fecha de Creacion</label>
		<p id="creacion">{{ $inmueble->created_at }}</p>
	</div>
	<div>
		<br>	
	</div>
	    
@stop