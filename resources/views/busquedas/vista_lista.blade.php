@forelse($anuncios as $anuncio)
	@if ($anuncio->borde == 'si')
	<div class="anuncio-item bg-white mb-3 p-0 shadow shadow-sm borde_destacado">
	@else
	<div class="anuncio-item bg-white mb-3 p-0 shadow shadow-sm">
	@endif
		<div class="row justify-content-center">
			<div class="col-12 col-md-5 col-lg-4 col-xl-3 mx-auto anuncio-imagen">
				<div style="width: auto; overflow: hidden; position: relative;">
					@if($anuncio->portada != "" && substr($anuncio->portada, -2) == 'pg')
					<img src="{{ asset('publicaciones/thumbnails/'.str_replace('.jpg','-mini.jpg',$anuncio->portada)) }}" alt="{{$anuncio->codigo}}" width="100%">
					@elseif($anuncio->portada != "" && substr($anuncio->portada, -2) == 'eg')
					<img src="{{ asset('publicaciones/thumbnails/'.str_replace('.jpeg','-mini.jpeg',$anuncio->portada)) }}" alt="{{$anuncio->codigo}}" width="100%">
					@else
					<img src="{{ asset('img/lucasas-logo2.png') }}" alt="empty" width="100%">
					@endif
					<div class="opcion_favorito text-white text-center">
						<span class="d-none" id="id_anuncio">{{ $anuncio->id }}</span>
						@if($anuncio->favorito(Auth::id()))
							<i class="fa fa-heart" id="favorito_icon" style="color: red" aria-hidden="true"></i> <span id="favorito_texto">Favorito</span>
						@else
							<i class="fa fa-heart-o" id="favorito_icon" style="color: red" aria-hidden="true"></i> <span id="favorito_texto">Marcar Favorito</span>
						@endif
					</div>
				</div>
			</div>
			<div class="col-12 col-md-7 col-lg-8 col-xl-9">
				<div class="my-1 mx-3 mx-md-1">
					<a href="{{ url('anuncios/'.$anuncio->codigo) }}" target="blank">
						<h4 class="text-truncate color-principal" class="m-0">
							@if(strlen($anuncio->direccion) > 35)
							{{ substr($anuncio->direccion, 0, 34) }}...
							@else
							{{ $anuncio->direccion }}
							@endif
						</h4>
					</a>
					<p class="m-0"><b> 
						@if($anuncio->moneda == 'dolares') 
						$us. 
						@else
						Bs.
						@endif
						<span class="precio_separador">{{$anuncio->precio}}</span>
					</b></p>
										
					<p class="small mb-1">
						<span class="text-capitalize">{{$anuncio->tipo_inmueble}}</span> en <span class="text-capitalize">{{$anuncio->tipo_oferta}}</span> - <span>@if(!empty($anuncio->zona)) en zona {{$anuncio->zona}}, @endif {{ $anuncio->ciudad }}</span>
					</p>

					<p class="mb-2 anuncio-descripcion">
						@if(strlen($anuncio->descripcion) > 150)
						{{ substr($anuncio->descripcion, 0, 150) }}...
						@else
						{{ $anuncio->descripcion }}
						@endif
					</p>
					<div class="row no-gutters align-items-end">
						<div class="col-sm">
							<ul class="list-inline m-1">
								<li class="list-inline-item"><i class="fa fa-bed"></i> {{$anuncio->cant_dormitorios}} </li>
								<li class="list-inline-item"><i class="fa fa-bath"></i> {{$anuncio->cant_baños}} </li>
								<li class="list-inline-item"><i class="fa fa-square"></i> {{$anuncio->sup_terreno}} mt2</li>
							</ul>
						</div>
						<div class="col-auto text-right">
							@isset($inmuebles)
							<a href="javascript:void(0)" type="button" class="btn btn-principal btn-sm ver_mapa" data-codigo="{{$anuncio->codigo}}">Ver <i class="fa fa-map-marker" aria-hidden="true"></i></a>
							@endisset
							<a href="{{ url('anuncios/'.$anuncio->codigo) }}" type="button" class="btn btn-principal btn-sm" target="blank">Ver inmueble</a>
						</div>
					</div>
				</div>
			</div>
		</div>						
	</div>
	
@empty
	<div class="text-center mt-5" style="margin-bottom: 58vh;">
		Aun no hay anuncios en esta sección.
	</div>
@endforelse

	<div>
		{{ $anuncios->links() }}
	</div>
	