@extends('adminlte::page')

@section('title')
	{{ $titulo }}
@endsection

@section('content_header')
	<h1>{{ $titulo }}</h1>
@stop

@section('content')
    <form method="post" action="{{ url('admin/marcas/editar/'.$marca->id) }}">
    	@csrf
    	<div class="form-group">
			<label for="nombre">Nombre de Marca</label>
			<input type="text" name="nombre" placeholder="Nombre" id="nombre" class="form-control" value="{{ $marca->nombre }}" required>
		</div>
		<br>
		<button type="submit" class="btn btn-primary">{{ $titulo }}</button>
		<a href="{{ url('admin/marcas') }}">
			<button class="btn btn-default">Cancelar</button>
   		</a>
    </form>
@stop
