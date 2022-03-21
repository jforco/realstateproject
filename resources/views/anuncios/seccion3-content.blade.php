<div>
	<h4 class="text-center">Contenido Multimedia</h4>
</div>
<br>
<div class="row mx-3">
	<div class="col-md-6 mb-3">
		<h5><b>Agregar Fotos (máximo {{$publicacion->cant_fotos}})</b></h5>
		<div class="row px-3 py-2">
			@foreach($fotos as $foto)
			<div class="foto @if($foto->nombre == $publicacion->portada) seleccionado @endif">
				<img src="{{ asset($foto->thumbnail) }}" class="img-thumbnail">
				<form method="post" action="{{ url('/eliminar_imagen2')}}" onsubmit="return confirm('Eliminar esta imagen?');">
					@csrf
					<input type="hidden" name="nombre_original" value="{{ $foto->original }}">
					<button type="submit" class="btn btn-danger btn-sm py-0 px-1 btn-eliminar"><i class="fa fa-close"></i></button>
				</form>
				<div class="text-center">
					<button type="button" class="btn btn-primary btn-sm py-0 px-1 mr-1 boton_portada">Portada</button>
				</div>
				<div class="nombre_original" hidden>{{ $foto->original }}</div>
			</div>
			@endforeach
		</div>
      	<form action="{{ url('subir_imagen/' . $publicacion->codigo) }}" enctype="multipart/form-data" method="post" class="dropzone" id="image-upload">
		    @csrf
		</form>
	</div>
	<div class="col-md-6 px-4">
		@if($publicacion->video_prof == 'si')	
		<h5 class="mb-2"><b>Video Profesional (a cargo de Lucasas)</b></h5>
		@isset($titulo)
		<div class="form-group">
    		<label for="video_yt">Enlace YouTube</label>
    		<input type="text" class="form-control" id="video_yt" name="video_yt" form="publicacion_form" placeholder="Link" maxlength="100" value="https://www.youtube.com/watch?v={{ $publicacion->video_yt }}">
    	</div>
		@endisset
  		@endif
		@if($publicacion->cant_pago != 0)
		<div class="col-sm-10 offset-sm-1 mt-5">
			<h5>(Opcional) Puedes elegir un agente</h5>
			<div class="table-responsive">
				<table class="table table-hover table-sm">
				  <tbody>
				  	<tr>
				      <td></td>
				      <td>ninguno</td>
				      <td style="padding-top: 13px;"><input type="radio" name="agente" value="0" class="form-control" form="publicacion_form" checked></td>
				    </tr>
				  	@foreach($agentes as $agente)
				    <tr>
				      <td><a href="{{ asset('agentes/'.$agente->id) }}" target="_blank"><img class="d-inline" src="{{ asset($agente->avatar) }}" alt="foto" height="35px"></a></td>
				      <td><a href="{{ asset('agentes/'.$agente->id) }}" class="link" target="_blank"><u>{{$agente->nombre}}</u></a> - <i class="fa fa-star color-secundario" aria-hidden="true"></i> {{$agente->puntaje_promedio}} <small>({{$agente->cant_puntajes}})</small></td>
				      <td style="padding-top: 13px;"><input type="radio" name="agente" value="{{ $agente->id }}" class="form-control" form="publicacion_form"></td>
				    </tr>
				    @endforeach
				  </tbody>
				</table>
			</div>
		</div>
		@endif
	</div>
	
	<input type="hidden" name="portada" id="portada" form="publicacion_form" required>
</div>