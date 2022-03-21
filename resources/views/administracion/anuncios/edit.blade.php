@extends('adminlte::page')


@section('title')
	{{ $titulo }}
@endsection

@section('css')
	<link rel="stylesheet" href="{{ asset('css/segment.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap-toggle.css') }}">
	<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
	<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
	<style>
		.foto{
			position: relative;
			margin: 3px !important;
			width: 100px;
			height: auto;
		}
		.seleccionado{
			border: 3px solid #4e2963;
			border-radius: 5px;
			margin: 3px !important;
		}
	</style>
@endsection

@section('content_header')
	<h1>{{ $titulo }}</h1>
@stop

@section('content')
    <form method="post" action="{{ url('admin/anuncios/editar/'.$publicacion->codigo) }}" id="publicacion_form" onsubmit="actualizar(event)">
		@csrf
	</form>
	<div class="">
		@include('anuncios.seccion1-content')
	</div>
	<br>
	<div class="">
		@include('anuncios.seccion2-content')
	</div>
	<br>
	<div class="">
		@include('anuncios.seccion3-content')
		
	</div>
	<br>
	<div class="">
		<div>
			<label>Estado de la publicación</label>
		</div>
		<div class="form-group">
			<select class="segment-select" name="estado_pub" id="pubestado" form="publicacion_form" required>
				<option value="pendiente">Pendiente</option>
				<option value="aprobado">Aprobado y Visible</option>
				<option  value="rechazado">Rechazado</option>
				
			</select>
		
			
			
		</div>
		<input type="text" id="mensajerechazado" name="mensajerechazado" form="publicacion_form"  class="form-control " placeholder="Detalle el motivo del rechazo de la publicación" style="display: none;">
	</div>
	<br>
	<div class="mb-4">
		<div class="text-center">
			<a href="{{ url('admin/anuncios') }}">
				<button type="submit" class="btn btn-info btn-lg borde">Cancelar<i class="fa fa-paper-plane" aria-hidden="true"></i></button>
			</a>
			<button type="submit" form="publicacion_form" class="btn btn-success btn-lg mx-1 borde" id="siguiente3">Actualizar <i class="fa fa-paper-plane" aria-hidden="true"></i></button>
		</div>
	</div>

	<div class="modal" id="modalmensaje" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" name="mensajere" id="mensajere" oninput="actualizarValorMensaje()">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" >guardo</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
	
@stop

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
		var marcas = {{$marcas_elegidas}};

		var latitud = '{{$publicacion->latitud}}';
		var longitud = '{{$publicacion->longitud}}';
		$('option[value="{{$publicacion->estado}}"]').prop('selected', true);
	</script>
	<script type="text/javascript" src="{{ asset('js/dropzone.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/nueva_publicacion.js') }}"></script>
	
	<!-- radio buton en horizontal -->
	<script src="{{ asset('js/segment.js') }}"></script>
	<script>




function actualizarValorMensaje() {
			let mensaje = document.getElementById("mensajere").value;
			//Se actualiza en municipio inm
			document.getElementById("mensajerechazado").value = mensaje;
		}

	function actualizar(event){
		// esta linea detiene la ejecucion del submit
		event.preventDefault();
		$('#alerta2').remove();
		//validar que los inputs estan rellenados
		//to access DOM element, get first element from jquery object
		var input1 = $('#ciudad_select')[0];
		var input2 = $('#zona_select')[0];
		var input3 = $('#sup_terreno')[0];
		//validator for map' input, move the pointer
		var input4 = $('#posx').val();
		var input5 = $('#posy').val();
		var input6 = $('#mensajerechazado').val();

		
		let estado = document.getElementById("pubestado").value;
		if(input1.checkValidity() && input2.checkValidity() && input3.checkValidity() && input4 && input5){
			if(estado == "rechazado")
			{
				if(input6==""){
					$('#mensajerechazado').addClass('is-invalid');
				}else{
					event.target.submit();
				}	

			}else{
				event.target.submit();
			}
		
			
		} else {
			if(!input1.checkValidity()){
				$('#ciudad_select').addClass('is-invalid');
			}
			if(!input2.checkValidity()){
				$('#zona_select').addClass('is-invalid');
			}
			if(!input3.checkValidity()){
				$('#sup_terreno').addClass('is-invalid');
			}
			if(!input4 || !input5){
				//lanzar mensaje error
				$('#ModalMensaje').modal('show');
			}
			$("#titulo-tab2").after('<div class="alert alert-danger mx-4" ' + 
				'role="alert" id="alerta2">Por favor, rellena los espacios necesarios' + 
				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">' + 
				'<span aria-hidden="true">&times;</span></button></div>');
		}
	}

	$(document).ready(function(){
      $('body').on('click', 'span', function(){

       var val = $(this).attr('value');
	   if(val == "rechazado"){
        $("#mensajerechazado").css("display","block");
	   }
	   if(val != "rechazado"){
		$("#mensajerechazado").css("display","none");  
	   }
      })
    })
	</script>

@endsection
