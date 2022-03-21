@extends('layouts.master')

@section('titulo', 'Nueva Contraseña')

@section('body')
<div class="row mx-0">
	<div class="col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
		<div class="px-4" id="group_vv">
			<br>
			<p class="h3">Reestablecer contraseña</p>
			@isset($mensajeError)
			<div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
				<p class="small m-0">{{ $mensajeError }}</p>
				<button type="button" class="close py-1" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endisset
			<p>Introduce la nueva contraseña para tu cuenta:</p>
			<form method="post" action="{{ url('reestablecer_password') }}">
				@csrf
				<input type="hidden" name="token" value="{{ $token }}">
				<label for="password1">Nueva Contraseña</label>
				<input type="password" class="form-control" name="password1" placeholder="Nueva Contraseña" required><br>
				<label for="password2">Repite Nueva Contraseña</label>
				<input type="password" class="form-control" name="password2" placeholder="Repite Nueva Contraseña" required><br>
				<input type="submit" class="form-control btn btn-principal" value="Cambiar a nueva contraseña" required>
			</form>
		</div>
	</div>
</div>
<style>
	#group_vv {
		margin-top: 100px;
	}
</style>
@endsection
@section('js')
<script>
	$(document).ready(function($){
		let ventana_alto = $(window).height();
		let footer_alto = $('#footer_master').height();
		let copy_alto = $('#copyright').height();
		let alto_final = ventana_alto - 104 - footer_alto - copy_alto
		$("#group_vv").height(alto_final);
	});
</script>
@endsection