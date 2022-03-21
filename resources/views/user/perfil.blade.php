@extends('layouts.master-user')

@section('titulo', 'Perfil')

@section('contenido-user')

<h3 class="text-center sombra mb-3">
	<strong>Mi perfil @if($user->agente === 'si') <span>(Registrado como Agente)</span> @endif </strong> 
</h3>
<div class="row">
	<div class="col-sm-6">
		<div class="card shadow mb-4">
			<div class="card-body text-center">
				<h5><strong>Foto de perfil</strong></h5>
			    <img class="avatar" src="{{ asset($user->avatar) }}" alt="{{ $user->nombre }}" id="perfil_img">

			    <form method="post" action="{{ url('cambiarAvatar') }}" enctype="multipart/form-data" class="mt-2">
			    	@csrf
		            <input type="hidden" name="id" value="{{ $user->id }}">
			    	<!--<input type="file" class="form-control-file text-center" name="avatar" id="avatar" accept=".png, .jpg, .jpeg" required>
			    	<button type="submit" class="btn bg-principal text-white py-1 mt-3">Cambiar Foto de Perfil</button>-->
			    	<div class="custom-file">
						<input type="file" class="custom-file-input" name="avatar" id="avatar" accept=".png, .jpg, .jpeg" required>
						<label class="custom-file-label text-left" for="avatar">Elegir nueva foto</label>
					</div>
					<button type="submit" class="btn btn-principal py-1 mt-3">Cambiar Foto de Perfil</button>
			    </form>

			</div>
		</div>
		<div class="card shadow mb-4">
			<div class="card-body text-center">
				<h5><strong>Ser Agente</strong></h5>
				@if($user->agente === 'si')
				<p>Ya eres un Agente!</p>
			    <a href="{{ url('eliminarAgente') }}"><button type="button" class="btn btn-principal2 py-1">Eliminarme como Agente</button></a> 
			    @else
			    <p>Deseas trabajar con nosotros?</p>
			    <a href="{{ url('registrarAgente') }}"><button type="button" class="btn btn-principal py-1">Registrarme como Agente</button></a>
			    @endif			
			</div>
		</div>
	</div>

	<div class="col-sm-6">
		<div class="card shadow mb-4">
			<div class="card-body px-4">
				<h5 class="text-center"><strong>Datos personales</strong></h5>
				<form action="{{ url('edit') }}" method="post">
		            @csrf
		            <input type="hidden" name="id" value="{{ $user->id }}">
		            <div class="form-group">
		            	<label for="nombre">Nombre</label>
		            	<input class="form-control form-control-sm" type="text" name="nombre" value="{{ $user->nombre }}" required>	
		            </div>
		            <div class="form-group">
		            	<label for="correo">Correo Electrónico</label>
			            <input class="form-control form-control-sm" type="text" name="correo" value="{{ $user->correo }}" required readonly>
		            </div>
		            <label for="genero">Género</label><br>
			        <div class="form-check">
		            	<label><input type="radio" name="genero" value="masculino" id="masc"> Masculino</label>
		            	<label><input type="radio" name="genero" value="femenino" id="fem"> Femenino</label>
			        </div>
			        <div id="wrapper">
						<p><b>Agregar teléfonos de contacto</b></p>
						<div class="row no-gutters my-1" id="fila_telefono1">
							<div class="col">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<select id="banderas_telefono1" class="custom-select-sm">
											<option value="+54" data-imagesrc="{{ url('img/icons/banderas/argentina.png') }}">+54</option>
											<option value="+591" data-imagesrc="{{ url('img/icons/banderas/bolivia.png') }}" selected>+591</option>
											<option value="+55" data-imagesrc="{{ url('img/icons/banderas/brasil.png') }}" selected>+55</option>
											<option value="+56" data-imagesrc="{{ url('img/icons/banderas/chile.png') }}" selected>+56</option>
											<option value="+57" data-imagesrc="{{ url('img/icons/banderas/colombia.png') }}" selected>+57</option>
											<option value="+593" data-imagesrc="{{ url('img/icons/banderas/ecuador.png') }}" selected>+593</option>
											<option value="+595" data-imagesrc="{{ url('img/icons/banderas/paraguay.png') }}" selected>+595</option>
											<option value="+51" data-imagesrc="{{ url('img/icons/banderas/peru.png') }}" selected>+51</option>
											<option value="+598" data-imagesrc="{{ url('img/icons/banderas/uruguay.png') }}" selected>+598</option>
											<option value="+58" data-imagesrc="{{ url('img/icons/banderas/venezuela.png') }}" selected>+58</option>
										</select>
									</div>
									<input type="text" class="form-control" name="telefonos[]" id="input_telefono1"/>
									<input type="hidden" name="codigos[]" id="hidden_telefono1">
								</div>
							</div>
							<div class="col-auto">
								<a href="javascript:void(0);" class="remove_button" id="eliminar_telefono1" title="Eliminar"><i class="fa fa-trash px-1" style="color: red;"></i></a>
							</div>
						</div>
						<div class="row no-gutters my-1" id="fila_telefono2">
							<div class="col">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<select id="banderas_telefono2" class="custom-select-sm">
											<option value="+54" data-imagesrc="{{ url('img/icons/banderas/argentina.png') }}" selected>+54</option>
											<option value="+591" data-imagesrc="{{ url('img/icons/banderas/bolivia.png') }}" selected>+591</option>
											<option value="+55" data-imagesrc="{{ url('img/icons/banderas/brasil.png') }}" selected>+55</option>
											<option value="+56" data-imagesrc="{{ url('img/icons/banderas/chile.png') }}" selected>+56</option>
											<option value="+57" data-imagesrc="{{ url('img/icons/banderas/colombia.png') }}" selected>+57</option>
											<option value="+593" data-imagesrc="{{ url('img/icons/banderas/ecuador.png') }}" selected>+593</option>
											<option value="+595" data-imagesrc="{{ url('img/icons/banderas/paraguay.png') }}" selected>+595</option>
											<option value="+51" data-imagesrc="{{ url('img/icons/banderas/peru.png') }}" selected>+51</option>
											<option value="+598" data-imagesrc="{{ url('img/icons/banderas/uruguay.png') }}" selected>+598</option>
											<option value="+58" data-imagesrc="{{ url('img/icons/banderas/venezuela.png') }}" selected>+58</option>
										</select>
									</div>
									<input type="text" class="form-control" name="telefonos[]" id="input_telefono2"/>
									<input type="hidden" name="codigos[]" id="hidden_telefono2">
								</div>
							</div>
							<div class="col-auto">
								<a href="javascript:void(0);" class="remove_button" id="eliminar_telefono2" title="Eliminar"><i class="fa fa-trash px-1" style="color: red;"></i></a>
							</div>
						</div>
			        </div>
		            <input type="submit" class="btn btn-principal py-1 form-control" value="Guardar Cambios">
		        </form>

				<div class="text-right">
					<button type="button" class="btn btn-principal2 btn-sm py-1 mt-4" data-toggle="modal" data-target="#cambiarContra">Cambiar contraseña</button>
					<div class="modal fade" id="cambiarContra" tabindex="-1" role="dialog" aria-labelledby="cambiarContraTitulo" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
								    <h5 class="modal-title" id="cambiarContraTitulo">Cambiar Contraseña</h5>
								    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								        <span aria-hidden="true">&times;</span>
								    </button>
								</div>
								<div class="modal-body">
								    <form method="post" action="{{ url('cambiarContra') }}" class="text-center">
								    	@csrf
								    	<input type="hidden" name="id" value="{{ $user->id }}">
								    	
								        <input class="form-control" type="password" name="password1" placeholder="Contraseña Actual" required><br>
								        <input class="form-control" type="password" name="password2" placeholder="Nueva Contraseña" required><br>
								        <input class="form-control" type="password" name="password3" placeholder="Repita Nueva Contraseña" required><br>

								        <input type="submit" class="btn btn-principal" value="Cambiar Contraseña">
								    </form>
								</div>
							</div>
						</div>
					</div>

			        <button type="button" class="btn btn-danger btn-sm py-1 mt-4" data-toggle="modal" data-target="#eliminarCuenta">Eliminar Cuenta</button>
					<div class="modal fade" id="eliminarCuenta" tabindex="-1" role="dialog" aria-labelledby="eliminarCuentaTitulo" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
								    <h5 class="modal-title" id="eliminarCuentaTitulo">Eliminar Cuenta</h5>
								    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								        <span aria-hidden="true">&times;</span>
								    </button>
								</div>
								<div class="modal-body">
								    <form method="post" action="{{ url('eliminarCuenta') }}">
								    	@csrf
								    	<p>Si eliminas tu cuenta, tus publicaciones tambien se eliminarán.   Esta accion es irreversible.</p>
								        <input type="submit" class="btn btn-danger btn-sm py-0" value="Entiendo, Elimina mi cuenta.">
								    </form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	
