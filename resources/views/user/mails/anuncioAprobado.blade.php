@extends('user.mails.master-mail')

@section('contenido')
<h3 class="centrar">¡Tu anuncio se ha aprobado y publicado!</h3>
<br>
<p>Hola {{ $nombre }}!</p>
<p>Tu anuncio fue aprobado y ya es visible en nuestro portal.    Gracias por tu paciencia.</p>
<p>Algunos datos del anuncio son los siguientes:</p>
<ul>
	<li>{{$anuncio->tipo_inmueble}} en {{$anuncio->tipo_oferta}}</li>
	<li>{{$anuncio->direccion}}</li>
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
<p><b>Recuerda que ahora tu anuncio es visible para que cualquiera lo encuentre al realizar una busqueda en nuestro portal</b></p>
<br>
<p>Atentamente</p>
<p>El equipo de Lucasas!</p>

@endsection