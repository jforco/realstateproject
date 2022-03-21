@extends('adminlte::page')

@section('title')
	{{ $titulo }}
@endsection

@section('content_header')
	<h1>{{ $titulo }}</h1>
@stop

@section('contenido')
    <form method="post" action="{{ url('admin/ofertas/editar/'.$oferta->id) }}">
    	@csrf
    	<div class="form-group">
			<label for="nombre">Nombre de Tipo de Oferta</label>
			<input type="text" name="nombre" placeholder="Nombre" id="nombre" class="form-control" value="{{ $oferta->nombre }}" required>
		</div>
		<br>
		<button type="submit" class="btn btn-primary">{{ $titulo }}</button>
		<a href="{{ url('admin/ofertas') }}">
			<button class="btn btn-default">Cancelar</button>
   		</a>
    </form>
@stop
