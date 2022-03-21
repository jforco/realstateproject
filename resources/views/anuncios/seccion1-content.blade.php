<h4 class="text-center" id="titulo-tab1">Datos del Anuncio</h4>
<div class="row mx-3">
	<div class="col-md-6">
		<h5><b><i class="fa fa-map-signs" aria-hidden="true"></i> Contenido de la publicación</b></h5>
		<div class="form-group mb-1">
	  		<label for="direccion">Dirección del inmueble</label>
	  		<textarea id="direccion" name="direccion" class="form-control form-control-sm" form="publicacion_form" placeholder="Dirección" rows="1" maxlength="254" required>{{ $publicacion->direccion }}</textarea>
	  	</div>
		<div class="form-group">
			<label for="descripcion">Descripción del inmueble</label>
			<textarea id="descripcion" name="descripcion" class="form-control form-control-sm" form="publicacion_form" placeholder="Descripción" rows="2" maxlength="254" >{{ $publicacion->descripcion }}</textarea>
		</div>
		<div class="form-group mb-1">
			<label>Tipo de Inmueble: </label><br>
			<select class="custom-select mb-3" name="inmueble" form="publicacion_form" required>
				@forelse($inmuebles as $inmueble)
				<option value="{{ $inmueble }}" >{{ $inmueble }}</option>
				@empty
				<option>No hay opciones.</option>
				@endforelse
			</select>
		</div>
		<div class="form-group mb-1">
			<label>Estado de inmueble: </label>
			<select class="segment-select" name="estado" form="publicacion_form" required>
				<option value="usado">Usado</option>
				<option value="nuevo">A estrenar</option>
			</select>
		</div>
	</div>
	<div class="col-md-6">
		<h5><b><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Datos de la oferta</b></h5>
		<div class="form-group mb-1">
			<label>Tipo de Oferta</label><br>
			<select class="segment-select" name="oferta" form="publicacion_form" required>
				@forelse($ofertas as $oferta)
			  	<option value="{{ $oferta }}">{{ $oferta }}</option>
			  	@empty
			  	<option>No hay opciones.</option>
			  	@endforelse
			</select>
		</div>
		<div class="form-group">
			<label>Precio: </label>
			<div class="input-group mb-3">
				<input type="number" name="precio" id="precio" placeholder="Ejem.:10,000" class="form-control form-control-sm" aria-describedby="moneda" min="10" max="9999999" form="publicacion_form" value="{{ $publicacion->precio }}" required>
				<div class="input-group-append">
				    <select class="segment-select" form="publicacion_form" id="moneda" name="moneda" required>
					  	<option value="bolivianos">Bs.</option>
					  	<option value="dolares" selected>$us.</option>
					</select>
				</div>
			</div>
		</div>
		<div class="form-group mb-2">
			<label>Entrega: </label>
			<select class="segment-select" name="entrega" form="publicacion_form" id="entrega" required>
				<option value="inmediato" selected>Entrega inmediata</option>
				<option value="fecha" id="fecha_select">Fecha</option>
			</select>
		</div>
		<label>Marcas usadas en la construcción del inmueble:<br>(puedes seleccionar varias)</label><br>
		<select class="custom-select" size="5" name="marcas[]" id="select-marcas" multiple form="publicacion_form">
			<option>Ninguna</option>
			@foreach($marcas as $marca)
		  	<option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
		  	@endforeach
		</select>			
	</div>
</div>