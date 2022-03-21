@extends('adminlte::page')


@section('title')
	{{ $titulo }}
@endsection

@section('content_header')
	<h1>{{ $titulo }}</h1>
@stop

@section('content')
	<form method="post" action="{{ url('admin/lugares/registrar') }}">
    	@csrf
    	<div class="form-group">
			<label for="nombre">Lugar</label>
			<input type="text" name="nombre" placeholder="Nombre" id="nombre" class="form-control" value="" required>
		</div>

		<br>
		<label>Tipo de Lugar</label>
		<select name="tipo" id="select_tipo">
			<option value="Pais" selected>Pais</option>
			<option value="Estado">Estado</option>
			<option value="Ciudad">Ciudad</option>
			<option value="Zona">Zona</option>
		</select>
		<br><br>

		<label>Lugar al que pertenece</label>
		<select name="lugar" id="select_pertenece">
		</select>

		<div id="map" style="height: 300px; width: 300px; background-color: #777;"></div>
		
		<br>
		<button type="submit" class="btn btn-primary">{{ $titulo }}</button>
		<a href="{{ url('admin/lugares') }}">
			<button class="btn btn-default">Cancelar</button>
   		</a>
   		<br>
   		<div class="form-group">
			<label for="posx">Latitud</label>
			<input type="text" name="posx" placeholder="Posicion X" id="posx" class="form-control" value="" required>
		</div>
		<div class="form-group">
			<label for="posy">Longitud</label>
			<input type="text" name="posy" placeholder="Posicion Y" id="posy" class="form-control" value="" required>
		</div>
    </form>

    <br>
    

@stop

@section('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhkI0X1WScJL0AF-aBVXyYnfi6BJjDleg&callback=initMap"
    defer></script>
<script type="text/javascript" src="{{ asset('js/gmaps.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		var lugares = @json($lugares);

		function centrar_mapa(latitud = -16.061374, longitud = -64.760094, zoom1 = 5){
			
			map = new GMaps({
			  	div: '#map',
			  	zoom: zoom1,
			  	lat: latitud, 
			  	lng: longitud,

			  	click: function(e) {
			  		$('#posx').val(e.latLng.lat());
			  		$('#posy').val(e.latLng.lng());
			  		map.removeMarkers();
			    	map.addMarker({
					  	lat: e.latLng.lat(),
					  	lng: e.latLng.lng(),
					  	title: 'none',
					  	draggable: true,
					  	dragend: function(e){
					  		$('#posx').val(e.latLng.lat());
			  				$('#posy').val(e.latLng.lng());
					  	}
					});
			  	}
			});
			$('#posx').val(latitud);
			$('#posy').val(longitud);
			map.addMarker({
				lat: latitud, 
			  	lng: longitud,
				title: 'posicion geografica',
				draggable: true,
				dragend: function(e){
					$('#posx').val(e.latLng.lat());
			  		$('#posy').val(e.latLng.lng());
				}
			});
		}
		function cargar_pertenece(){
			$('#select_pertenece').empty();

			let tipo = $('#select_tipo').val();
		  	let tipo_select = '';
		  	switch(tipo) {
			  	case 'Estado':
			    	tipo_select = 'Pais';
			    	break;
			  	case 'Ciudad':
			    	tipo_select = 'Estado';
			    	break;
			  	case 'Zona':
			    	tipo_select = 'Ciudad';
			    	break;
			  	default:
			    	tipo_select = 'Ninguno';
			    	$('#select_pertenece').append('<option value="0" selected>Ninguno</option>');	
			    	return;
			} 

			lugares.forEach(function(lugar) {
				if(lugar.tipo == tipo_select){
					$('#select_pertenece').append('<option value="' + lugar.id + '">' + lugar.nombre + '</option>');
				}
			});
		}

		//carga por defecto en pais
		
		cargar_pertenece();
		centrar_mapa();
		$('#select_tipo').change(function() {
			cargar_pertenece();
		});

		$('#select_pertenece').change(function() {
			let lugar_id = $('#select_pertenece').val();
			lugares.forEach(function(place){
				if(place.id == lugar_id){
					let zoom = 5;
					switch(place.tipo) {
					  	case 'Estado':
					    	zoom = 8;
					    	break;
					  	case 'Ciudad':
					    	zoom = 12;
					    	break;
					  	case 'Zona':
					    	zoom = 16;
					    	break;
					  	default:
					    	break;
					}
					centrar_mapa(place.posX, place.posY, zoom);		
				}
			});
		});
		
	});
</script>
@stop