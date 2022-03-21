@extends('layouts.master')

@section('titulo', 'Ver Anuncio')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('/slick/slick.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('/slick/slick-theme.css') }}"/>
<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
<link rel="stylesheet" href="{{ asset('css/fondo.css') }}">
@endsection

@section('body')
<br><br><br>
<div  class="container mt-3">
	<div class="row">
		<div class="col-sm-5 col-md-4 col-lg-3 order-last order-sm-first">
			<div id="bas" class="bg-secondary py-5 text-center text-white mb-3">
			<span id="spananuncio">Anuncia aquí</span>
			</div>
			<div id="bas" class="bg-secondary py-5 text-center text-white mb-3">
			<span id="spananuncio">Anuncia aquí</span>
			</div>
			<div id="bas" class="bg-secondary py-5 text-center text-white mb-3">
			<span id="spananuncio">Anuncia aquí</span>
			</div>
			<div id="bas" class="bg-secondary py-5 text-center text-white mb-3">
			<span id="spananuncio">Anuncia aquí</span>
			</div>
			<div id="bas" class="bg-secondary py-5 text-center text-white mb-3">
			<span id="spananuncio">Anuncia aquí</span>
			</div>
		</div>
		<div class="col-sm-7 col-md-8 col-lg-9">
			@include('anuncios.ver-content')
		</div>
				
	</div>
			
</div>
<!-- Modal -->
<div class="modal fade" id="contactarModal" tabindex="-1" role="dialog" aria-labelledby="tituloContacto" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
		    <div class="modal-header">
		        <h5 class="modal-title" id="tituloContacto">Contacto</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		    </div>
		    <div class="modal-body" id="contenidoModalContacto">
		    	<div class="progress">
				  	<div id="barra_progreso" class="progress-bar progress-bar-striped progress-bar-animated" 
					  role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
				</div>
		    	<div class="form-group">
				    <label for="textContacto">Escribele un mensaje al vendedor para que se ponga en contacto contigo:</label>
				    <textarea class="form-control" id="textContacto" rows="2" placeholder="Hola {{ $vendedor->nombre }}, quisiera 
						informacion sobre este inmueble...">Hola {{ $vendedor->nombre }}, quisiera información sobre este inmueble...</textarea>
				</div>
				@guest
				<div class="form-group">
				    <label for="telefonoContacto">Telefono donde el vendedor te llamara:</label>
				    <input type="text" class="form-control" id="telefonoContacto">
				</div>
				@endguest
		    </div>
		    <div class="modal-footer">
		        <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Cancelar</button>
		        <button type="button" class="btn btn-principal btn-sm" id="botonContactoModal">Contactar</button>
		    </div>
	    </div>
	</div>
</div>
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

		@auth
		$('#favorito_button').click(function(){
			let icono = $('#favorito_icon');
			let texto = $('#favorito_texto');
			
			if(icono.hasClass('fa-heart-o')){
			    $.get( "{{ url('guardar_favorito') }}", { id: {{$anuncio->id}}, tipo: "1" } )
	  				.done(function( data ) {
	    				if(data.response == 'saved'){
	    					icono.removeClass('fa-heart-o');
							icono.addClass('fa-heart');
							texto.empty();
							texto.html('Favorito'); 
	    				}
	  				});
 
			} else {

	  			$.get( "{{ url('guardar_favorito') }}", { id: {{$anuncio->id}}, tipo: "0" } )
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
		$('#favorito_button').click(function(){
			alert('debes iniciar sesion para marcar favoritos!');
		});
		@endguest

		$("#botonContactoModal").click(function(){
			$('#barra_progreso').css('width', '20%');
			//validar textarea
			if($('#textContacto').val().length <= 0){
				$('#textContacto').addClass('is-invalid');
				$('#textContacto').focus();
				return;
			}
			//validar telefono
			@guest
			if($('#telefonoContacto').val().length <= 0){
				$('#telefonoContacto').addClass('is-invalid');
				$('#telefonoContacto').focus();
				return;
			}
			@endguest
			
			$.get( "{{ url('contactar_vendedor') }}", { id: {{$anuncio->id}}, mensaje: $('#textContacto').val() 
			@guest , telefono : $('#telefonoContacto').val() @endguest } )
	  			.done(function( data ) {
	  				$('#barra_progreso').css('width', '100%');
	  				console.log(data);
	  				if(data == 'exito'){
	  					mensaje = '<div class="alert alert-success" role="alert" id="alertaContacto">' + 
						  'Se ha enviado tu mensaje al vendedor</div>';
	  				} else {
	  					mensaje = '<div class="alert alert-danger" role="alert" id="alertaContacto">' + 
						  'Tu mensaje no pudo ser enviado.  Por favor, intenta de nuevo.</div>';
	  				}
	  				$('#contenidoModalContacto').prepend(mensaje);
	  				setTimeout(function() {
	  					$('#alertaContacto').remove();
	  					$('#barra_progreso').css('width', '0%');
				        $('#contactarModal').modal('hide');
				    },2500);
	  			})
				.fail(function() {
					$('#barra_progreso').css('width', '0%');
  				})
		});
	});


	
</script>
@endsection
