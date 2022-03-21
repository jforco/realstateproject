@extends('administracion.master')

@section('title')
	{{ $titulo }}
@endsection

@section('contenido_titulo')
	<h1>{{ $titulo }}</h1>
@stop

@section('contenido')
    <form method="post" action="{{ url('admin/ofertas/registrar') }}">
    	@csrf
    	<div class="form-group">
			<label for="nombre">Tipo de Oferta</label>
			<input type="text" name="nombre" placeholder="Tipo de Oferta" id="nombre" class="form-control" required>
		</div>
   		
		<br>
		<button type="submit" class="btn btn-primary">{{ $titulo }}</button>
		<a href="{{ url('admin/ofertas') }}">
			<button class="btn btn-default">Cancelar</button>
   		</a>
   	</form>

@stop