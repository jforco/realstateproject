@extends('adminlte::page')

@section('title', 'Tipos de Oferta')

@section('content_header')
    <h1>Tipos de Oferta</h1>
@stop

@section('content')
    <p>lista de Tipos de Oferta</p>
    <a href="{{ url('admin/ofertas/registrar') }}">
    	<button type="button" class="btn btn-primary">
    		Registrar
    	</button>
    </a>
    
    <div class="table-responsive">
    	<br>
    	<table class="table table-hover table-bordered  bg-white">
    		<tr>
			    <th>Id</th>
			    <th>Nombre</th>
			    <th>Fecha de Creación</th>
			    <th>Acciones</th>
			 </tr>
    		@forelse($ofertas as $oferta)
		    <tr>
				<td>{{$oferta->id}}</td>
				<td>{{$oferta->nombre}}</td>
				<td>{{$oferta->created_at}}</td>
				<td>
					<!--Ver-->
					<a href="{{ url('admin/ofertas/ver/'.$oferta->id) }}">
						<button type="button d-inline" class="btn btn-info btn-xs"><small>Ver</small></button></a>
					</a>
					<!--Editar-->
					<a href="{{ url('admin/ofertas/editar/'.$oferta->id) }}">
						<button type="button d-inline" class="btn btn-default btn-xs"><small>Editar</small></button></a>
					</a>
					<!--Eliminar-->
					<form method="post" class="d-inline" action="{{ url('admin/ofertas/eliminar/'.$oferta->id)}}" onsubmit="return confirm('Confirma que desea eliminar el elemento?');">
						@csrf
						<button type="submit" class="btn btn-danger btn-xs"><small>Eliminar</small></button></a>
					</form>
				</td>
			</tr>
		    @empty
		    <tr>
		    	<td></td>
		    	<td>No hay registros aun.</td>
		    </tr>
		    	
		    @endforelse
    	</table>
    </div>
    {{ $ofertas->links() }}
@stop
