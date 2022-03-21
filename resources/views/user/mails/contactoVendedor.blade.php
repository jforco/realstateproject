@extends('user.mails.master-mail')

@section('contenido')
<h3 class="centrar">¡Alguien quiere saber mas de tu anuncio!</h3>
<br>
<p>Hola {{ $nombre }},</p>
<p>Alguien en {{ env('SITIO_NAME') }} ha visto tu anuncio, y esta interesado en el, y te manda el siguiente mensaje:</p>
<blockquote>
	{{$mensaje}}
</blockquote>
<p>Te damos sus datos para que pronto te pongas en contacto con él!</p>
<ul>
@if(isset($user))
	<li>Nombre: {{$user->nombre}}</li>
	<li>Correo: {{$user->correo}}</li>
	@foreach($user->telefonos as $telefono)
	<li>Tel.: {{$telefono->codigo}} {{$telefono->telefono}}</li>
	@endforeach
@else
	<li>Tel.: {{$telefono}}</li>
@endif
</ul>
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
<p>Esperamos que esto termine en {{$anuncio->tipo_oferta}} de tu inmueble.</p>
<br>
<p>Atentamente</p>
<p>El equipo de Lucasas!</p>

@endsection