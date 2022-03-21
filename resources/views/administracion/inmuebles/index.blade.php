@extends('adminlte::page')

@section('title', 'Tipos de Inmueble')

@section('content_header')
    <h1>Tipos de Inmueble</h1>
@stop

@section('content')
    <p>lista de Tipos de Inmueble</p>
    <a href="{{ url('admin/inmuebles/registrar') }}">
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
    		@forelse($inmuebles as $inmueble)
		    <tr>
				<td>{{$inmueble->id}}</td>
				<td>{{$inmueble->nombre}}</td>
				<td>{{$inmueble->created_at}}</td>
				<td>
					<!--Ver-->
					<a href="{{ url('admin/inmuebles/ver/'.$inmueble->id) }}">
						<button type="button d-inline" class="btn btn-info btn-xs"><small>Ver</small></button></a>
					</a>
					<!--Editar-->
					<a href="{{ url('admin/inmuebles/editar/'.$inmueble->id) }}">
						<button type="button d-inline" class="btn btn-default btn-xs"><small>Editar</small></button></a>
					</a>
					<!--Eliminar-->
					<form method="post" class="d-inline" action="{{ url('admin/inmuebles/eliminar/'.$inmueble->id)}}" onsubmit="return confirm('Confirma que desea eliminar el elemento?');">
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
    {{ $inmuebles->links() }}
@stop
