@extends('layouts.master')

@section('titulo', 'Recuperar Contraseña')

@section('body')
<div class="row mx-0">
	<div class="col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
		<div class="px-4" id="group_vv">
			<br>
			<p class="h3">Olvidaste tu contraseña?</p>
			<p>Por favor, introduce el correo electronico de tu cuenta, para poder recuperar tu contraseña.</p>
			@isset($mensajeError)
			<div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
				<p class="small m-0">{{ $mensajeError }}</p>
				<button type="button" class="close py-1" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endisset
			@isset($mensajeExito)
			<div class="alert alert-success alert-dismissible fade show py-2" role="alert">
				<p class="small m-0">{!! $mensajeExito !!}</p>
				<button type="button" class="close py-1" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endisset
			<form method="post" action="{{ url('recuperacion') }}">
				@csrf
				<input type="email" class="form-control" name="correo" placeholder="Correo electronico"><br>
				<input type="submit" class="form-control btn btn-principal" value="Enviar correo de recuperacion"> 
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