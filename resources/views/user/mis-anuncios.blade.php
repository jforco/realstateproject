@extends('layouts.master-user')

@section('titulo', 'Mis Anuncios')

@section('contenido-user')

<h3 class="text-center sombra mb-3">
	<strong>Mis Anuncios</strong> 
</h3>
<div class="row">
	<div class="col-lg-6">
		<div class="card shadow mb-3">
			<div class="card-body">
				<div class="text-center">
					<button class="btn btn-sm btn-principal mb-2" type="button" data-toggle="collapse" data-target="#pendientes_collapse" aria-expanded="false" aria-controls="pendientes_collapse"><strong>Anuncios pendientes ({{$pendientesCount}}) </strong><i class="fa fa-arrow-down" aria-hidden="true"></i></button>
				</div>
				<p class="small">Estos anuncios estan en espera de revisión por parte de nuestros moderadores. Puedes editarlos aun en esta etapa.</p>
				<div class="collapse multi-collapse" id="pendientes_collapse">
				    @forelse($pendientes as $pendiente)
				    <div class="card mb-3 cuadro-anuncio">
				    	<a href="{{ url('anuncios/'.$pendiente->codigo) }}" class="link" target="blank">
					    	<div class="card-body pt-2 pb-4">
					    		<p class="my-0">
					    			<strong>Anuncio {{$pendiente->codigo}}</strong>
					    		</p>
					    		<div class="row no-gutters">
					    			<div class="col-6 col-sm-5">
					    				<label class="m-0 letra-small"><i class="fa fa-money" aria-hidden="true"></i> 
					    					<span class="precio_separador">{{$pendiente->precio}}</span>
					    					@if($pendiente->moneda == 'dolares') $us. @else Bs. @endif
					    				</label><br>
					    				<label class="m-0 letra-small"><i class="fa fa-exchange" aria-hidden="true"></i> {{ $pendiente->tipo_oferta }}</label>
					    			</div>
					    			<div class="col-6 col-sm-7">
					    				<label class="m-0 letra-small"><i class="fa fa-home" aria-hidden="true"></i> {{ $pendiente->tipo_inmueble }}</label><br>
					    				<label class="m-0 letra-small"><i class="fa fa-bed" aria-hidden="true"></i> {{$pendiente->estado_lugar}} - {{$pendiente->ciudad}} 
					    					@if(!empty($pendiente->zona)) en zona {{$pendiente->zona}} @endif</label>
					    			</div>
					    		</div>
					    		<p class="my-0 small">Actualizado el {{$pendiente->updated_at->format('d/m/Y \a \l\a\s h:i a')}}</p>
					    	</div>
					    </a>
					    <div class="btns-anuncio">
					    	<a href="{{ url('anuncios/'.$pendiente->codigo.'/editar') }}" class="btn btn-sm btn-principal2 py-0" target="blank">Editar</a>
						    <form method="post" action="{{ url('/eliminar_anuncio')}}" class="d-inline" onsubmit="return confirm('Seguro que desea cancelar el anuncio? Esta acción no se puede deshacer');">
								@csrf
								<input type="hidden" name="codigo" value="{{ $pendiente->codigo }}">
								<input type="hidden" name="vista" value="@if($flag) agente @else usuario @endif">
								<button type="submit" class="btn btn-sm btn-danger py-0">Cancelar Anuncio</button>
							</form>
						</div>
					</div>
				    @empty
				    <p>No tienes anuncios? <a href="{{ url('arma_tu_plan') }}" class="btn btn-sm btn-principal2">Publica un nuevo anuncio</a></p>
				    @endforelse
				    <div class="simplePagination">
				    	{{ $pendientes->links() }}
				    </div>
				</div>
			</div>
		</div>
		
		<div class="card shadow mb-3">
			<div class="card-body">
				<div class="text-center">
					<button class="btn btn-sm btn-principal mb-2" type="button" data-toggle="collapse" data-target="#rechazados_collapse" aria-expanded="false" aria-controls="rechazados_collapse"><strong>Anuncios rechazados ({{$rechazadosCount}}) </strong><i class="fa fa-arrow-down" aria-hidden="true"></i></button>
				</div>
				<p class="small">Ups! hay algo que no cuadra en tu anuncio. Revisa y corrige para que se ponga en cola pendiente de revisión.</p>
				<div class="collapse multi-collapse" id="rechazados_collapse">
				    @forelse($rechazados as $rechazado)
				    <div class="card mb-3 cuadro-anuncio">
				    	<a href="{{ url('anuncios/'.$rechazado->codigo) }}" class="link" target="blank">
					    	<div class="card-body pt-2 pb-4">
					    		<p class="my-0">
					    			<strong>Anuncio {{$rechazado->codigo}}</strong>
					    			<span class="badge badge-warning">no aprobado</span>
					    		</p>
					    		<div class="row no-gutters">
					    			<div class="col-6 col-sm-5">
					    				<label class="m-0 letra-small"><i class="fa fa-money" aria-hidden="true"></i> 
					    					<span class="precio_separador">{{$rechazado->precio}}</span>
					    					@if($rechazado->moneda == 'dolares') $us. @else Bs. @endif
					    				</label><br>
					    				<label class="m-0 letra-small"><i class="fa fa-exchange" aria-hidden="true"></i> {{ $rechazado->tipo_oferta }}</label>
					    			</div>
					    			<div class="col-6 col-sm-7">
					    				<label class="m-0 letra-small"><i class="fa fa-home" aria-hidden="true"></i> {{ $rechazado->tipo_inmueble }}</label><br>
					    				<label class="m-0 letra-small"><i class="fa fa-bed" aria-hidden="true"></i> {{$rechazado->estado_lugar}} - {{$rechazado->ciudad}} 
					    					@if(!empty($rechazado->zona)) en zona {{$rechazado->zona}} @endif</label>
					    			</div>
					    		</div>
					    		<p class="my-0 small">Actualizado el {{$rechazado->updated_at->format('d/m/Y \a \l\a\s h:i a')}}</p>
					    	</div>
					    	
					    </a>
					    <div class="btns-anuncio">
					    	<a href="{{ url('anuncios/'.$rechazado->codigo.'/editar') }}" class="btn btn-sm btn-principal2 py-0" target="blank">Editar</a>
						    <form method="post" action="{{ url('/eliminar_anuncio')}}" class="d-inline" onsubmit="return confirm('Seguro que desea cancelar el anuncio? Esta acción no se puede deshacer');">
								@csrf
								<input type="hidden" name="codigo" value="{{ $rechazado->codigo }}">
								<input type="hidden" name="vista" value="@if($flag) agente @else usuario @endif">
								<button type="submit" class="btn btn-sm btn-danger py-0">Cancelar Anuncio</button>
							</form>
						</div>
					</div>
				    @empty
				    <p>No tienes anuncios ni pendientes de revision? <a href="{{ url('arma_tu_plan') }}" class="btn btn-sm btn-principal2">Publica un nuevo anuncio</a></p>
				    @endforelse
				    <div class="simplePagination">
				    	{{ $rechazados->links() }}
				    </div>
				</div>
			</div>
		</div>

	</div>

	<div class="col-lg-6">
		<div class="card shadow mb-3">
			<div class="card-body">
				<div class="text-center">
					<button class="btn btn-sm btn-principal mb-2" type="button" data-toggle="collapse" data-target="#aprobados_collapse" aria-expanded="false" aria-controls="aprobados_collapse"><strong>Anuncios aprobados ({{$activosCount}}) </strong><i class="fa fa-arrow-down" aria-hidden="true"></i></button>
				</div>
				<p class="small">Tus anuncios son visibles en nuestra plataforma. Espera la llamada de alguien interesado en tu anuncio!</p>
				<div class="collapse multi-collapse" id="aprobados_collapse">
					@forelse($activos as $activo)
					<div class="card mb-3 cuadro-anuncio">
						<a href="{{ url('anuncios/'.$activo->codigo) }}" class="link" target="blank">
					    	<div class="card-body pt-2 pb-4">
					    		<p class="my-0">
					    			<strong>Anuncio {{$activo->codigo}}</strong>
					    		</p>
					    		<div class="row no-gutters">
					    			<div class="col-6 col-sm-5">
					    				<label class="m-0 letra-small"><i class="fa fa-money" aria-hidden="true"></i> 
					    					<span class="precio_separador">{{$activo->precio}}</span>
					    					@if($activo->moneda == 'dolares') $us. @else Bs. @endif
					    				</label><br>
					    				<label class="m-0 letra-small"><i class="fa fa-exchange" aria-hidden="true"></i> {{ $activo->tipo_oferta }}</label>
					    			</div>
					    			<div class="col-6 col-sm-7">
					    				<label class="m-0 letra-small"><i class="fa fa-home" aria-hidden="true"></i> {{ $activo->tipo_inmueble }}</label><br>
					    				<label class="m-0 letra-small"><i class="fa fa-bed" aria-hidden="true"></i> {{$activo->estado_lugar}} - {{$activo->ciudad}} 
					    					@if(!empty($activo->zona)) en zona {{$activo->zona}} @endif</label>
					    			</div>
					    		</div>
					    		<p class="my-0 pb-1 small">Publicado el {{$activo->updated_at->format('d/m/Y \a \l\a\s h:i a')}}</p>
					    	</div>
					    </a>
					    <div class="btns-anuncio">
							@if($activo->id_agente > 0)
					    		@if($activo->calificado == 'no')
								   	<button type="button" class="btn btn-sm btn-principal2 py-0" data-toggle="modal" data-target="#calificar_agente" data-codigo="{{$activo->codigo}}" data-usuario="{{$activo->id_usuario}}" data-agente="{{$activo->id_agente}}">
								   		Calificar Agente
									</button> 	
								@else 	
									<button type="button" class="btn btn-sm btn-principal2 py-0" data-toggle="modal" data-target="#calificar_agente" data-codigo="{{$activo->codigo}}" data-usuario="{{$activo->id_usuario}}" data-agente="{{$activo->id_agente}}" data-puntaje="{{$activo->calificacion->puntaje}}" data-comentario="{{$activo->calificacion->comentario}}">
								   		Calificado({{$activo->calificacion->puntaje}})
									</button> 
								@endif
							@endif
							<a href="{{ url('anuncios/'.$activo->codigo.'/editar') }}" class="btn btn-sm btn-principal2 py-0" target="blank">Editar</a>
					    	<form method="post" action="{{ url('/exito_anuncio')}}" class="d-inline" onsubmit="return confirm('Felicidades, tu anuncio fue exitoso! ahora ocultaremos el anuncio');">
								@csrf
								<input type="hidden" name="codigo" value="{{ $activo->codigo }}">
								<input type="hidden" name="vista" value="@if($flag) agente @else usuario @endif">
								<button type="submit" class="btn btn-sm btn-principal2 py-0">Ya se vendio!</button>
							</form>
						   	<form method="post" action="{{ url('/eliminar_anuncio')}}" class="d-inline" onsubmit="return confirm('Seguro que desea cancelar el anuncio? Esta acción no se puede deshacer');">
								@csrf
								<input type="hidden" name="codigo" value="{{ $activo->codigo }}">
								<input type="hidden" name="vista" value="@if($flag) agente @else usuario @endif">
								<button type="submit" class="btn btn-sm btn-danger py-0">Cancelar Anuncio</button>
							</form> 
						</div>
					</div>
				    @empty
				    	@if($activos->count()>0)
				    	<p>Tranquilo, tus anuncios aun siguen en revisión</p>
				    	@else
				    	<p>No tienes anuncios en revisión? <a href="{{ url('arma_tu_plan') }}" class="btn btn-sm btn-success">Publica un anuncio</a></p>
				    	@endif
				    @endforelse
				    <div class="simplePagination">
				    	{{ $activos->links() }}
				    </div>
				</div>
			</div>
		</div>
		
		<div class="card shadow mb-3">
			<div class="card-body">
				<div class="text-center">
					<button class="btn btn-sm btn-principal mb-2" type="button" data-toggle="collapse" data-target="#finalizados_collapse" aria-expanded="false" aria-controls="finalizados_collapse"><strong>Anuncios finalizados ({{$finalizadosCount}}) </strong><i class="fa fa-arrow-down" aria-hidden="true"></i></button>
				</div>
				<p class="small">Un recuento de los anuncios en los que has trabajado. Esperamos haberte ayudado con tus objetivos!</p>
				<div class="collapse multi-collapse" id="finalizados_collapse">
					@forelse($finalizados as $finalizado)
					<div class="card mb-3 cuadro-anuncio">
					   	<div class="card-body pt-2 pb-4">
					   		<p class="my-0">
					   			<strong>Anuncio {{$finalizado->codigo}}</strong>
					   			@if($finalizado->estado == 'vendido')
					   			<span class="badge badge-primary">Vendido</span>
					   			@endif
					   		</p>
					   		<div class="row no-gutters">
					   			<div class="col-6 col-sm-5">
					   				<label class="m-0 letra-small"><i class="fa fa-money" aria-hidden="true"></i> 
					   					<span class="precio_separador">{{$finalizado->precio}}</span>
					   					@if($finalizado->moneda == 'dolares') $us. @else Bs. @endif
					   				</label><br>
					   				<label class="m-0 letra-small"><i class="fa fa-exchange" aria-hidden="true"></i> {{ $finalizado->tipo_oferta }}</label>
					   			</div>
					   			<div class="col-6 col-sm-7">
					   				<label class="m-0 letra-small"><i class="fa fa-home" aria-hidden="true"></i> {{ $finalizado->tipo_inmueble }}</label><br>
					   				<label class="m-0 letra-small"><i class="fa fa-bed" aria-hidden="true"></i> {{$finalizado->estado_lugar}} - {{$finalizado->ciudad}} 
					    					@if(!empty($finalizado->zona)) en zona {{$finalizado->zona}} @endif</label>
					   			</div>
					   		</div>
					   		<p class="my-0 small">Finalizado el {{$finalizado->updated_at->format('d/m/Y \a \l\a\s h:i a')}}</p>
					   	</div>
					   	<div class="btns-anuncio">
							@if($finalizado->id_agente > 0)
					    		@if($finalizado->calificado == 'no')
								   	<button type="button" class="btn btn-sm btn-principal2 py-0" data-toggle="modal" data-target="#calificar_agente" data-codigo="{{$finalizado->codigo}}" data-usuario="{{$finalizado->id_usuario}}" data-agente="{{$finalizado->id_agente}}">
								   		Calificar Agente
									</button> 	
								@else 	
									<button type="button" class="btn btn-sm btn-principal2 py-0" data-toggle="modal" data-target="#calificar_agente" data-codigo="{{$finalizado->codigo}}" data-usuario="{{$finalizado->id_usuario}}" data-agente="{{$finalizado->id_agente}}" data-puntaje="{{$finalizado->calificacion->puntaje}}" data-comentario="{{$finalizado->calificacion->comentario}}">
								   		Calificado({{$finalizado->calificacion->puntaje}})
									</button> 
									
								@endif
							@endif
						</div>
					</div>
				    @empty
				    	<p>Aun no has cancelado ningun anuncio.</p>
				    	<p>Quieres publicar un nuevo anuncio? <a href="{{ url('arma_tu_plan') }}" class="badge badge-success">Publica un anuncio</a></p>
				    @endforelse
				    <div class="simplePagination">
				    	{{ $finalizados->links() }}
				    </div>
				</div>
			</div>
		</div>

	</div>

	<!--nuevo-->
	<div class="col-lg-6">
		<div class="card shadow mb-3">
			<div class="card-body">
				<div class="text-center">
					<button class="btn btn-sm btn-principal mb-2" type="button" data-toggle="collapse" data-target="#nuevos_collapse" aria-expanded="false" aria-controls="nuevos_collapse"><strong>Anuncios nuevos ({{$nuevosCount}}) </strong><i class="fa fa-arrow-down" aria-hidden="true"></i></button>
				</div>
				<p class="small">Tus anuncios son visibles en nuestra plataforma. Espera la llamada de alguien interesado en tu anuncio!</p>
				<div class="collapse multi-collapse" id="nuevos_collapse">
					@forelse($nuevos as $nuevo)
					<div class="card mb-3 cuadro-anuncio">
						<a href="{{ url('anuncios/'.$nuevo->codigo) }}" class="link" target="blank">
					    	<div class="card-body pt-2 pb-4">
					    		<p class="my-0">
					    			<strong>Anuncio {{$nuevo->codigo}}</strong>
					    		</p>
					    		<div class="row no-gutters">
					    			<div class="col-6 col-sm-5">
					    				<label class="m-0 letra-small"><i class="fa fa-money" aria-hidden="true"></i> 
					    					<span class="precio_separador">{{$nuevo->precio}}</span>
					    					@if($nuevo->moneda == 'dolares') $us. @else Bs. @endif
					    				</label><br>
					    				<label class="m-0 letra-small"><i class="fa fa-exchange" aria-hidden="true"></i> {{ $nuevo->tipo_oferta }}</label>
					    			</div>
					    			<div class="col-6 col-sm-7">
					    				<label class="m-0 letra-small"><i class="fa fa-home" aria-hidden="true"></i> {{ $nuevo->tipo_inmueble }}</label><br>
					    				<label class="m-0 letra-small"><i class="fa fa-bed" aria-hidden="true"></i> {{$nuevo->estado_lugar}} - {{$nuevo->ciudad}} 
					    					@if(!empty($nuevo->zona)) en zona {{$nuevo->zona}} @endif</label>
					    			</div>
					    		</div>
					    		<p class="my-0 pb-1 small">Publicado el {{$nuevo->updated_at->format('d/m/Y \a \l\a\s h:i a')}}</p>
					    	</div>
					    </a>
					    <div class="btns-anuncio">
							@if($nuevo->id_agente > 0)
					    		@if($nuevo->calificado == 'no')
								   	<button type="button" class="btn btn-sm btn-principal2 py-0" data-toggle="modal" data-target="#calificar_agente" data-codigo="{{$nuevo->codigo}}" data-usuario="{{$nuevo->id_usuario}}" data-agente="{{$nuevo->id_agente}}">
								   		Calificar Agente
									</button> 	
								@else 	
									<button type="button" class="btn btn-sm btn-principal2 py-0" data-toggle="modal" data-target="#calificar_agente" data-codigo="{{$nuevo->codigo}}" data-usuario="{{$nuevo->id_usuario}}" data-agente="{{$nuevo->id_agente}}" data-puntaje="{{$nuevo->calificacion->puntaje}}" data-comentario="{{$nuevo->calificacion->comentario}}">
								   		Calificado({{$nuevo->calificacion->puntaje}})
									</button> 
								@endif
							@endif
							<a href="{{ url('anuncios/'.$nuevo->codigo.'/editar') }}" class="btn btn-sm btn-principal2 py-0" target="blank">Editar</a>
					    	<form method="post" action="{{ url('/exito_anuncio')}}" class="d-inline" onsubmit="return confirm('Felicidades, tu anuncio fue exitoso! ahora ocultaremos el anuncio');">
								@csrf
								<input type="hidden" name="codigo" value="{{ $nuevo->codigo }}">
								<input type="hidden" name="vista" value="@if($flag) agente @else usuario @endif">
								<button type="submit" class="btn btn-sm btn-principal2 py-0">Ya se vendio!</button>
							</form>
						   	<form method="post" action="{{ url('/eliminar_anuncio')}}" class="d-inline" onsubmit="return confirm('Seguro que desea cancelar el anuncio? Esta acción no se puede deshacer');">
								@csrf
								<input type="hidden" name="codigo" value="{{ $nuevo->codigo }}">
								<input type="hidden" name="vista" value="@if($flag) agente @else usuario @endif">
								<button type="submit" class="btn btn-sm btn-danger py-0">Cancelar Anuncio</button>
							</form> 
						</div>
					</div>
				    @empty
				    	@if($nuevos->count()>0)
				    	<p>Tranquilo, tus anuncios aun siguen en revisión</p>
				    	@else
				    	<p>No tienes anuncios en revisión? <a href="{{ url('arma_tu_plan') }}" class="btn btn-sm btn-success">Publica un anuncio</a></p>
				    	@endif
				    @endforelse
				    <div class="simplePagination">
				    	{{ $nuevos->links() }}
				    </div>
				</div>
			</div>
		</div>
		
	

	</div>

