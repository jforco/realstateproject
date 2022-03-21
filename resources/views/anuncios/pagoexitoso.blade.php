@extends('layouts.master')

@section('titulo', 'Pago Recibido')

@section('css')
    
@endsection

@section('body')
<br><br><br><br>

@csrf
<div class="container " style="text-align: center;
    font-size: 42px;
    font-weight: bold;">
<label for="asd">TRANSACCIÓN EN PROCESO..</label>
</div>	

<div class="d-flex justify-content-center mt-3 h-100">
    <div class="d-flex align-items-center align-self-center cardpago p-3 text-center cookies">
		<img src="https://images.vexels.com/media/users/3/157931/isolated/lists/604a0cadf94914c7ee6c6e552e9b4487-icono-de-circulo-de-marca-de-verificacion-curvo.png" width="50">
		<span class="mt-2">¡Muchas gracias! <br> Tu compra está siendo procesada y se encuentra pendiente de confirmación. Recibirás un correo electrónico para actualizaciones.<br> </span>
		<a class="d-flex align-items-center" href="#">mas informacion<i class="fa fa-angle-right ml-2"></i></a>
		<a class="d-flex align-items-center"  href="{{ url('mis-anuncios') }}"><button class="btn btn-principal mt-3 px-4" type="button" >Listo</button></a>
		 </div>
</div>
<br>
<br>
<br>


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