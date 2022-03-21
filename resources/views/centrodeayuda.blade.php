@extends('layouts.master')

@section('titulo', 'Centro de ayuda')


@section('body')
<section>
    <br>
  
<div class="container">




<div class="row mx-0">
	<div class="col-sm-9 offset-sm-2">
		<div class="px-4 mb-5 ">
			<br><br><br>
			<h4 class="h1 pb-2 pt-3 text-center">Centro de ayuda</h4>
			
			<p class="h4">¿Cómo puedo contactarlos?</p>
			<p>Contamos con distintos canales de atención, cualquier duda o consulta que tengas siéntete libre de preguntar mediante:</p>
			<ul id="info">
            <li>Nuestras redes sociales: <strong><a href="https://www.facebook.com/Lucasas-708208516684105" target="_blank">Facebook</a> <a href="https://www.facebook.com/Lucasas-708208516684105" target="_blank">Instagram</a> <a href="https://www.facebook.com/Lucasas-708208516684105" target="_blank">YouTube</a> <a href="https://www.facebook.com/Lucasas-708208516684105" target="_blank">Tik Tok</a></strong></li>
				
				<li>
                Correo electrónico: <strong><a  href="mailto:info@lucasas.com?subject=Requiero%20m%C3%A1s%20informaci%C3%B3n" target="_blank">info@lucasas.com</a></strong>
				</li>
				<li>
                Número de WhatsApp:  <strong><a href="https://wa.me/59172204144php?text=Hola%20Lucasas!" target="_blank"> +591 72204144</a></strong>
				</li>
			</ul>
		
            <p class="h4">¿Cuál es el horario de atención?</p>
			
			<ul>
				<li>
				Puedes contactarnos en cualquier momento y visitarnos en nuestras oficinas en Santa Cruz, el horario es el siguiente: 8:30 a 17:00
				</li>
				
			</ul>
            <p class="h4">¿Este es un sitio seguro?</p>
			
			<ul id="info">
				<li>
				Ten la confianza de que tu información está siendo gestionada de la manera correcta y que este sitio web cumple con la <strong><a  href="{{ url('politicadeprivacidad') }}">política de privacidad</a></strong>  del usuario.
				</li>
				
			</ul>
            
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