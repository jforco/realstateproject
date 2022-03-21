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
		<a href="{{ url('admin/lugares') }}" style="display: inline;">
			<button type="button" class="btn btn-default btn-sm">Volver</button></a>
		</a>
		<a href="{{ url('admin/lugares/editar/'.$lugar->id) }}" style="display: inline;">
			<button type="button" class="btn btn-success btn-sm">Editar</button></a>
		</a>
		<!--Eliminar-->
		<form method="post" action="{{ url('admin/lugares/eliminar/'.$lugar->id)}}" style="display: inline;" onsubmit="return confirm('Confirma que desea eliminar el elemento?');">
			@csrf
			<button type="submit" class="btn btn-danger btn-sm">Eliminar</button></a>
		</form>
	</div>

@stop

@section('content')
	<br>
	<div class="form-group">
		<label for="nombre">Lugar</label>
		<p id="nombre">{{ $lugar->nombre }}</p>
	</div>
	<div class="form-group">
		<label for="latitud">Latitud</label>
		<p id="latitud">{{ $lugar->posX }}</p>
	</div>
	<div class="form-group">
		<label for="longitud">Longitud</label>
		<p id="longitud">{{ $lugar->posY }}</p>
	</div>
	<div class="form-group">
		<label for="pertenece">Pertenece a</label>
		@isset($lugar->lugar)
		<p id="pertenece">{{ $lugar->lugar->nombre }}</p>
		@endisset

		@empty($lugar->lugar)
		<p id="pertenece">{{ $lugar->rol->nombre }}</p>
		@endempty
		
	</div>
	<div class="form-group">
		<label for="tipo">Tipo</label>
		<p id="tipo">{{ $lugar->tipo }}</p>
	</div>
	<div class="form-group">
		<label for="creacion">Fecha de Creacion</label>
		<p id="creacion">{{ $lugar->created_at }}</p>
	</div>
	<br>
    <div id="map" style="height: 300px; width: 300px; background-color: #777;"></div>
@stop

@section('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhkI0X1WScJL0AF-aBVXyYnfi6BJjDleg&callback=initMap"
    async defer></script>
<script type="text/javascript" src="{{ asset('js/gmaps.js') }}"></script>
<script type="text/javascript">
	$lat = {{ $lugar->posX }};
	$long = {{ $lugar->posY }};
	$(document).ready(function(){
		map = new GMaps({
		  	div: '#map',
		  	zoom: 5,
		  	lat: $lat, 
		  	lng: $long,
		});
		map.addMarker({
			lat: $lat, 
		  	lng: $long,
			title: 'none',
			
		});
	});
</script>
@stop