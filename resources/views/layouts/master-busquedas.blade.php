@extends('layouts.master')

@section('titulo')
{{env('SITIO_NAME')}} - {{$tipo_inmueble}}s en {{$tipo_oferta}}
@endsection

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/home-style.css') }}">
@endsection

@section('body')
<br><br>
<div class="bg-light">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-md-3">
				<div class="bg-white shadow shadow-sm p-2 mb-4 mt-sm-4">
					<div class="my-2">
						<button type="button" class="bg-principal btn text-white btn-sm btn-block" data-toggle="collapse" data-target="#formulario_collapse" aria-expanded="true" aria-controls="formulario_collapse">Búsqueda Avanzada</button>
					</div>
					<div class="collapse show" id="formulario_collapse">
						<form method="get" action="{{ url('buscar') }}" id="form_busqueda">
							<div class="row mb-3 no-gutters">
								<div class="col-6">
									<select class="custom-select" name="inmueble" id="inmueble_select" required>
									    @forelse($inmuebles as $inmueble)
									  	<option value="{{ $inmueble }}" >{{ $inmueble }}</option>
									  	@empty
									  	<option>No hay opciones.</option>
									  	@endforelse
									</select>
								</div>
								<div class="col-6 pl-1">
									<select class="custom-select" name="oferta" id="oferta_select" required>
									    @forelse($ofertas as $oferta)
									  	<option value="{{ $oferta }}" >{{ $oferta }}</option>
									  	@empty
									  	<option>No hay opciones.</option>
									  	@endforelse
									</select>
								</div>	
							</div>
								
							<div class="form-group mb-3">
								<select class="custom-select" name="estado" id="estado_select" required>
								    @forelse($estados as $estado)
								  	<option value="{{ $estado->nombre }}" id="{{ $estado->id }}">{{ $estado->nombre }}</option>
								  	@empty
								  	<option>No hay opciones.</option>
								  	@endforelse
								</select>
							</div>	

							<div class="form-group mb-3">
								<select class="custom-select" name="ciudad" id="ciudad_select" required>
								    <option value="none">Todas las ciudades</option>
								</select>
							</div>	
							
							<div class="form-group mb-3">
								<select class="custom-select" name="zona" id="zona_select" required>
								    <option value="none" id="none">Todas las Zonas</option>
								</select>
							</div>	

							<div class="form-group">
								<label>Rango de precios</label>
								<div class="row no-gutters">
									<div class="col-6 pr-2">
										<p class="m-0"><small>Mínimo</small></p>
										<select class="custom-select" name="precio_min" id="precio_min_select">
											
										</select>
									</div>
									<div class="col-6">
										<p class="m-0"><small>Máximo</small></p>
										<select class="custom-select" name="precio_max" id="precio_max_select">
											
										</select>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="pl-3">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="monedas[]" value="dolares" id="moneda-sus">
										<label class="custom-control-label" for="moneda-sus">Dólares</label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="monedas[]" value="bolivianos" id="moneda-bs">
										<label class="custom-control-label" for="moneda-bs">Bolivianos</label>
									</div>
								</div>
							</div>
							
							<div class="form-group">
								<p class="m-0">Dormitorios</p>
								<div class="pl-3">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="dormitorios[]" value="1" id="check1">
										<label for="check1" class="custom-control-label">&nbsp; &nbsp;1 x<i class="fa fa-bed px-2"></i></label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="dormitorios[]" value="2" id="check2">
										<label for="check2" class="custom-control-label">&nbsp; &nbsp;2 x<i class="fa fa-bed px-2"></i></label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="dormitorios[]" value="3" id="check3">
										<label for="check3" class="custom-control-label">&nbsp; &nbsp;3 x<i class="fa fa-bed px-2"></i></label>
									</div>
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" name="dormitorios[]" value="4" id="check4">
										<label for="check4" class="custom-control-label">+4 x<i class="fa fa-bed px-2"></i></label>
									</div>
								</div>
							</div>
							<input type="hidden" name="tipo_vista" value="{{ $tipo_vista }}" id="input_tipo_vista">
							<div class="text-center">
								<button type="submit" class="btn btn-principal"><i class="fa fa-refresh" aria-hidden="true"></i> Buscar</button>
							</div>
						</form>
					</div>
				</div>
			</div>	
			<div class="col-sm-8 col-md-9">
				@yield('busqueda_contenido')
				
			</div>	
		</div>
	</div>
</div>

@endsection
	
@section('js')
<script type="text/javascript">
	var ciudades = @json($ciudades);
	var zonas = @json($zonas);

	var tipo_inmueble = '{{ $tipo_inmueble }}';
	var tipo_oferta = '{{ $tipo_oferta }}';
	var estado = '{{ $estado_seleccionado }}';
	var ciudad = '{{ $ciudad_seleccionada }}';
	var zona = '{{ $zona_seleccionada }}';
	var precio_minimo = '{{ $precio_minimo }}';
	var precio_maximo = '{{ $precio_maximo }}';
	var moneda = '{{ $moneda }}';
	var orden = '{{ $orden }}';
	
	var dormitorios = @json($dormitorios);

</script>
<script src="{{ asset('js/busquedas.js') }}"></script>
 @yield('js-busquedas')
@endsection

	