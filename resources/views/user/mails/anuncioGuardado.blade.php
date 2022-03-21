@extends('user.mails.master-mail')

@section('contenido')
<h3 class="centrar">Tu anuncio se ha guardado con éxito</h3>
<br>
<p>Hola {{ $cliente->nombre }}!</p>
<p>Gracias por subir tu anuncio. Esperamos poder ayudarte a conseguir tus objetivos.</p>
<p>En este momento, estamos revisando tu anuncio. Te enviaremos un correo en cuanto termine el proceso de revisión. </p>
<p>Algunos datos del anuncio son los siguientes:</p>
<ul>
	<li>tipo de inmueble: {{$anuncio->tipo_inmueble}} en {{$anuncio->tipo_oferta}}</li>
	<li>dirección: {{$anuncio->direccion}}</li>
	<li>estado: {{$anuncio->estado}}</li>
	<li>
		@if($anuncio->moneda == 'bolivianos')
		Bs.
		@else
		Sus.
		@endif
		{{$anuncio->precio}}
	</li>
</ul>
<br>
<p>Para ver más detalles del anuncio, puedes ingresar al siguiente enlace:</p>
<div class="centrar">
    <a href="{{ url('anuncios/'.$anuncio->codigo) }}">
        <button class="boton">Ver anuncio</button>
    </a>
</div>
<p>O puedes ingresar desde tu cuenta en la sección "Mis Anuncios"</p>
<br>
<p>Atentamente</p>
<p>El equipo de Lucasas!</p>

@endsection