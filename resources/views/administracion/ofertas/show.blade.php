@extends('administracion.master')

@section('title')
	{{ $titulo }}
@endsection

@section('contenido_titulo')
	<h1 class="d-inline">{{ $titulo }}</h1>
	<div class="pull-right">
		<a href="{{ url('admin/ofertas') }}" style="display: inline;">
			<button type="button" class="btn btn-default btn-sm">Volver</button></a>
		</a>
		<a href="{{ url('admin/ofertas/editar/'.$oferta->id) }}" class="d-inline">
			<button type="button" class="btn btn-success btn-sm">Editar</button></a>
		</a>
		<!--Eliminar-->
		<form method="post" action="{{ url('admin/ofertas/eliminar/'.$oferta->id)}}" class="d-inline" onsubmit="return confirm('Confirma que desea eliminar el elemento?');">
			@csrf
			<button type="submit" class="btn btn-danger btn-xs">Eliminar</button></a>
		</form>
	</div>

@stop

@section('contenido')
	<br>
	<div class="form-group">
		<label for="nombre">Nombre de Tipo de Oferta</label>
		<p id="nombre">{{ $oferta->nombre }}</p>
	</div>
	<div class="form-group">
		<label for="creacion">Fecha de Creacion</label>
		<p id="creacion">{{ $oferta->created_at }}</p>
	</div>
	<div>
		<br>	
	</div>
	    
@stop