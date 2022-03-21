@extends('layouts.master')

@section('titulo', 'Plataforma')

@section('css')

	<link rel="stylesheet" type="text/css" href="{{ asset('css/home-style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('slick/slick-theme.css') }}"/>
@endsection

@section('body')

<section id="portada">
	<div class="caja-busqueda">
		<form method="get" action="{{url('buscar')}}" id="busqueda-form">
			<div class="texto-central">
				<div class="busqueda-select">
					<div class="caja_seleccion">
						<select class="seleccionador" name="inmueble" id="inmueble_select" required>
						    @forelse($inmuebles as $inmueble)
						  	<option value="{{ $inmueble }}" >{{ $inmueble }}</option>
						  	@empty
						  	<option>No hay opciones.</option>
						  	@endforelse
						</select>
						<i class="fa fa-sort-desc icono" aria-hidden="true"></i>
					</div>
					<div class="caja_seleccion">
						<select class="seleccionador" name="oferta" id="oferta_select" required>
						    @forelse($ofertas as $oferta)
						  	<option value="{{ $oferta }}" >{{ $oferta }}</option>
						  	@empty
						  	<option>No hay opciones.</option>
						  	@endforelse
						</select>
						<i class="fa fa-sort-desc icono" aria-hidden="true"></i>
					</div>
				</div>
				<div class="busqueda-select">
					<div class="caja_busqueda">
						<div class="row no-gutters">
							<div class="col">
								<select class="seleccionador" name="ciudad" id="ciudad_select" required>
								    @forelse($ciudades as $ciudad)
								  	<option value="{{ $ciudad }}" >{{ $ciudad }}</option>
								  	@empty
								  	<option>No hay opciones.</option>
								  	@endforelse
								</select>
								<i class="fa fa-sort-desc icono" aria-hidden="true"></i>
							</div>
							<div class="col-auto">
								<button type="submit" class="btn btn-light float-right boton_busqueda pr-2"><i class="fa fa-search fa-2x"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</section>



<section id="backgroundInicio" >
	<br>		
	<br>
	<div class="section-heading text-center">
        <div class="col-md-12 col-xs-12">
			<h4 id="span" class="content-box" style="font-weight: bold; color: white;">Anuncios Destacados!</h4>
            <br>
        </div>
    </div>
	
	<div class="sticky destacados_slick">
		@foreach($anuncios as $anuncio)
		<div class="">
			<a href="{{ url('anuncios/'.$anuncio->codigo) }}" style="text-decoration: none; color: inherit;" target="blank">
				<div class="card2 shadow shadow-sm tarjeta_fija">
					<div class="imagen_portada">
						@if($anuncio->portada != "" && substr($anuncio->portada, -2) == 'pg')
    					<img class="card-img-top img-fluid" src="{{ asset('publicaciones/thumbnails/'.str_replace('.jpg','-mini.jpg',$anuncio->portada)) }}" alt="{{$anuncio->codigo}}" width="100%">
    					@elseif($anuncio->portada != "" && substr($anuncio->portada, -2) == 'eg')
    					<img class="card-img-top img-fluid" src="{{ asset('publicaciones/thumbnails/'.str_replace('.jpeg','-mini.jpeg',$anuncio->portada)) }}" alt="{{$anuncio->codigo}}" width="100%">
    					@else
    					<img src="{{ asset('img/lucasas-logo2.png') }}" alt="empty" width="100%">
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
							<span class="small">en @if(!empty($anuncio->zona)) zona {{$anuncio->zona}}, @endif {{ $anuncio->ciudad }}, {{ $anuncio->estado_lugar }}</span>
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
</section>
	
@endsection
@section('js')
<script type="text/javascript" src="{{ asset('slick/slick.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		if($(window).scrollTop() < 5){
			$('.imagen_logo').addClass('imagen_logo_grande');
			$('#navbar_principal').removeClass('bg-principal');
			$('#navbar_principal').removeClass('shadow');
		}
		$(window).scroll(function(){
			if($(window).scrollTop() < 100) {
				$('.imagen_logo').addClass('imagen_logo_grande');
				$('#navbar_principal').removeClass('bg-principal');
				$('#navbar_principal').removeClass('shadow');
			} else {
				$('.imagen_logo').removeClass('imagen_logo_grande');
				$('#navbar_principal').addClass('bg-principal');
				$('#navbar_principal').addClass('shadow');
			}
				   
		});

	  	$('.destacados_slick').slick({
	    	autoplay: true,
	        autoplaySpeed: 5000,
	        dots: false,
			arrows:false,
	        speed: 1000,	
			
    		rows: 2,		
			slidesPerRow: 4,
	        responsive: [
	        {
	            breakpoint: 1200,
	            settings: {
					rows: 2,		
			slidesPerRow: 3,
	            }
	        },
	        {
	            breakpoint: 900,
	            settings: {
					rows: 2,		
			slidesPerRow:2 ,
	            }
	        },
	        {
	            breakpoint: 600,
	            settings: {
					rows: 1,		
			slidesPerRow: 1,
					
	                dots: false
	            }
	        },
			{
	            breakpoint: 480,
	            settings: {
					slidesToShow: 1,
                    slidesToScroll: 1,
					
        			
					dots: false
	            }
	        },
			{
	            breakpoint: 360,
	            settings: {
					rows: 1,		
			slidesPerRow: 1,
					
	                dots: false
	            }
	        }]
			
	  	});
	});
</script>
@endsection