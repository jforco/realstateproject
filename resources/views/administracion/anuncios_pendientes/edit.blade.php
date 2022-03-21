@extends('administracion.master')

@section('title')
	{{ $titulo }}
@endsection

@section('css')
	<link rel="stylesheet" href="{{ asset('css/segment.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap-toggle.css') }}">
	<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
	<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
@endsection

@section('contenido_titulo')
	<h1>{{ $titulo }}</h1>
@stop

@section('contenido')
    <form method="post" action="{{ url('admin/pendientes/editar/'.$publicacion->codigo) }}" id="publicacion_form">
		@csrf
	</form>
	<div class="row no-gutters">
		@include('anuncios.seccion1-content')
		<br><br><br>
	</div>
	<br>
	<div class="row no-gutters">
		@include('anuncios.seccion2-content')
	</div>
	<br>
	<div class="row no-gutters">
		@include('anuncios.seccion3-content')
	</div>
	<br>
	<div class="row">
		<div class="form-group">
			<label>Estado de la publicación</label>
			<select class="segment-select" name="estado_pub" form="publicacion_form" id="select_estado" required>
				<option value="aprobado" selected>Aprobado y visible</option>
				<option value="rechazado">Rechazado</option>
			</select>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="text-center">
			<a href="{{ url('admin/pendientes') }}">
				<button type="submit" class="btn btn-info btn-lg borde">Cancelar</button>
			</a>
			<button class="btn btn-success btn-lg mx-1 borde" data-toggle="modal" data-target="#mensajeModal">Actualizar <i class="fa fa-paper-plane" aria-hidden="true" id="boton_actualizar"></i></button>
		</div>
	</div>

	<div class="modal fade" id="mensajeModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
			    <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="ModalLabel">Cambiar estado de publicación</h4>
			    </div>
			    <div class="modal-body" id="mensajeBodyModal">
			        
			    </div>
			    <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			        <button type="submit" form="publicacion_form" class="btn btn-success" id="siguiente3">Actualizar</button>
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
		var mapa_marker = 'none';
		var marcas = {{$marcas_elegidas}};

		var latitud = '{{$publicacion->latitud}}';
		var longitud = '{{$publicacion->longitud}}';
		$('option[value="{{$publicacion->estado}}"]').prop('selected', true);
	</script>
	<script type="text/javascript" src="{{ asset('js/dropzone.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/nueva_publicacion.js') }}"></script>
	
	<!-- radio buton en horizontal -->
	<script src="{{ asset('js/segment.js') }}"></script>

	<script type="text/javascript">
		$('#mensajeModal').on('show.bs.modal', function (e) {
			let mensaje = '';
			let estado = $('#select_estado').val();
			if(estado == 'aprobado'){
				mensaje = "<div><p>El anuncio se activará y se hara visible para todos.</p></div>";
			} else if (estado == 'rechazado') {
				mensaje = '<div><p>El anuncio no fue aprobado. Se mantendrá el estado pendiente. ¿Deseas enviarle un mensaje al anunciante indicando el motivo para que pueda arreglarlo?</p><input type="text" name="texto_motivo" class="form-control" form="publicacion_form" placeholder="Motivos"></div>';
			} else {
				console.log('error en estado seleccionado : ' + estado);
			}
			$('#mensajeBodyModal').empty();
		  	$('#mensajeBodyModal').append(mensaje);
		})
	</script>

	
@endsection
