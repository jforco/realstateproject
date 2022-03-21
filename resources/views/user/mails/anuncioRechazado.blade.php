@extends('user.mails.master-mail')

@section('contenido')
<h3 class="centrar">Tu anuncio aun no ha sido aprobado</h3>
<br>
<p>Hola {{ $nombre }}</p>
<p>Nuestros moderadores han revisado tu anuncio y lamentamos decirte que aún no se ha aprobado para que sea visible en nuestro portal.</p>
<p>Los moderadores han mencionado la siguiente razón:</p>
<blockquote cite="https://www.lucasas.com/">
	{{$mensaje}}
</blockquote>
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
<p><b>Recuerda volver a editar tu anuncio corrigiendo las observaciones de nuestros moderadores, para que tu anuncio sea aprobado y visible en nuestro portal.</b></p>
<br>
<p>Atentamente</p>
<p>El equipo de Lucasas!</p>

@endsection