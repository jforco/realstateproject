@extends('layouts.master')

@section('titulo', 'Elige un plan')

@section('css')
    
@endsection

@section('body')
<br><br><br><br>
<form method="post" action="{{ url('nueva_publicacion') }}">
@csrf
<div class="container">
	<br>
	<h3 class="text-center py-2" style="font-weight: bold; background:  linear-gradient(to right, #f98905, #f9971b, #faa52d, #fab23d, #fbbe4d);
			 -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
		">Escoge tu servicio</h3>
	<div class="row mx-md-5 my-4">
		<div class="col-sm-11 col-md-6 col-lg-4">
			<div class="custom-control custom-switch mb-4">
				<input type="checkbox" class="custom-control-input opciones" id="autorenovacion" name="autorenovacion" data-costo=50>
				<label class="custom-control-label" for="autorenovacion">
					<span class="badge badge-dark">50bs</span> Autorenovación
				</label>
				<a href="#" data-toggle="popover" data-trigger="focus" title="Autorenovación" 
				data-content="Tu anuncio se renovará automáticamente cada mes una vez finalizado la duracion de tu anuncio, con los servicios de Anuncios solicitados en su momento.">
					<span class="badge badge-pill badge-secondary">?</span>
				</a>
			</div>
			<div class="custom-control custom-switch mb-4">
				<input type="checkbox" class="custom-control-input opciones opciones_d" id="duracion30" name="duracion30" data-costo=50 data-duracion=30>
				<label class="custom-control-label" for="duracion30">
					<span class="badge badge-dark">50bs</span> Duración 30 días
				</label>
				<a href="#" data-toggle="popover" data-trigger="focus" title="Duración 30 días" 
				data-content="Acumulativo">
					<span class="badge badge-pill badge-secondary">?</span>
				</a>
			</div>
			<div class="custom-control custom-switch mb-4">
				<input type="checkbox" class="custom-control-input opciones opciones_d" id="duracion45" name="duracion45" data-costo=70 data-duracion=45>
				<label class="custom-control-label" for="duracion45">
					<span class="badge badge-dark">70bs</span> Duración 45 días
				</label>
				<a href="#" data-toggle="popover" data-trigger="focus" title="Duración 45 días" 
				data-content="Acumulativo">
					<span class="badge badge-pill badge-secondary">?</span>
				</a>
			</div>
			<div class="custom-control custom-switch mb-4">
				<input type="checkbox" class="custom-control-input opciones opciones_d" id="duracion60" name="duracion60" data-costo=90 data-duracion=60>
				<label class="custom-control-label" for="duracion60">
					<span class="badge badge-dark">90bs</span> Duración 60 días
				</label>
				<a href="#" data-toggle="popover" data-trigger="focus" title="Duración 60 días" 
				data-content="Acumulativo">
					<span class="badge badge-pill badge-secondary">?</span>
				</a>
			</div>
			<div class="custom-control custom-switch mb-4">
				<input type="checkbox" class="custom-control-input opciones" id="destacado" name="destacado" data-costo=100>
				<label class="custom-control-label" for="destacado">
					<span class="badge badge-dark">100bs</span> Anuncio destacado
				</label>
				<a href="#" data-toggle="popover" data-trigger="focus" title="Anuncio destacado" 
				data-content="Tu anuncio se mostrará en primera plana por 15 días, aumentando tus posibilidades de venta.">
					<span class="badge badge-pill badge-secondary">?</span>
				</a>
			</div>
		</div>
		<div class="col-sm-11 col-md-6 col-lg-4">
			<div class="custom-control custom-switch mb-4">
				<input type="checkbox" class="custom-control-input opciones" id="facebook" name="facebook" data-costo=50>
				<label class="custom-control-label" for="facebook">
					<span class="badge badge-dark">50bs</span> Facebook y ADS
				</label>
				<a href="#" data-toggle="popover" data-trigger="focus" title="Facebook y ADS" 
				data-content="Tu anuncio será publicado en nuestra página oficial Lucasas de Facebook y se mostrará en anuncios en Facebook">
					<span class="badge badge-pill badge-secondary">?</span>
				</a>
			</div>
			<div class="custom-control custom-switch mb-4">
				<input type="checkbox" class="custom-control-input opciones" id="whatsapp" name="whatsapp" data-costo=20>
				<label class="custom-control-label" for="whatsapp">
					<span class="badge badge-dark">20bs</span> Difusión Whatsapp
				</label>
				<a href="#" data-toggle="popover" data-trigger="focus" title="Difusión Whatsapp" 
				data-content="Tu anuncio será enviado a clientes e inversores de nuestra base de datos de WhatsApp">
					<span class="badge badge-pill badge-secondary">?</span>
				</a>
			</div>
			<div class="custom-control custom-switch mb-4">
				<input type="checkbox" class="custom-control-input opciones" id="instagram" name="instagram" data-costo=20>
				<label class="custom-control-label" for="instagram">
					<span class="badge badge-dark">20bs</span> Difusión Instagram
				</label>
				<a href="#" data-toggle="popover" data-trigger="focus" title="Difusión Instagram" 
				data-content="Tu anuncio será subido a nuestra página oficial Lucasas en Instagram para todos nuestros clientes, seguidores e inversores">
					<span class="badge badge-pill badge-secondary">?</span>
				</a>
			</div>
			<div class="custom-control custom-switch mb-4">
				<input type="checkbox" class="custom-control-input opciones" id="mailing" name="mailing" data-costo=20>
				<label class="custom-control-label" for="mailing">
					<span class="badge badge-dark">20bs</span> Difusión mailing
				</label>
				<a href="#" data-toggle="popover" data-trigger="focus" title="Difusión mailing" 
				data-content="Tu anuncio será enviado al correo electrónico de todos nuestros usuarios registrados">
					<span class="badge badge-pill badge-secondary">?</span>
				</a>
			</div>
			<div class="custom-control custom-switch mb-4">
				<input type="checkbox" class="custom-control-input opciones" id="borde" name="borde" data-costo=40>
				<label class="custom-control-label" for="borde">
					<span class="badge badge-dark">40bs</span> Anuncio con Borde
				</label>
				<a href="#" data-toggle="popover" data-trigger="focus" title="Anuncio con Borde" 
				data-content="Tu anuncio se verá resaltado entre los demás y captará la atención de los posibles clientes.">
					<span class="badge badge-pill badge-secondary">?</span>
				</a>
			</div>
		</div>
		<div class="col-sm-11 col-md-6 col-lg-4">
			<div class="custom-control custom-switch mb-4">
				<input type="checkbox" class="custom-control-input opciones" id="foto" name="foto" data-costo=250>
				<label class="custom-control-label" for="foto">
					<span class="badge badge-dark">250bs</span> Fotos Profesionales
				</label>
				<a href="#" data-toggle="popover" data-trigger="focus" title="Fotos Profesionales " 
				data-content="Nosotros hacemos el trabajo por ti, el equipo de Lucasas se encargará de sacar las mejores fotos de tu inmueble con edición para resaltar la belleza de tu casa">
					<span class="badge badge-pill badge-secondary">?</span>
				</a>
			</div>
			<div class="custom-control custom-switch mb-4">
				<input type="checkbox" class="custom-control-input opciones" id="video" name="video" data-costo=200>
				<label class="custom-control-label" for="video"> 
					<span class="badge badge-dark">200bs</span> Video Profesional
				</label>
				<a href="#" data-toggle="popover" data-trigger="focus" title="Video 3D " 
				data-content="Nosotros hacemos el trabajo por ti, el equipo de Lucasas se encargará realizar un video profesional, donde se puede ver más detalladamente tu inmueble, para comodidad tuya y del posible cliente (ver video ejemplo). Nota: el servicio tiene una duración de 45 días y no es acumulativo">
					<span class="badge badge-pill badge-secondary">?</span>
				</a>
			</div>
			<div class="custom-control custom-switch mb-4">
				<input type="checkbox" class="custom-control-input opciones" id="recorrido" name="recorrido" data-costo=400>
				<label class="custom-control-label" for="recorrido">
					<span class="badge badge-dark">400bs</span> Recorrido 360
				</label>
				<a href="#" data-toggle="popover" data-trigger="focus" title="Recorrido 360" 
				data-content="Nosotros hacemos el trabajo por ti, el equipo de Lucasas se encargará de la grabación de un video de tu inmueble en 3D para comodidad tuya y del posible cliente (ver video ejemplo).Nota:nel servicio tiene una duración de 45 días y no es  acumulativo">
					<span class="badge badge-pill badge-secondary">?</span>
				</a>
			</div>
			<div class="custom-control custom-switch mb-4">
				<input type="checkbox" class="custom-control-input opciones" id="agente" name="agente" data-costo=50>
				<label class="custom-control-label" for="agente">
					<span class="badge badge-dark">50bs</span> Agente Inmobiliario
				</label>
				<a href="#" data-toggle="popover" data-trigger="focus" title="Agente Inmobiliario" 
				data-content="Lucasas se encarga de asignar tu agente inmobiiario">
					<span class="badge badge-pill badge-secondary">?</span>
				</a>
			</div>
			<div class="custom-control custom-switch mb-4">
				<input type="checkbox" class="custom-control-input" id="gratuito" name="gratuito" data-costo=0>
				<label class="custom-control-label" for="gratuito">
					<span class="badge badge-danger">0bs</span> Gratuito durante 15 días.
				</label>
				<a href="#" data-toggle="popover" data-trigger="focus" title="Gratuito" 
				data-content="¡Sin costo alguno!">
					<span class="badge badge-pill badge-secondary">?</span>
				</a>
			</div>
		</div>
	</div>
	
	<div class="text-center pb-3" id="labelprecio" style="display: none;">
		<h5>
			Anuncio durante <span id="dias_span">15</span> días por <span id="costo_span">0</span> bs.
		</h5>
		<div id="autorenovacion_span"></div>
	</div>
	<div class="text-center">
		<button type="submit" class="btn btn-principal">Continuar!</button>
		
	</div>
	
	<br>
	<br>
