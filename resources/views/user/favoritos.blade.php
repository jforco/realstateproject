@extends('layouts.master-user')

@section('titulo', 'Mis Favoritos')

@section('contenido-user')
	<div class="col-md-10 offset-md-1">
		@include('busquedas.vista_lista')
	</div>	

@endsection

@section('js')

<script type="text/javascript">
	$(document).ready(function(){
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
		$('#mis-favoritos').addClass('item-activo');
	});
</script>

@endsection