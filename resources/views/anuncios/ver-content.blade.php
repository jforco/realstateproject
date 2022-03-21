<div class="">
	<h5 class="mb-1 text-truncate">
		@if($anuncio->cant_pago == 0)
		<span class="small text-muted">(Plan Gratuito)</span>
		@endif
		{{ $anuncio->direccion }}
	</h5>
	<p class="mb-1 small text-muted">en zona {{ $anuncio->zona }}, {{ $anuncio->ciudad }}</p>
</div>
<div class="row mb-4">
	<div class="col-md-8 mb-3">
		<div class="fotos mb-2">
			@forelse($fotos as $foto)
			<img src="{{asset('publicaciones/'.$foto->nombre)}}" class="img-fluid">
			@empty
			<p>no hay fotos</p>
			@endforelse
			@isset($anuncio->video_yt)
			<div class="embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/{{$anuncio->video_yt}}" allowfullscreen></iframe>
			</div>
			@endisset
		</div>
		<div class="fotos-mini mx-3">
			@forelse($fotos as $foto)
			<img src="{{asset($foto->thumbnail)}}" class="img-fluid">
			@empty
			<p>no hay fotos</p>
			@endforelse
			@isset($anuncio->video_yt)
			<img src="/img/play-video.png" class="img-fluid">
			@endisset
		</div>
	</div>
	<div class="col-md-4">
		<p class="mb-1">
			<b>{{$anuncio->tipo_inmueble}} en {{$anuncio->tipo_oferta}}</b>
		</p>
		<table class="table table-sm">
			<tbody class="small">
			   	<tr>
			      	<td>Precio:</td>
			      	<td>
			      		@if($anuncio->moneda == 'dolares') 
						$us. 
						@else
						Bs.
						@endif
						<span class="precio_separador">{{$anuncio->precio}}</span>
			      	</td>
			    </tr>
			    <tr>
			      	<td>Estado:</td>
			      	<td>{{ $anuncio->estado_inmueble }}</td>
			    </tr>
			    <tr>
			      	<td>Superficie:</td>
			      	<td>
			      		{{ $anuncio->sup_terreno }} m2 - terreno<br>
			      		{{ $anuncio->sup_construido }} m2 - construido<br>
			      		{{ $anuncio->sup_terraza }} m2 - terraza<br>
			      	</td>
			    </tr>
			    <tr>
			      	<td>Dormitorios: </td>
			      	<td>{{$anuncio->cant_dormitorios}}</td>
			    </tr>
			    <tr>
			      	<td>Baños: </td>
			      	<td>{{$anuncio->cant_baños}}</td>
			    </tr>
			    <tr>
			      	<td>Pisos: </td>
			      	<td>{{$anuncio->cant_pisos}}</td>
			    </tr>
			    <tr>
			      	<td>Parqueos: </td>
			      	<td>{{$anuncio->cant_parqueos}}</td>
			    </tr>
			    <tr>
			      	<td>Elevador: 
			      		@if($anuncio->elevador == 'si') 
			      		<i class="fa fa-check color-principal" aria-hidden="true"></i>
			      		@else
			      		<i class="fa fa-times text-muted" aria-hidden="true"></i>
			      		@endif
			      	</td>
			      	<td>Baulera:
			      		@if($anuncio->baulera == 'si') 
			      		<i class="fa fa-check color-principal" aria-hidden="true"></i>
			      		@else
			      		<i class="fa fa-times text-muted" aria-hidden="true"></i>
			      		@endif
					</td>
			    </tr>
			    <tr>
			      	<td>Piscina: 
			      		@if($anuncio->piscina == 'si') 
			      		<i class="fa fa-check color-principal" aria-hidden="true"></i>
			      		@else
			      		<i class="fa fa-times text-muted" aria-hidden="true"></i>
			      		@endif
			      	</td>
			      	<td>Amoblado:
			      		@if($anuncio->amoblado == 'si') 
			      		<i class="fa fa-check color-principal" aria-hidden="true"></i>
			      		@else
			      		<i class="fa fa-times text-muted" aria-hidden="true"></i>
			      		@endif
			      	</td>
			    </tr>
			    <tr>
			    	<td>Año constr:</td>
			    	<td>{{$anuncio->año_construccion}}</td>
			    </tr>
			    <tr>
			      	<td>Entrega: </td>
			      	@if(isset($anuncio->fecha_entrega))
			      	<td class="fecha_facil">{{$anuncio->fecha_entrega}}</td>
			      	@else
			      	<td>Inmediata</td>
			      	@endif
			    </tr>
			    <tr>
			    	<td class="text-muted" colspan="2">publicado el <span class="fecha_facil">{{ $anuncio->updated_at }}</span></td>
			    </tr>
			</tbody>
		</table>
		@auth
		@unless(isset($titulo))
		<div class="px-3">
			<button class="btn btn-sm btn-block boton_favorito" id="favorito_button">
				@if($anuncio->favorito(Auth::id()))
				<i class="fa fa-heart" id="favorito_icon" style="color: red" aria-hidden="true"></i> <span id="favorito_texto">Favorito</span>
				@else
				<i class="fa fa-heart-o" id="favorito_icon" style="color: red" aria-hidden="true"></i> <span id="favorito_texto">Marcar Favorito</span>
				@endif
			</button>
		</div>
		@endunless
		@endauth	
	</div>
</div>	
<div class="row">
	<div class="col-lg-8">
		<h5><b>Descripción</b></h5>
		<p class="mb-4"> {{ $anuncio->descripcion }} </p>
			<h5><b>Marcas usadas en la construcción</b></h5>
		<ul class="mb-4">
			@forelse($marcas_elegidas as $marca)
			<li>{{$marca->nombre}}</li>
			@empty
			<li>ninguna</li>
			@endforelse
		</ul>
		<h5><b>Posición Geográfica</b> <small class="text-muted">({{$anuncio->precision_punto}})</small></h5>
		<div id="map" style="background-color: #777;"></div>
		<p class="mb-4">Precision: {{$anuncio->precision_punto}}</p>
	</div>
	<div class="col-lg-4">
		<div class="card mb-5">
		  	<div class="card-body">		  		
			    <h5 class="card-title text-center"><b>Contacto</b></h5>
			    <div class="text-center">
			    	<img src="{{ asset($vendedor->avatar) }}" class="img-fluid rounded-circle text-center">
			    </div>
			    @if($vendedor->agente == 'si')
			    <p class="card-text text-center mt-2 mb-0"><a href="{{ asset('agentes/'.$vendedor->id) }}" 
				class="link" target="_blank"><b class="color-principal"><u>{{ $vendedor->nombre }}</u></b></a></p>
			    <p class="text-center"><i class="fa fa-star color-secundario" aria-hidden="true"></i> 
				<b>{{ $vendedor->puntaje_promedio }}</b> ({{ $vendedor->cant_puntajes }} reviews)</p>
			    @else
			    <p class="card-text text-center mt-2 mb-0"><b class="color-principal">{{ $vendedor->nombre }}</b></p>
			    @endif
			    @foreach($vendedor->telefonos as $telefono)
			    <p class="small text-center">Tel. {{ $telefono->telefono }}</p>
			    @endforeach
				@unless(isset($titulo))
			    <p class="text-center m-0">
			    	<a href="JavaScript:Void(0);" class="btn btn-sm btn-principal" data-toggle="modal" data-target="#contactarModal">Contactar</a>
			    </p>
				@endunless
		  	</div>
		</div>
	</div>
</div>