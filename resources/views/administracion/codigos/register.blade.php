@extends('adminlte::page')

@section('title')
	{{ $titulo }}
@endsection

@section('content_header')
	<h1>{{ $titulo }}</h1>
@stop

@section('content')
    <form method="post" action="{{ url('admin/codigos/registrar') }}">
    	@csrf
    	<div class="form-group">
			<label for="nombre">Código de Promocion</label>
			<input type="text" name="nombre" id="nombre" class="form-control" value="{{ $codigo }}" required>
		</div>

		<a href="{{ url('admin/codigos/registrar') }}" >
			<button class="btn btn-info">Nuevo Codigo</button>
		</a>

   		<div class="form-group">
   			<br>
			<label for="nombre">Fecha Límite de Uso</label>
			<input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
		</div>

		<br>
		<button type="submit" class="btn btn-primary">{{ $titulo }}</button>
		<a href="{{ url('admin/codigos') }}">
			<button class="btn btn-default">Cancelar</button>
   		</a>
   	</form>

@stop