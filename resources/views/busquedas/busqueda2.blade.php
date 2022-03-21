@extends('layouts.master-busquedas')

@section('busqueda_contenido')
	<br>
	<div class="row no-gutters justify-content-end text-right pb-1">
		<div class="col-auto">
		<label class="text-black-50 mb-1 pr-3">{{ $anuncios->total() }} resultados</label>	
		</div>
		<div class="col-auto">
			<select name="orden" id="orden_select" form="form_busqueda" class="custom-select custom-select-sm">
				<option value="reciente">Mas reciente primero</option>
				<option value="barato">Precio mas bajo primero</option>
				<option value="caro">Precio mas alto primero</option>
			</select>	
		</div>
	</div>
	<div>
		<div id="map" style="background-color: #777;"></div>
	</div>
	<br>
	<div>
		{{ $anuncios->links() }}
	</div>
	@include('busquedas.vista_lista')

@endsection

@section('js-busquedas')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhkI0X1WScJL0AF-aBVXyYnfi6BJjDleg&callback=initMap" defer></script>
<script type="text/javascript" src="{{ asset('js/markerclusterer.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/gmaps.js') }}"></script>
<script type="text/javascript">
	function precio_separador(precio){
		return new Intl.NumberFormat('es-MX').format(precio);
	}
</script>
<script type="text/javascript">
	$( document ).ready(function() {
		let latX = '{{ $latitud_mapa }}';
		let longY = '{{ $longitud_mapa }}';
		var map = new GMaps({
			div: '#map',
			zoom: 12,
			height: '60vh',
			width: '100%', 
			lat: latX, 
			lng: longY,
			//mapType: 'terrain',
			/*markerClusterer: function(map) {
		        markerCluster = new MarkerClusterer(map, [], {
		            title: 'Location Cluster',
		            //maxZoom: 13,
		            minimumClusterSize: 2,
		            gridSize: 75,
		            imagePath: '{{ asset("/img/icons/m") }}',
		        });
		        return markerCluster;
		    }*/
		});
		@foreach($anuncios as $anuncio)

			var icono{{$anuncio->codigo}} = {
				url: '{{ asset("/img/icons/diamante.png") }}',
			    scaledSize: new google.maps.Size(30, 30)
			}				
			// Create marker
			let precio{{$anuncio->codigo}} = precio_separador({{$anuncio->precio}});
			var marcador{{$anuncio->codigo}} = map.addMarker({
				lat: {{$anuncio->latitud}}, 
			  	lng: {{$anuncio->longitud}},
			  	infoWindow: {
				  	content: '<img src="{{ asset('publicaciones/thumbnails/'.str_replace('.jpg','-mini.jpg',$anuncio->portada)) }}" alt="{{$anuncio->codigo}}" width="100px" class="mb-1"><p class="m-0">@if($anuncio->moneda == "dolares") $us. @else Bs. @endif '+ precio{{$anuncio->codigo}} +'</p><p class="m-0 small">{{$anuncio->tipo_inmueble}} en {{$anuncio->tipo_oferta}}</p><p class="m-0 small"><a href="{{ url('anuncios/'.$anuncio->codigo) }}" type="button" class="btn bg-principal text-white btn-sm py-0 px-1" target="blank"><span class="small">Ver inmueble</span></a></p>',
				},
				icon: icono{{$anuncio->codigo}},
			});
		@endforeach

		$('.ver_mapa').click(function(){
			console.log(map);
			map.markers.forEach(function(element){
				element.infoWindow.close();
			});
		    codigo = $(this).attr('data-codigo');
		    eval('marcador'+codigo+'.infoWindow.open(map.map, marcador'+codigo+')');
		    $([document.documentElement, document.body]).animate({
		        scrollTop: 0
		    }, 700);
		});

		@auth
		$('.opcion_favorito').click(function(){
			let icono = $('#favorito_icon', this);
			let texto = $('#favorito_texto', this);
			let id_anuncio = $('#id_anuncio', this).text();
					
			if(icono.hasClass('fa-heart-o')){
			    $.get( "{{ url('guardar_favorito') }}", { id: id_anuncio, tipo: "1" } )
		  			.done(function( data ) {
		    			if(data.response == 'saved'){
		    				icono.removeClass('fa-heart-o');
							icono.addClass('fa-heart');
							texto.empty();
							texto.html('Favorito'); 
		    			}
		  			});
		 
			} else {

		  		$.get( "{{ url('guardar_favorito') }}", { id: id_anuncio, tipo: "0" } )
		  			.done(function( data ) {
		    			if(data.response == 'deleted'){
		    				icono.removeClass('fa-heart');
							icono.addClass('fa-heart-o');
							texto.empty();
							texto.html('Marcar Favorito'); 
		    			} else {
		    				alert(data.response);
		    			}
		  			});
					
			}
			$(this).removeClass('animated pulse');
			$(this).addClass('animated pulse');
		});  
		@endauth
		@guest
		$('.opcion_favorito').click(function(){
			alert('debes iniciar sesion para marcar favoritos!');
		});
		@endguest  
	});
	
</script>
@endsection
