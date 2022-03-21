@extends('layouts.master')

@section('titulo', 'Plataforma')


@section('body')
<div class="row" style="padding-top: 50px;">
	<div class="col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
		<div class="px-4 mb-5">
			<br><br><br>
			<p class="h3">Escríbenos</p>
			<p>Anota tus datos y tu consulta para que podamos responderte</p>
			<form method="post" action="{{ url('contacto') }}">
				@csrf
				<input class="form-control" type="text" name="nombre" placeholder="Nombre" pattern="[a-zA-Z]+"   required><br>
                <input class="form-control" type="text" name="correo" placeholder="Tu correo electrónico" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  required><br>
                <label for="mensaje" class="form-label">Mensaje:</label>
                <textarea class="form-control mb-4" name="mensaje" id="mensaje" rows="3" placeholder="Mensaje"></textarea>
				
				<div class="px-2 mb-5">
                  <div class="g-recaptcha" data-sitekey="6LeBmxEdAAAAALJmhYDVM1R6Gjq2HTkCXMaFbLhf"></div>
                </div>
                <input type="submit" class="btn btn-principal form-control" value="Enviar mensaje">
			
			</form>
		</div>
			
	</div>
</div>

@endsection