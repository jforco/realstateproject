@extends('user.mails.master-mail')

@section('contenido')
<h3 class="centrar">¡Has sido elegido!</h3>
<br>
<p>Hola {{ $nombre_agente }}!</p>
<p>¡Felicidades! Uno de nuestros clientes en {{ env('SITIO_NAME') }}, te ha seleccionado como su agente inmobiliario.</p>
<p>Te damos sus datos para que pronto te pongas en contacto con él!</p>
<br>
<ul>
	<li>Nombre: {{$cliente->nombre}}</li>
	<li>Correo: {{$cliente->correo}}</li>
	@foreach($cliente->telefonos as $telefono)
	<li>Tel.: {{$telefono->codigo}} {{$telefono->telefono}}</li>
	@endforeach
</ul>
<br>
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
<br>
<p>Atentamente</p>
<p>El equipo de Lucasas!</p>

@endsection