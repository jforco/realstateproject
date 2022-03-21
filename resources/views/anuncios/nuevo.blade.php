@extends('layouts.master')

@section('titulo', 'Nuevo Anuncio')

@section('css')
	<link rel="stylesheet" href="{{ asset('css/segment.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap-toggle.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/dropzone.css') }}">
	<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
@endsection

@section('body')
	<br><br><br>

	<form method="post" action="{{ url('anuncios/'.$publicacion->codigo.'/guardar') }}" id="publicacion_form">
		@csrf
	</form>
		
	<div class="row no-gutters">
		<div class="col-sm-3 col-md-2" id="menu_lateral_anuncio">
			<br>
			<div>
				<p class="text-center"><strong>Cod. Anuncio: {{$publicacion->codigo}}</strong></p>	
			</div>
			<ul class="nav nav-pills nav-fill flex-column" role="tablist">
				<li class="nav-item">
				    <a class="nav-link active" id="link_datos1" data-toggle="pill" href="#datos1" role="tab" aria-selected="true">
				    	<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
						Datos del anuncio
				    </a>
				</li>
				<li class="nav-item">
				    <a class="nav-link disabled" id="link_datos2" data-toggle="pill" href="#datos2" role="tab" aria-selected="false">
				    	<i class="fa fa-map-marker" aria-hidden="true"></i>
				    	Descripción del inmueble
				    </a>
				</li>
				<li class="nav-item">
				    <a class="nav-link disabled" id="link_datos3" data-toggle="pill" href="#datos3" role="tab" aria-selected="false">
				    	<i class="fa fa-picture-o" aria-hidden="true"></i>
				    	Fotos/Video del inmueble
					</a>
				</li>
			</ul>
		</div>
		<div class="col-sm-9 col-md-10">
			<br>
			<div class="tab-content">
			  	<div class="tab-pane fade show active" id="datos1" role="tabpanel" aria-labelledby="link_datos1">
			  		@include('anuncios.seccion1')
				</div>
			  	<div class="tab-pane fade" id="datos2" role="tabpanel" aria-labelledby="link_datos2">
			  		@include('anuncios.seccion2')
			  	</div>
			  	<div class="tab-pane fade" id="datos3" role="tabpanel" aria-labelledby="link_datos3">
			  		@include('anuncios.seccion3')
			  	</div>
			</div>
			<br>
		</div>
	</div>
@endsection

@section('js')
	
	<!-- imports de mapas -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhkI0X1WScJL0AF-aBVXyYnfi6BJjDleg&callback=initMap" defer></script>
	<script type="text/javascript" src="{{ asset('js/gmaps.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/bootstrap-toggle.min.js') }}"></script>

	<!-- select zonas dinamico -->
	<script type="text/javascript">
		var estados = @json($estados);
		var ciudades = @json($ciudades);
		var zonas = @json($zonas);
		var estado_inmueble = '{{$publicacion->estado_inmueble}}';
		var tipo = '{{$publicacion->tipo_inmueble}}';
		var fecha = '{{$publicacion->fecha_entrega}}';
		var oferta = '{{$publicacion->tipo_oferta}}';
		var moneda = '{{$publicacion->moneda}}';
		var estado = '{{$publicacion->estado_lugar}}';
		var ciudad = '{{$publicacion->ciudad}}';
		var zona = '{{$publicacion->zona}}';
		
		var dormitorios = '{{$publicacion->cant_dormitorios}}';
		var pisos = '{{$publicacion->cant_pisos}}';
		var baños = '{{$publicacion->cant_baños}}';
		var parqueos = '{{$publicacion->cant_parqueos}}';
		var año = '{{$publicacion->año_construccion}}';
		var elevador = '{{$publicacion->elevador}}';
		var baulera = '{{$publicacion->baulera}}';
		var piscina = '{{$publicacion->piscina}}';
		var amoblado = '{{$publicacion->amoblado}}';
		var agente = '{{$publicacion->id_agente}}';
		var object_target_photos = {{$publicacion->cant_fotos}};
		var mapa_marker = 'null';
		var marcas = {{$marcas_elegidas}};

		var latitud = '{{$publicacion->latitud}}';
		var longitud = '{{$publicacion->longitud}}';
	</script>
	<script type="text/javascript" src="{{ asset('js/dropzone.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/nueva_publicacion.js') }}"></script>
	<!-- radio buton en horizontal -->
	<script src="{{ asset('js/segment.js') }}"></script>


@endsection