@extends('administracion.master')

@section('title')
	{{ $titulo }}
@endsection

@section('contenido_titulo')
	<h1>{{ $titulo }}</h1>
@stop

@section('css')
	<link rel="stylesheet" href="{{ asset('css/segment.css') }}">
@endsection

@section('contenido')
    <form method="post" action="{{ url('admin/planes/editar/' . $plan->id) }}">
    	@csrf
   		<div class="form-group">
			<label for="nombre">Nombre de Plan</label>
			<input type="text" name="nombre" placeholder="Plan" id="nombre" class="form-control" value="{{ $plan->nombre }}" required>
		</div>
		<div class="form-group">
			<label for="precio">Precio</label>
			<input type="number" name="precio" placeholder="Precio" id="precio" min="0" class="form-control" value="{{ $plan->precio }}" required>
		</div>
		<div class="form-group">
			<label for="foto_vendedor">Foto de Vendedor</label><br>
			<select class="segment-select" name="foto_vendedor" id="foto_vendedor" required>
			  	<option value="no">No</option>
				<option value="si">Si</option>
			</select>
		</div>
		<div class="form-group">
			<label for="prioridad">Prioridad de búsqueda</label><br>
			<select class="segment-select" name="prioridad" id="prioridad" required>
			  	<option value="fecha">Por Fecha</option>
				<option value="baja">Baja</option>
				<option value="media">Media</option>
				<option value="alta">Alta</option>
			</select>
		</div>
		<div class="form-group">
			<label for="icono">Tipo de Icono en el mapa</label>
			<select name="icono" id="icono" required>
			  	<option value="sin icono">Sin icono</option>
			  	<option value="simple">Icono simple</option>
			  	<option value="resaltado">Resaltado</option>
			  	<option value="resaltado negrita">Resaltado en Negrita</option>
			  	<option value="resaltado rojo">Resaltado en Rojo</option>
			</select>
		</div>
		<br>
		<div class="row no-gutters">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="cant_fotos">Cantidad de Fotos</label>
					<input type="number" name="cant_fotos" placeholder="Cantidad de Fotos" id="cant_fotos" class="form-control" min="0" max="20" value="0" required>
				</div>
				<div class="form-group">
					<label for="fotos_empresa">Servicio de Sesion Fotográfica</label><br>
					<select class="segment-select" name="fotos_empresa" id="fotos_empresa" required>
					  	<option value="no">No</option>
					  	<option value="si">Si</option>
					</select>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label for="cant_videos">Cantidad de Videos</label>
					<input type="number" name="cant_videos" placeholder="Cantidad de Videos" id="cant_videos" class="form-control" min="0" max="3" value="0" required>
				</div>
				<div class="form-group">
					<label for="video_empresa">Servicio de Realizacion de Video</label><br>
					<select class="segment-select" name="video_empresa" id="video_empresa" required>
					  	<option value="no">No</option>
					  	<option value="si">Si</option>
					</select>
				</div>
			</div>
		</div>
		<br>
		<div class="row no-gutters">
			<div class="col-sm-6">
				<div class="form-group">
					<label for="facebook">Publicacion en Facebook</label><br>
					<select class="segment-select" name="facebook" id="facebook" required>
					  	<option value="no">No</option>
					  	<option value="si">Si</option>
					</select>
				</div>
				<div class="form-group">
					<label for="portada">Publicacion en la Portada</label><br>
					<select class="segment-select" name="portada" id="portada" required>
					  	<option value="no">No</option>
					  	<option value="si">Si</option>
					</select>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label for="elegir_agente">Elegir Agente</label><br>
					<select class="segment-select" name="elegir_agente" id="elegir_agente" required>
					  	<option value="no">No</option>
					  	<option value="si">Si</option>
					</select>
				</div>
				<div class="form-group">
					<label for="soporte">Soporte Directo</label><br>
					<select class="segment-select" name="soporte" id="soporte" required>
					  	<option value="no">No</option>
					  	<option value="si">Si</option>
					</select>
				</div>
			</div>
		</div>
		<br>
		<div class="form-group">
			<label for="notificaciones">Recibir Notificaciones</label><br>
			<select class="segment-select" name="notificaciones" id="notificaciones" required>
			  	<option value="no">No</option>
				<option value="si">Si</option>
			</select>
		</div>
		<div class="form-group">
			<label for="es_promocion">es Promoción?</label><br>
			<select class="segment-select" name="es_promocion" id="es_promocion" required>
			  	<option value="no">No</option>
				<option value="si">Si</option>
			</select>
		</div>
		<br>
		<button type="submit" class="btn btn-primary">{{ $titulo }}</button>
		<a href="{{ url('admin/planes') }}">
			<button class="btn btn-default">Cancelar</button>
   		</a>
   	</form>

@stop

@section('js')
	<script type="text/javascript">
		
		$("#foto_vendedor option[value='{{ $plan->foto_vendedor }}']").prop('selected', true);

		$("#prioridad option[value='{{ $plan->prioridad }}']").prop('selected', true);
		
		$("#icono option[value='{{ $plan->icono }}']").prop('selected', true);
		
		$("#fotos_empresa option[value='{{ $plan->fotos_empresa }}']").prop('selected', true);

		$("#video_empresa option[value='{{ $plan->video_empresa }}']").prop('selected', true);

		$("#facebook option[value='{{ $plan->facebook }}']").prop('selected', true);

		$("#portada option[value='{{ $plan->portada }}']").prop('selected', true);

		$("#elegir_agente option[value='{{ $plan->elegir_agente }}']").prop('selected', true);

		$("#soporte option[value='{{ $plan->soporte }}']").prop('selected', true);

		$("#notificaciones option[value='{{ $plan->notificaciones }}']").prop('selected', true);

		$("#es_promocion option[value='{{ $plan->es_promocion }}']").prop('selected', true);

	</script>

	<script src="{{ asset('js/segment.js') }}"></script>
	<script type="text/javascript">
		$(".segment-select").Segment();
	</script>

	
@endsection