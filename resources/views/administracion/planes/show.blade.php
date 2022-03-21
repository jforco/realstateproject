@extends('administracion.master')

@section('title')
	{{ $titulo }}
@endsection

@section('contenido_titulo')
	<h1 class="d-inline">{{ $titulo }}</h1>
	<div class="pull-right">
		<a href="{{ url('admin/planes') }}" style="display: inline;">
			<button type="button" class="btn btn-default btn-sm">Volver</button></a>
		</a>
		<a href="{{ url('admin/planes/editar/'.$plan->id) }}" class="d-inline">
			<button type="button" class="btn btn-success btn-sm">Editar</button></a>
		</a>
		<!--Eliminar-->
		<form method="post" action="{{ url('admin/planes/eliminar/'.$plan->id)}}" class="d-inline" onsubmit="return confirm('Confirma que desea eliminar el elemento?');">
			@csrf
			<button type="submit" class="btn btn-danger btn-sm">Eliminar</button></a>
		</form>
	</div>

@stop

@section('contenido')
	<br>
	<div class="form-group">
		<label for="nombre">Nombre de Plan</label>
		<p id="nombre">{{ $plan->nombre }}</p>
	</div>
	<div class="form-group">
		<label for="precio">Precio</label>
		<p id="precio">{{ $plan->precio }}</p>
	</div>
	<div class="form-group">
		<label for="foto_vendedor">Foto de Vendedor</label>
		<p id="foto_vendedor">{{ $plan->foto_vendedor }}</p>
	</div>
	<div class="form-group">
		<label for="icono">Tipo de Icono en el mapa</label>
		<p id="icono">{{ $plan->icono }}</p>
	</div>
	<div class="form-group">
		<label for="cant_fotos">Cantidad de Fotos</label>
		<p id="cant_fotos">{{ $plan->cant_fotos }}</p>
	</div>
	<div class="form-group">
		<label for="fotos_empresa">Servicio de Sesion Fotográfica</label>
		<p id="fotos_empresa">{{ $plan->fotos_empresa }}</p>
	</div>
	<div class="form-group">
		<label for="cant_videos">Cantidad de Videos</label>
		<p id="cant_videos">{{ $plan->cant_videos }}</p>
	</div>
	<div class="form-group">
		<label for="video_empresa">Servicio de Realizacion de Video</label>
		<p id="video_empresa">{{ $plan->video_empresa }}</p>
	</div>
	<div class="form-group">
		<label for="facebook">Publicacion en Facebook</label>
		<p id="facebook">{{ $plan->facebook }}</p>
	</div>
	<div class="form-group">
		<label for="portada">Publicacion en la Portada</label>
		<p id="portada">{{ $plan->portada }}</p>
	</div>
	<div class="form-group">
		<label for="elegir_agente">Elegir Agente</label>
		<p id="elegir_agente">{{ $plan->elegir_agente }}</p>
	</div>
	<div class="form-group">
		<label for="soporte">Soporte Directo</label>
		<p id="soporte">{{ $plan->soporte }}</p>
	</div>
	<div class="form-group">
		<label for="es_promocion">es Promoción?</label>
		<p id="es_promocion">{{ $plan->es_promocion }}</p>
	</div>
	<div class="form-group">
		<label for="creacion">Fecha de Creacion</label>
		<p id="creacion">{{ $plan->created_at }}</p>
	</div>
	<div>
		<br>	
	</div>
	    
@stop