@extends('adminlte::page')

@section('title')
	{{ $titulo }}
@endsection

@section('content_header')
	<h1>{{ $titulo }}</h1>
@stop

@section('content')
    <form method="post" action="{{ url('admin/marcas/registrar') }}">
    	@csrf
    	<div class="form-group">
			<label for="nombre">Tipo de Marca</label>
			<input type="text" name="nombre" placeholder="Tipo de Marca" id="nombre" class="form-control" required>
		</div>
   		
		<br>
		<button type="submit" class="btn btn-primary">{{ $titulo }}</button>
		<a href="{{ url('admin/marcas') }}">
			<button class="btn btn-default">Cancelar</button>
   		</a>
   	</form>

@stop