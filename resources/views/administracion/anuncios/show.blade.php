@extends('adminlte::page')

@section('title')
	{{ $titulo }}
@endsection

@section('content_header')
	<h1 class="d-inline">{{ $titulo }}</h1>
	<div class="pull-right">
		<a href="{{ url('admin/anuncios') }}" style="display: inline;">
			<button type="button" class="btn btn-default btn-sm">Volver</button></a>
		</a>
		<a href="{{ url('admin/anuncios/editar/'.$anuncio->id) }}" class="d-inline">
			<button type="button" class="btn btn-success btn-sm">Editar</button></a>
		</a>
		<!--Eliminar-->
		<form method="post" action="{{ url('admin/anuncios/eliminar/'.$anuncio->id)}}" class="d-inline" onsubmit="return confirm('Confirma que desea eliminar el elemento?');">
			@csrf
			<button type="submit" class="btn btn-danger btn-sm">Eliminar</button></a>
		</form>
	</div>

@stop

@section('content')
	@include('anuncios.ver-content')
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('/slick/slick.js') }}"></script>
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
		$('.fotos').slick({
		  	slidesToShow: 1,
		  	slidesToScroll: 1,
		  	arrows: false,
		  	fade: true,
		  	asNavFor: '.fotos-mini'
		});
		$('.fotos-mini').slick({
		  	slidesToShow: 5,
		  	slidesToScroll: 1,
		  	asNavFor: '.fotos',
		  	centerMode: true,
		  	focusOnSelect: true,
		  	arrows: true,
		});
	});
		
	
</script>
@endsection