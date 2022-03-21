@extends('user.mails.master-mail')

@section('contenido')
<h3 class="centrar">¡Te damos la bienvenida!</h3>
<br>
<p>Hola {{ $nombre_usuario }}</p>
<p>¡Gracias por suscribirte a {{ env('SITIO_NAME') }}! Has completado tu suscripción. Bienvenido al portal inmobiliario en el que puedes ofertar tus propiedades de forma gratuita o elegir uno de nuestros planes que te darán una mejor ventaja.</p>
<br>
<p>Como miembro registrado de Lucasas podrás recibir algunos beneficios que te permiten lo siguiente:</p>
<ul>
	<li>Podrás publicar tus propiedades sin ningún costo es ¡totalmente gratuita!</li>
	<li>Podrás establecer contacto directo con vendedores y compradores.</li>
</ul>
<br>
<p>Gracias por unirte y confiar en nosotros!.</p>
<br>
<p>Atentamente</p>
<p>El equipo de Lucasas!</p>

@endsection