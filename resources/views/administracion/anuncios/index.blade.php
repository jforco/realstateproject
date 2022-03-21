@extends('adminlte::page')

@section('title', 'Anuncios')

@section('content_header')
    <h1>Anuncios</h1>
@stop

@section('content')
    <p>lista de todos los Anuncios</p>

	<label>Estado</label>
	<select class="segment-select" name="estado_pub" form="publicacion_form" id="select_estado" required>
		<option value="todos" selected>Todos</option>
		<option value="nuevo">Nuevo</option>
		<option value="pendiente">Pendiente</option>
		<option value="aprobado">Aprobado</option>
		<option value="rechazado">Rechazado</option>
		<option value="finalizado">Finalizado</option>
		<option value="vendido">Vendido</option>
		<option value="Por pagar">Por pagar</option>
	</select>

    <div class="table-responsive">
    	<br>
    	<table class="table table-hover table-bordered  bg-white" >

    		<tr class="thead-dark">
			    <th>Codigo</th>
			    <th>Tipo de Inmueble</th>
			    <th>Direccion</th>
			    <th>Tipo de Oferta</th>
			    <th>Precio</th>
			    <th>Moneda</th>
			    <th>Estado</th>
			    <th>Fecha de Creación</th>
			    <th>Acciones</th>
			 </tr>

			<tbody id="datos">
		   
			
			</tbody>
    	</table>
    	
    </div>
	<button  name="pruebap" id="pruebap" class="">pagado!</button>
   
@endsection

@section('js')
<script type="text/javascript">
	$( document ).ready(function() {
		$('.precio').each(function(){
			let nro = $(this).html();
			$(this).html(new Intl.NumberFormat('es-MX').format(nro));
		});
	});
</script>
<script type="text/javascript" src="{{ asset('/js/anuncicosadmin.js') }}"></script>
<script>
	/* js para recoger los datos del contralador con el evento onchange*/
$(document).ready(function(){
	$estado = $("#select_estado").val();
	cargartabla($estado);
	
	$("#pruebap").click(function(){
			pruebapasa();
		});
  
	$("#select_estado").on("change", function() {
		
	  $estado = $("#select_estado").val();
	  cargartabla($estado);
		
	 
	  

  });
});


function pruebapasa($paymentUrl){

$.get( "{{ url('admin/anuncios/pruebapasarela') }}" ).done(function( data ) {
	    				
						var un = data.response;
						window.locationf=un;
				  });

}

function cargartabla($estado){

	$.get( "{{ url('admin/anuncios/filtrarestadoanuncio') }}", { estado: {$estado}} )
	  				.done(function( data ) {
	    				
						
							$("#datos").html("");
							for(var i=0; i<data.response.length; i++){	
								var fecha = data.response[i].created_at;
								$nfecha = fecha.substring(0, 10);
								$fhora = fecha.substring(11,16);
								$fechanew = $nfecha + ' '+ $fhora;
								var tr = `<tr>
								<td>`+data.response[i].codigo+`</td>
								<td>`+data.response[i].tipo_inmueble+`</td>
								<td>`+data.response[i].direccion+`</td>
								<td>`+data.response[i].tipo_oferta+`</td>
								<td>`+data.response[i].precio+`</td>
								<td>`+data.response[i].moneda+`</td>
								<td>`+data.response[i].estado+`</td>
								<td>`+$fechanew+`</td>
								<td>`+ `<a href="{{ url('admin/anuncios/ver/`+data.response[i].id+ `') }}">
						<button type="button d-inline" class="btn btn-info btn-xs"><small>Ver</small></button></a>
					</a>
					
					<a href="{{ url('admin/anuncios/editar/`+data.response[i].id+ `') }}">
						<button type="button d-inline" class="btn btn-default btn-xs"><small>Editar</small></button></a>
					</a>
					
					<form method="post" class="d-inline" action="{{ url('admin/anuncios/eliminar/`+data.response[i].id+ `')}}" onsubmit="return confirm('Confirma que desea eliminar el elemento?');">
						@csrf
						<button type="submit" class="btn btn-danger btn-xs"><small>Eliminar</small></button></a>
					</form>`+`</td>
								</tr>`;
								$("#datos").append(tr)
							}
	  				});
		
	}


</script>

@endsection
