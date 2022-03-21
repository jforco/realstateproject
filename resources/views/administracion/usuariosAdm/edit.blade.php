@extends('adminlte::page')

@section('title')
	{{ $titulo }}
@endsection

@section('content_header')
	<h1>{{ $titulo }}</h1>
@stop

@section('content')

    <form method="post" action="{{ url('admin/usuariosAdm/editar/'.$user->id) }}">
    	@csrf
    	<div class="form-group">
			<label for="nombre">Nombre de Usuario ADM</label>
			<input type="text" name="nombre" placeholder="Nombre" id="nombre" class="form-control" value="{{ $user->nombre }}" required>
		</div>
    	<div class="form-group">
			<label for="correo">Correo</label>
			<input type="text" name="correo" placeholder="Correo" id="correo" class="form-control" value="{{ $user->correo }}" required>
		</div>
		<div class="form-group">
			<label for="telefono">Telefono</label>
			<input type="text" name="telefono" placeholder="Telefono" id="telefono" class="form-control" value="{{ $user->telefono }}">
		</div>
		<label>Rol del Usuario</label>
		<select name="id_rol">
			@forelse($roles as $rol)
			<option value="{{ $rol->id }}" id="$rol->id">{{ $rol->nombre }}</option>
			@empty
			<p>No hay roles definidos.   Definir antes de crear un usuario.</p>
			@endforelse
			</select>
		<div class="form-group">
			<label for="password">Contraseña <small>(dejar vacio para mantener la misma)</small></label>
			<input type="password" name="password" placeholder="password" id="password" class="form-control">
		</div>
		<br>
		<button type="submit" class="btn btn-primary">{{ $titulo }}</button>
		<a href="{{ url('admin/usuariosAdm') }}">
			<button class="btn btn-default">Cancelar</button>
   		</a>
    </form>

@stop

@section('js')
<script type="text/javascript">
	$(document).ready(function(){ 
		$('#{{ $user->id_rol }}').prop('selected', true);
	});
</script>

@endsection