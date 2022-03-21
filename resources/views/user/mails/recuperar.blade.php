@extends('user.mails.master-mail')

@section('contenido')
<p>Hola,</p>
<p>Hemos recibido una solicitud para cambiar tu contraseña de Lucasas, en seguida te dejamos 
    el link para que puedas reestablecer tu contraseña y accedas al portal número uno de inmobiliaria 
    en Bolivia.
</p>
<div class="centrar">
    <a href="{{ url('reestablecer_password/'.$token) }}">
        <button class="boton">Reestablecer contraseña</button>
    </a>
</div>
<p>Atentamente,</p>
<p>El equipo de Cuentas de Lucasas</p>
<p class="small">Si tu no iniciaste el proceso de recuperación de cuenta, ignora este mensaje.</p>

@endsection

