@extends('user.mails.master-mail')

@section('contenido')
<h3 class="centrar">¡Bienvenido a {{ env('SITIO_NAME') }}!</h3>
<br>
<p>Hola {{ $nombre_usuario }}</p>
<p>¡Felicidades! Tu cuenta ha sido creada correctamente. Estas a un clic de formar parte de {{ env('SITIO_NAME') }}, es necesario que verifiques tu cuenta.</p>
<br>
<div class="centrar">
    <a href="{{ url('activar_cuenta/'.$token) }}">
        <button class="boton">Verifica tu Cuenta</button>
    </a>
</div>
<br>
<p>Gracias por unirte y confiar en nosotros!.</p>
<br>
<p>Atentamente</p>
<p>El equipo de Lucasas!</p>

@endsection