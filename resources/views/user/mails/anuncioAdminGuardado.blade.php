@extends('user.mails.master-mail')

@section('contenido')
<h3 class="centrar">Un nuevo anuncio se ha guardado con éxito</h3>
<br>
<p>El usuario: {{ $cliente->nombre }}!</p>
<p>Ha publicado un nuevo anuncio en el portal de Lucasas.</p>
<p>En este momento, esta listo para aprobacion, porfavor revisa la publicación. </p>
<p>Algunos datos del anuncio son los siguientes:</p>
<ul>
	<li>codigo: {{$anuncio->codigo}}</li>	
	<li>{{$anuncio->tipo_inmueble}} en {{$anuncio->tipo_oferta}}</li>
	<li>{{$anuncio->direccion}}</li>
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
    <a href="{{ url('admin') }}">
        <button class="boton">Administración</button>
    </a>
</div>
<p>O puedes ingresar desde tu cuenta administrador</p>
<br>
<p>Atentamente</p>
<p>El equipo de Lucasas!</p>

@endsection