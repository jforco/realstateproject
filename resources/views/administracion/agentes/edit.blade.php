@extends('adminlte::page')

@section('title')
	{{ $titulo }}
@endsection

@section('content_header')
	<h1>{{ $titulo }}</h1>
@stop

@section('content')

    <form method="post" action="{{ url('admin/agentes/editar/'.$user->id) }}" enctype="multipart/form-data">
    	@csrf
    	<div class="form-group">
			<label for="nombre">Nombre de Usuario</label>
			<input type="text" name="nombre" placeholder="Nombre" id="nombre" class="form-control" value="{{ $user->nombre }}" required>
		</div>
   		<div class="form-group">
			<label for="correo">Correo</label>
			<input type="text" name="correo" placeholder="Correo" id="correo" class="form-control" value="{{ $user->correo }}" required>
		</div>
		<div class="form-group">
			<label>Genero</label><br>
			<label><input type="radio" name="genero" value="masculino" id="masc"> Masculino</label>
	        <label><input type="radio" name="genero" value="femenino" id="fem"> Femenino</label>
		</div>
		<div class="form-group">
			<label for="avatar">Avatar</label>
			<input type="file" class="form-control-file" name="avatar" id="avatar" accept=".png, .jpg, .jpeg">
			<img src="{{  url($user->avatar) }}" width="100px" height="100px">
		</div>
		<div class="form-group">
			<label for="fecha_nac">Fecha de Nacimiento</label>
			<input type="date" name="fecha_nac" class="form-control" id="fecha_nac" value="{{ $user->fecha_nac }}">
		</div>
		<div class="form-group">
			<label for="password">Contraseña (dejar vacio para mantener la anterior)</label>
			<input type="password" name="password" placeholder="password" id="password" class="form-control">
		</div>
		<div class="form-group">
			<label><input type="checkbox" name="agente" value="si" id="checkbox-agente"> Habilitar como agente</label><br>
		</div>
		<br>
		<button type="submit" class="btn btn-primary">{{ $titulo }}</button>
		<a href="{{ url('admin/agentes') }}">
			<button class="btn btn-default">Cancelar</button>
   		</a>
   	</form>

@stop

@section('js')

<script type="text/javascript">

	@if($user->genero === 'masculino')
	$("#masc").prop("checked", true);
	@else
	$("#fem").prop("checked", true);
	@endif

	@if($user->agente === 'si')
	$("#checkbox-agente").prop("checked", true);
	@endif

</script>

@endsection