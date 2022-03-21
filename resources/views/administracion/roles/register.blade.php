@extends('adminlte::page')

@section('title')
	{{ $titulo }}
@endsection

@section('content_header')
	<h1>{{ $titulo }}</h1>
@stop

@section('content')
    <form method="post" action="{{ url('admin/roles/registrar') }}">
    	@csrf
    	<div class="form-group">
			<label for="nombre">Nombre de Rol</label>
			<input type="text" name="nombre" placeholder="Nombre" id="nombre" class="form-control" required>
		</div>
    	<div class="form-group">
			<label for="descripcion">Descripcion</label>
			<input type="text" name="descripcion" placeholder="Descripcion" id="descripcion" class="form-control" required>
		</div>
		@forelse($modulos as $modulo)
		<h3>{{ $modulo->nombre }}</h3>

			@forelse($modulo->permisos as $permiso)
			<label class="label-form"><input type="checkbox" name="{{ $permiso->id }}" value="{{ $permiso->id }}"> {{ $permiso->nombre }}</label><br>
			@empty

			@endforelse
		@empty
			<p>none</p>
		@endforelse
		<br>	
		<button type="submit" class="btn btn-primary">{{ $titulo }}</button>
		<a href="{{ url('admin/roles') }}">
			<button class="btn btn-default">Cancelar</button>
   		</a>
    </form>

@stop