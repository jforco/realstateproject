@extends('adminlte::page')

@section('title')
	{{ $titulo }}
@endsection

@section('content_header')

<div class="row">
	<div class="col-sm-8 col-sm-offset-2">
		<h1>{{ $titulo }}</h1>
	</div>
</div>
	
@stop

@section('content')
<br>
<div class="row">
	<div class="col-sm-8 col-sm-offset-2">
		<p>No tienes los permisos necesarios para acceder a esta seccion.</p>
	</div>
</div>

@stop