</div>
<br>
@if((!$flag))
<div class="modal fade" id="calificar_agente" tabindex="-1" role="dialog" aria-labelledby="calificar_titulo" aria-hidden="true">
	<div class="modal-dialog" role="document">
	    <div class="modal-content">
		    <div class="modal-header">
		        <h5 class="modal-title" id="calificar_titulo">Calificar Agente</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		    </div>
		    <div class="modal-body">
		        <form method="post" action="{{ url('/calificar_agente')}}" class="d-inline" id="form_calificar_agente">
					@csrf
					<input type="hidden" name="codigo" id="modal_codigo">
					<input type="hidden" name="usuario" id="modal_usuario">
					<input type="hidden" name="agente" id="modal_agente">
				  	<p class="mb-0">Califica al agente</p>
				    <div class="rating-group mb-2">
				        <input disabled class="rating__input rating__input--none" name="puntaje" id="calif-none" value="0" type="radio">
				        <label aria-label="1 star" class="rating__label" for="calif-1"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
				        <input class="rating__input" name="puntaje" id="calif-1" value="1" type="radio">
				        <label aria-label="2 stars" class="rating__label" for="calif-2"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
				        <input class="rating__input" name="puntaje" id="calif-2" value="2" type="radio">
				        <label aria-label="3 stars" class="rating__label" for="calif-3"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
				        <input class="rating__input" name="puntaje" id="calif-3" value="3" type="radio">
				        <label aria-label="4 stars" class="rating__label" for="calif-4"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
				        <input class="rating__input" name="puntaje" id="calif-4" value="4" type="radio">
				        <label aria-label="5 stars" class="rating__label" for="calif-5"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
				        <input class="rating__input" name="puntaje" id="calif-5" value="5" type="radio">
				    </div>
				  	<textarea class="form-control" name="comentario" id="modal_comentario" rows="2" placeholder="Escribe algo sobre tu experiencia con este agente"></textarea>
				</form>
		    </div>
		    <div class="modal-footer">
		        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>
		        <button type="submit" class="btn btn-sm btn-principal2" form="form_calificar_agente">Calificar Agente!</button>
		    </div>
	    </div>
	</div>
