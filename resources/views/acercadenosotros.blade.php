@extends('layouts.master')

@section('titulo', 'Acerca de nosotros')


@section('body')
<section>
    <br>
  
<div class="container" style="height: 672px;">




<div class="row mx-0">
	<div class="col-sm-9 offset-sm-2">
		<div class=" mb-5 ">
			<br><br><br>
			<h4 class="h1 pb-2 pt-3 text-center">Acerca de Nosotros</h4>
			
			<video id="video-responsive" width="720px" height="480px" controls="controls" autoplay="autoplay">
				<source src="/img/recorridovirtual.mp4" autoplay type="video/mp4" />
				<source src="video.webm" type="video/webm" />
				<source src="video.ogv" type="video/ogg" />
				<img src="\img\lucasas-logo2.png" alt="Video no soportado" />
				Su navegador no soporta contenido multimedia.
				</video>
		
            
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