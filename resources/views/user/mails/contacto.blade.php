@extends('user.mails.master-mail')

@section('contenido')
<h3 class="centrar">¡Alguien ha enviado un mensaje a la página!</h3>
<br>
<p>Hola {{ $nombre }},</p>
<p>Alguien en {{ env('SITIO_NAME') }} te manda el siguiente mensaje:</p>
<blockquote>
	{{$mensaje}}
</blockquote>
<p>Te damos sus datos para que pronto te pongas en contacto con él!</p>
<ul>
	<li>Nombre: {{$nombre}}</li>
	<li>Correo: {{$correo}}</li>
</ul>
<br>
<br>
<p>Atentamente</p>
<p>El equipo de Lucasas!</p>

@endsection