</div>
@endif

@endsection

@section('js')

<script type="text/javascript">
	$(document).ready(function(){
		@if($flag)
		$('#mis-anuncios-agente').addClass('item-activo');
		@else
		$('#mis-anuncios').addClass('item-activo');
		@endif
	    
	    $('.page-link').each( function( index, element ){
		    let content = $(this).html();
		    if(content == 'pagination.previous'){
		    	$(this).empty();
	    		$(this).html('<i class="fa fa-chevron-left" aria-hidden="true"></i>');
		    } else if (content == 'pagination.next'){
		    	$(this).empty();
	    		$(this).html('<i class="fa fa-chevron-right" aria-hidden="true"></i>');
		    } else {
		    	console.log('No se esta cambiando apropiadamente este contenido:' + content);
		    }
		});

	    //modal dinamico
        $('#calificar_agente').on('show.bs.modal', function (event) {
		  	// Boton que lanza el evento
		  	let button = $(event.relatedTarget);

		  	//obtener los datos
		  	let codigo = button.data('codigo');
		  	let usuario = button.data('usuario');
		  	let agente = button.data('agente');
		  	let puntaje = button.data('puntaje');
		  	let comentario = button.data('comentario');

		  	var modal = $(this);

		  	//cargar los datos
		  	modal.find('#modal_codigo').val(codigo);
		  	modal.find('#modal_usuario').val(usuario);
		  	modal.find('#modal_agente').val(agente);

		  	modal.find('.rating__input').prop('checked', false);
		  	if(typeof puntaje === "undefined"){
		  		modal.find('#calif-none').prop('checked', true);
		  	} else {
		  		modal.find('#calif-' + puntaje).prop('checked', true);
		  	}
		  	
		  	modal.find('#modal_comentario').val(comentario);
		})	

		//obtener uri y poner show 
		var url = window.location.href;
		var url2 = url.split('?');
		if(url2.length > 1){
			var url3 = url2[1];
	        var url4 = url3.split('_');
	        $('#' + url4[0] + '_collapse').addClass('show');
		}
        

        
	});
</script>

@endsection