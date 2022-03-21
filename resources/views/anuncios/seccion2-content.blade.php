<h4 class="text-center" id="titulo-tab2">Descripción del Inmueble</h4>

<div class="row mx-3">
	<div class="col-md-6">
		<h5><b><i class="fa fa-map-marker" aria-hidden="true"></i> Ubicación geográfica</b></h5>

		<div class="input-group input-group-sm">
			<div class="input-group-prepend">
			    <label class="input-group-text" for="estado_select">Estado</label>
			</div>
			<select class="custom-select py-0" id="estado_select" name="estado_lugar" form="publicacion_form" required>
			    @forelse($estados as $estado)
			  	<option value="{{ $estado->nombre }}" id="{{ $estado->id }}">{{ $estado->nombre }}</option>
			  	@empty
			  	<option>No hay opciones.</option>
			  	@endforelse
			</select>
		</div>
		
		<div class="input-group input-group-sm mt-3" id="ciudad_div">
			<div class="input-group-prepend">
			    <label class="input-group-text" for="ciudad_select">Ciudad</label>
			</div>
			<select class="custom-select py-0" id="ciudad_select" name="ciudad" form="publicacion_form" required>
			    <option value="none">Todas las ciudades</option>
			</select>
		</div>
		

		<div class="input-group input-group-sm mt-3" id="zona_div">
			<div class="input-group-prepend">
			    <label class="input-group-text" for="zona_select">Zona</label>
			</div>
			<select class="custom-select py-0" id="zona_select" name="zona" form="publicacion_form" required>
				<option value="none" id="none">Todas las Zonas</option>
			</select>
		</div>
		

		<p class="m-0 small">(haz click en la ubicacion exacta, o arrastra el marcador rojo hasta ella en el mapa)</p>
		<div id="map" style="background-color: #777;"></div>
		<div class="form-group pt-2 my-0">
			<label class="my-0">Precisión: </label>
			<select class="segment-select" form="publicacion_form" name="precision" required>
				<option value="exacta" selected>Exacta</option>
				<option value="aproximada">Aproximada</option>
			</select>
		</div>
		<input type="hidden" id="posx" name="posX" form="publicacion_form" required>
		<input type="hidden" id="posy" name="posY" form="publicacion_form" required>
	</div>

	<div class="col-md-6">
		<h5><b><i class="fa fa-tasks" aria-hidden="true"></i> Características del inmueble</b></h5>

		<div class="input-group input-group-sm mb-3">
			<div class="input-group-prepend">
			    <label class="input-group-text">Sup. terreno</label>
			</div>
			<input type="number" name="sup_terreno" id="sup_terreno" placeholder="Ej. 360" class="form-control" form="publicacion_form" min="1" max="100000" value="{{$publicacion->sup_terreno}}" required>
			<div class="input-group-append">
			    <label class="input-group-text">m2</label>
			</div>
		</div>

		<div class="input-group input-group-sm mb-3">
			<div class="input-group-prepend">
			    <label class="input-group-text">Sup. construida</label>
			</div>
			<input type="number" name="sup_construida" id="sup_construida" placeholder="Ej. 100" class="form-control" form="publicacion_form" min="0" max="10000" value="{{$publicacion->sup_construido}}">
			<div class="input-group-append">
			    <label class="input-group-text">m2</label>
			</div>
		</div>

		<div class="input-group input-group-sm mb-3">
			<div class="input-group-prepend">
			    <label class="input-group-text">Sup. terraza</label>
			</div>
			<input type="number" name="sup_terraza" placeholder="Ej. 20" class="form-control" form="publicacion_form" min="0" max="1000" value="{{$publicacion->sup_terraza}}">
			<div class="input-group-append">
			    <label class="input-group-text">m2</label>
			</div>
		</div>

		<div class="row my-3">
			<div class="col px-3">
				<label class="my-0 small">Dormitorios</label>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend">
						<button type="button" class="input-group-text botones" id="d1"><i class="fa fa-plus" aria-hidden="true"></i></button>
					</div>
					<input type="number" name="dormitorios" id="dormitorios" form="publicacion_form" class="form-control form-numeros" value="0" min="0">
					<div class="input-group-append">
					    <button type="button" class="input-group-text botones" id="d2"><i class="fa fa-minus" aria-hidden="true"></i></button>
					</div>
				</div>
				<label class="my-0 small">Baños</label>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend">
						<button type="button" class="input-group-text botones" id="b1"><i class="fa fa-plus" aria-hidden="true"></i></button>
					</div>
					<input type="number" name="baños" id="baños" form="publicacion_form" class="form-control form-numeros" value="0" min="0">
					<div class="input-group-append">
					    <button type="button" class="input-group-text botones" id="b2"><i class="fa fa-minus" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
			<div class="col px-3">
				<label class="my-0 small">Pisos</label>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend">
						<button type="button" class="input-group-text botones" id="p1"><i class="fa fa-plus" aria-hidden="true"></i></button>
					</div>
					<input type="number" name="pisos" id="pisos" form="publicacion_form" class="form-control form-numeros" value="0" min="0">
					<div class="input-group-append">
					    <button type="button" class="input-group-text botones" id="p2"><i class="fa fa-minus" aria-hidden="true"></i></button>
					</div>
				</div>
				<label class="my-0 small">Parqueos</label>
				<div class="input-group input-group-sm mb-2">
					<div class="input-group-prepend">
						<button type="button" class="input-group-text botones" id="g1"><i class="fa fa-plus" aria-hidden="true"></i></button>
					</div>
					<input type="number" name="parqueos" id="parqueos" form="publicacion_form" class="form-control form-numeros" value="0" min="0">
					<div class="input-group-append">
					    <button type="button" class="input-group-text botones" id="g2"><i class="fa fa-minus" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
		</div>

		<div class="input-group input-group-sm mb-3">
			<div class="input-group-prepend">
			    <label class="input-group-text">Año de construcción</label>
			</div>
			<!--
			<input type="number" name="año_constr" form="publicacion_form" placeholder="Ej. 2010" class="form-control form-año" min="1980" max="2020">
			-->
			<select class="custom-select py-0" name="año" form="publicacion_form" id="año_construccion" required>
			    @for ($i = $año; $i > 1979; $i--)
				<option value="{{ $i }}">{{ $i }}</option>
				@endfor
			</select>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-sm-6">
					<div class="checkbox">
					  	<label class="small">
						   	<input data-toggle="toggle" data-on="Si" data-off="No" form="publicacion_form" name="elevador" id="elevador-toggle" type="checkbox">Elevador
					  	</label>
					</div>
					<div class="checkbox">
						<label class="small">
						   	<input data-toggle="toggle" data-on="Si" data-off="No" form="publicacion_form" name="piscina" id="piscina-toggle" type="checkbox">Piscina
						</label>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="checkbox">
						<label class="small">
						   	<input data-toggle="toggle" data-on="Si" data-off="No" form="publicacion_form" name="baulera" id="baulera-toggle" type="checkbox">Baulera
						</label>
					</div>
					<div class="checkbox">
						<label class="small">
						   	<input data-toggle="toggle" data-on="Si" data-off="No" form="publicacion_form" name="amoblado"
						   	id="amoblado-toggle" type="checkbox">Amoblado
						</label>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@component('layouts.mensajeModal')
    @slot('mensajeModal', 'Por favor, mueve el cursor del mapa e indicanos la ubicación de tu inmueble.')
@endcomponent