</div>	
</form>	

@endsection

@section('js')
<script type="text/javascript">

	$(function () {
		$('[data-toggle="popover"]').popover()
		$('#gratuito').prop('checked', true);
		$("#gratuito").click(function(){
			//todos desactivados
			$('.opciones').prop('checked', false);
			//valores en vista
			$("#dias_span").html("15");
			$("#costo_span").html("0");
			$("#labelprecio").css("display", "none");

		});
	
		$("#autorenovacion").click(function(){
			if($(this).prop('checked')){
				$("#autorenovacion_span").html("con Autorenovación");
			} else {
				$("#autorenovacion_span").html("");
			}
		});
		$(".opciones").click(function(){
			//gratuito desactivado
			$('#gratuito').prop('checked', false);
			$("#labelprecio").css("display", "block");

			//calcular valores
			let costo = 0;
			$(".opciones").each(function( index ) {
				if($(this).prop('checked')){
					costo = costo + parseInt($(this).attr("data-costo"));
				}
			});
			let duracion = 0;
			$(".opciones_d").each(function( index ) {
				if($(this).prop('checked')){
					duracion = duracion + parseInt($(this).attr("data-duracion"));
				}
			});
			//si no hay duracion encendido, encender uno
			if(duracion == 0){
				$("#duracion30").prop('checked', true);
				duracion = 30;
			}
			//valores en vista
			$("#dias_span").html(duracion.toString());
			$("#costo_span").html(costo.toString());
		});
	})


</script>

@endsection