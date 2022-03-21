@extends('layouts.master')

@section('titulo', 'Agentes')

@section('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('css/home-style.css') }}">
@endsection


@section('body')
<br><br><br>
<div class="row no-gutters px-2">
	<div class="col-4 col-sm-3 offset-sm-2">
		<img src="{{ asset($agente->avatar) }}" class="img-fluid rounded-circle float-right">
	</div>
	<div class="col-8 col-sm-5 pl-3">
		<p class="card-text mt-2 mb-0"><a href="{{ asset('agentes/'.$agente->id) }}" class="link" target="_blank"><b class="color-principal"><u>{{ $agente->nombre }}</u></b></a></p>
		@if($agente->agente == 'si')
		<p class="mb-0"><i class="fa fa-star color-secundario"></i> <b>{{ $agente->puntaje_promedio }}</b> ({{ $agente->cant_puntajes }} reviews)</p>
		@endif
		@foreach($agente->telefonos as $telefono)
		<p class="small ">Tel. {{ $telefono->telefono }}</p>
		@endforeach
	</div>
</div>

<div class="container p-2">
	<ul class="nav nav-tabs" role="tablist">
		<li class="nav-item">
		    <a class="nav-link active" id="activos_tab" data-toggle="tab" href="#activos_content" role="tab" aria-controls="activos_content" aria-selected="true">Anuncios activos</a>
		</li>
		<li class="nav-item">
		    <a class="nav-link" id="reviews_tab" data-toggle="tab" href="#reviews_content" role="tab" aria-controls="reviews_content" aria-selected="false">Comentarios</a>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane fade show active" id="activos_content" role="tabpanel" aria-labelledby="activos_tab">
			<br>
			<div class="row no-gutters">
				@foreach($anuncios as $anuncio)
				<div class="col-lg-3 col-md-4 col-sm-6 px-3 mb-3">
					<a href="{{ url('anuncios/'.$anuncio->codigo) }}" style="text-decoration: none; color: inherit;" target="blank">
						<div class="card shadow shadow-sm">
							<div class="imagen_portada">
								@if($anuncio->portada != "" && substr($anuncio->portada, -2) == 'pg')
								<img class="card-img-top" src="{{ asset('publicaciones/thumbnails/'.str_replace('.jpg','-mini.jpg',$anuncio->portada)) }}" class="img-fluid" alt="{{$anuncio->codigo}}">
								@elseif($anuncio->portada != "" && substr($anuncio->portada, -2) == 'eg')
								<img class="card-img-top" src="{{ asset('publicaciones/thumbnails/'.str_replace('.jpeg','-mini.jpeg',$anuncio->portada)) }}" class="img-fluid" alt="{{$anuncio->codigo}}">
								@else
								<img class="card-img-top" src="{{ asset('img/lucasas-logo2.png') }}" alt="empty" width="100%">
								@endif
							</div>
							<div class="cuadro_precio d-flex px-1 shadow shadow-sm">
								<span>
									@if($anuncio->moneda == 'dolares') 
									$us. 
									@else
									Bs.
									@endif
									<span class="precio_separador">{{ $anuncio->precio }}</span> 
								</span>
							</div>
							<div class="card-body pb-0 pt-2">
								<div class="text-truncate pb-2">
									<span><b><span class="text-capitalize">{{$anuncio->tipo_inmueble}}</span> en <span class="text-capitalize">{{$anuncio->tipo_oferta}}</span></b></span><br>
									<span class="small">en zona {{ $anuncio->zona }}, {{ $anuncio->ciudad }}</span>
								</div>
								<div class="text-right">
									<ul class="list-inline">
										<li class="list-inline-item"><i class="fa fa-bed"></i> {{$anuncio->cant_dormitorios}} </li>
										<li class="list-inline-item"><i class="fa fa-bath"></i> {{$anuncio->cant_baños}} </li>
										<li class="list-inline-item"><i class="fa fa-square"></i> {{$anuncio->sup_terreno}} mt2</li>
									</ul>
								</div>
							</div>
						</div>
					</a>
				</div>
				@endforeach
			</div>
		</div>
		<div class="tab-pane fade" id="reviews_content" role="tabpanel" aria-labelledby="reviews_tab">
			<br>
			<div class="row px-3">
				@foreach($reviews as $review)
				<div class="col-md-6 col-lg-4">
					<div class="card mb-3 cuadro-anuncio">
					    <div class="card-body py-2">
					    	<p class="my-0">
					    		@for ($i = 0; $i < 5; $i++)
								    @if($i < $review->puntaje)
								    <i class="fa fa-star color-secundario"></i>
								    @else
								    <i class="fa fa-star-o color-secundario"></i>
								    @endif
								@endfor
					    	</p>
					    	<p class="my-0">
					    		<strong>{{ $review->nombre_usuario->nombre }}</strong>
					    	</p>
					    	<p class="my-0">{{ $review->comentario }}</p>
					    	<p class="my-0 small text-right">el {{$review->created_at->format('d/m/Y \a \l\a\s h:i a')}}</p>
					    </div>
					</div>
				</div>
				@endforeach
			</div>
			<br>
		</div>
	</div>
</div>
<br>
@endsection

@section('js')

<script type="text/javascript">
	$(document).ready(function(){
	    
	});
</script>

@endsection