@endsection

@section('js')

<script type="text/javascript" src="{{ asset('/js/ddslick.min.js') }}" ></script>

<script type="text/javascript">
	$(document).ready(function(){
		// pre visualizar imagen de perfil
		const $seleccionArchivos = document.querySelector("#avatar"),
		$imagenPrevisualizacion = document.querySelector("#perfil_img");
		
		$seleccionArchivos.addEventListener("change", () => {
			const archivos = $seleccionArchivos.files;
			if (!archivos || !archivos.length) {
				$imagenPrevisualizacion.src = "";
				return;
			}
			const primerArchivo = archivos[0];
			const objectURL = URL.createObjectURL(primerArchivo);
			$imagenPrevisualizacion.src = objectURL;
		});


		$('#perfil').addClass('item-activo');
	    @if($user->genero === 'masculino')
			$("#masc").prop("checked", true);
		@else
			$("#fem").prop("checked", true);
		@endif

		//INICIAR DDSLICK Y EL EVENTO SELECT
		$('#banderas_telefono1').ddslick({
		    width: 80,
		    onSelected: function(selectedData){
		        $('#hidden_telefono1').val(selectedData.selectedData.value);
		    } 
		});
		$('#banderas_telefono1').ddslick('select', {index: 1 });	
		$('#banderas_telefono2').ddslick({
		    width: 80,
		    onSelected: function(selectedData){
		        $('#hidden_telefono2').val(selectedData.selectedData.value);
		    } 
		});
		$('#banderas_telefono2').ddslick('select', {index: 1 });
		//CARGAR DATOS ANTERIORES
		@foreach($user->telefonos as $telefono)
			@switch($telefono->codigo)
				@case('+54')
					$('#banderas_telefono{{$loop->iteration}}').ddslick('select', {index: 0 });			
					@break
				@case('+591')
					$('#banderas_telefono{{$loop->iteration}}').ddslick('select', {index: 1 });			
					@break
				@case('+55')
					$('#banderas_telefono{{$loop->iteration}}').ddslick('select', {index: 2 });			
					@break
				@case('+56')
					$('#banderas_telefono{{$loop->iteration}}').ddslick('select', {index: 3 });			
					@break
				@case('+57')
					$('#banderas_telefono{{$loop->iteration}}').ddslick('select', {index: 4 });			
					@break
				@case('+593')
					$('#banderas_telefono{{$loop->iteration}}').ddslick('select', {index: 5 });			
					@break
				@case('+595')
					$('#banderas_telefono{{$loop->iteration}}').ddslick('select', {index: 6 });			
					@break
				@case('+51')
					$('#banderas_telefono{{$loop->iteration}}').ddslick('select', {index: 7 });			
					@break
				@case('+598')
					$('#banderas_telefono{{$loop->iteration}}').ddslick('select', {index: 8 });			
					@break
				@case('+58')
					$('#banderas_telefono{{$loop->iteration}}').ddslick('select', {index: 9 });			
					@break
				@default
					$('#banderas_telefono{{$loop->iteration}}').ddslick('select', {index: 1 });			
					
			@endswitch

			$('#input_telefono{{$loop->iteration}}').val({{$telefono->telefono}});		
		@endforeach
		
		$('#eliminar_telefono1').click(function(){ 
	        $('#input_telefono1').val(null);
	    });
	    $('#eliminar_telefono2').click(function(){ 
	        $('#input_telefono2').val(null);
	    });
			
	});
</script>
<script type="text/javascript">
    
</script>

@endsection