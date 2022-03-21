@extends('layouts.master')

@section('titulo', 'Recorrido 360°')


@section('body')
<section>
    <br>
  
<div class="container">




<div class="row mx-0">
	<div class="col-sm-9 offset-sm-2">
		<div class="px-2 mb-5 ">
			<br><br><br>
			<h2 class="h2 pb-2 pt-3 text-center">Recorrido 360°</h2>
			
            <h3 class="offset-top-60 offset-sm-top-70 offset-md-top-125">Nosotros hacemos el trabajo por ti</h3>
              <div class="unit flex-column flex-md-row unit-spacing-xl offset-top-25 text-md-left">
                <div class="unit-body">
                  <p>El equipo de Lucasas se encarga de la filmación de un video de tu inmueble en 3D. Estos recorridos virtuales de casas se crean a partir de diversas fotografías en 360 grados, que se unen mediante puntos de acción, los cuales permiten trasladarnos entre espacios 360 (fotografías), o bien ejercer acciones interactivas dentro del mismo tour para que así el cliente pueda obtener una idea a detalle la organización de la casa, no solo a través de las imágenes 360 sino también simulando la perspectiva humana de las habitaciones, de tal manera que podemos ver de manera tridimensional el plano de la casa, obteniendo así una idea espacial completa.</p>
                  <p class="d-none d-lg-block">Aquí puedes ver un ejemplo de este servicio:</p>
                </div>
                <div class="unit-right">
				<video id="video-responsive" width="540px" height="310px" controls="controls" autoplay="autoplay">
  <source src="/img/recorridovirtual.mp4" autoplay type="video/mp4" />
  <source src="video.webm" type="video/webm" />
  <source src="video.ogv" type="video/ogg" />
  <img src="imagen.png" alt="Video no soportado" />
  Su navegador no soporta contenido multimedia.
</video>
					
                </div>
              </div>
            
		</div>
			
	</div>
</div>
</div> 
</section>
<style>
		#info>li>strong>a{
			color: #4e2963 !important;
		}
		#info>li>a:hover{
			 background:  linear-gradient(to right, #f98905, #f9971b, #faa52d, #fab23d, #fbbe4d);
			 -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
		}
</style>
@endsection