@extends('administracion.master')

@section('title')
	{{ $titulo }}
@endsection

@section('contenido_titulo')
	<h1 class="d-inline">{{ $titulo }}</h1>
	<div class="pull-right">
		<a href="{{ url('admin/pendientes') }}" style="display: inline;">
			<button type="button" class="btn btn-default btn-sm">Volver</button></a>
		</a>
		<a href="{{ url('admin/pendientes/editar/'.$anuncio->id) }}" class="d-inline">
			<button type="button" class="btn btn-success btn-sm">Editar</button></a>
		</a>
		<!--Eliminar-->
		<form method="post" action="{{ url('admin/pendientes/eliminar/'.$anuncio->id)}}" class="d-inline" onsubmit="return confirm('Confirma que desea eliminar el elemento?');">
			@csrf
			<button type="submit" class="btn btn-danger btn-sm">Eliminar</button></a>
		</form>
	</div>

@stop

@section('contenido')
	<div>
		<h4><strong>Anuncio nro {{$anuncio->codigo}}, publicado por {{$anuncio->usuario->nombre}}</strong></h4>
		@isset($anuncio->agente)
		<p>Agente contratado: {{$anuncio->agente->nombre}}</p>
		@endisset
		<p><strong>Estado: </strong>
			@if($anuncio->estado == 'pendiente')
			<span class="label label-warning">{{$anuncio->estado}}</span>
			@else
			<span class="label label-success">{{$anuncio->estado}}</span>
			@endif
		</p>
	</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label>Dirección</label>
				<p>{{ $anuncio->direccion }}</p>
			</div>
			<div class="form-group">
				<label>Descripción</label>
				<p>{{ $anuncio->descripcion }}</p>
			</div>
			<div class="form-group">
				<label>Descripción</label>
				<p>{{ $anuncio->estado_inmueble }}</p>
			</div>
			
			<div class="form-group">
				<label>Tipo de inmueble</label>
				<p>{{ $anuncio->tipo_inmueble }}</p>
			</div>
			<div class="form-group">
				<label>Oferta</label>
				<p>{{ $anuncio->tipo_oferta }} - <span id="precio"></span> {{$anuncio->moneda}}</p>
			</div>
			<div class="form-group">
				<label>Ubicación</label>
				<p>{{ $anuncio->zona }} - {{ $anuncio->ciudad }}</p>
				<div id="map" style="background-color: #777;"></div>
				<p>Precision: {{$anuncio->precision_punto}}</p>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label>Superficie terreno/construccion/terraza</label>
				<p>{{$anuncio->sup_terreno}}/{{$anuncio->sup_construido}}/{{$anuncio->sup_terraza}} m2</p>
			</div>
			<div class="form-group">
				<label>Año de construccion</label>
				<p>{{ $anuncio->año_construccion }}</p>
			</div>
			<div class="form-group">
				<label>Fecha de entrega</label>
				@if($anuncio->fecha_entrega=='')
				<p>Inmediato</p>
				@else
				<p>{{ $anuncio->fecha_entrega }}</p>
				@endif
			</div>
			<div class="form-group">
				<label>Cantidad de Dormitorios/Baños/Pisos/Parqueos</label>
				<p>{{$anuncio->cant_dormitorios}}/{{$anuncio->cant_baños}}/{{$anuncio->cant_pisos}}/{{$anuncio->cant_parqueos}}</p>
			</div>
			<div class="form-group">
				<label>Tiene Elevador/Baulera/Piscina/Amoblado</label>
				<p>{{$anuncio->elevador}}/{{$anuncio->baulera}}/{{$anuncio->piscina}}/{{$anuncio->amoblado}}</p>
			</div>
			<div class="form-group">
				<label>Marcas usadas en construccion:</label>
				<ul>
					@forelse($marcas as $marca)
					<li>{{$marca->nombre}}</li>
					@empty
					<li>ninguna</li>
					@endforelse
				</ul>
			</div>
			<div class="form-group">
				<label>Fecha de Creacion</label>
				<p>{{ $anuncio->created_at }}</p>
			</div>
		</div>
	</div>

	<label>Fotos</label>
	<div class="row">
		@forelse($fotos as $foto)
		<div class="col-xs-4 col-md-3">
			<a href="{{asset('publicaciones/'.$foto->nombre)}}" target="blank">
				<div class="foto @if($foto->nombre == $anuncio->portada) seleccionado @endif" style="width: 100px !important">
					<img src="{{ asset($foto->thumbnail) }}" class="img-thumbnail img-responsive">
					<div class="nombre_original" hidden>{{ $foto->original }}</div>
				</div>
			</a>
		</div>	
		@empty
		<p>no hay fotos</p>
		@endforelse
	</div>

	<label>Videos</label>
	<div class="row">
		@forelse($videos as $video)
		<div class="col-xs-3">
			<a href="{{asset('publicaciones/'.$video->nombre)}}" target="blank">
				<div class="foto" style="width: 100px !important;">
					<img src="{{ asset('img/play-video.png') }}" class="img-thumbnail">
				</div>
				<p><small>{{$video->original}}</small></p>
			</a>
		</div>
		@empty
		<p>no hay videos</p>
		@endforelse
	</div>
@endsection

@section('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhkI0X1WScJL0AF-aBVXyYnfi6BJjDleg&callback=initMap" defer></script>
<script type="text/javascript" src="{{ asset('js/gmaps.js') }}"></script>
<script type="text/javascript">
	$( document ).ready(function() {
	    $('#precio').html(new Intl.NumberFormat('es-MX').format({{$anuncio->precio}}));
		let latX = '{{$anuncio->latitud}}';
		let longY = '{{$anuncio->longitud}}';
		map = new GMaps({
			div: '#map',
			zoom: 14,
			height: '300px',
			width: '100%', 
			lat: latX, 
			lng: longY,
		});
		map.addMarker({
			lat: latX, 
		  	lng: longY,
			title: 'ubicacion del inmueble',
		});
	});
		
	
</script>
@endsection