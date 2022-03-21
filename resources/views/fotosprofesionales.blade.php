@extends('layouts.master')

@section('titulo', 'Fotos profesionales')


@section('body')
<section>
    <br>
  
<div class="container" style="padding-top: 50px;
    height: 500px;">




<div class="row mx-0">
	<div class="col-sm-9 offset-sm-2">
		<div class="px-2 mb-5 ">
			<br><br><br>
			<h2 class="h2 pb-2 pt-3 text-center">FOTOS PROFESIONALES</h2>
			
            <h3 class="offset-top-60 offset-sm-top-70 offset-md-top-125">Nosotros hacemos el trabajo por ti</h3>
              <div class="unit flex-column flex-md-row unit-spacing-xl offset-top-25 text-md-left">
                <div class="unit-body">
                  <p>El equipo de fotógrafos profesionales de Lucasas se encarga de capturar las mejores imágenes de tu inmueble con retoques para corregir problemas de iluminación entre otras cosas, resaltando la belleza de tu casa.</p>
                  <!-- <p class="d-none d-lg-block">Aquí puedes ver un ejemplo de este servicio:</p> -->
                </div>
             
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