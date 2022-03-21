@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Roles Administrativos</h1>
@stop

@section('content')
    <p>lista de Roles Administrativos</p>
    <a href="{{ url('admin/roles/registrar') }}">
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
			    <th>Descripcion</th>
			    <th>Fecha de Creación</th>
			    <th>Acciones</th>
			 </tr>
    		@forelse($roles as $rol)
		    <tr>
				<td>{{$rol->id}}</td>
				<td>{{$rol->nombre}}</td>
				<td>{{$rol->descripcion}}</td>
				<td>{{$rol->created_at}}</td>
				<td>
					<!--Ver-->
					<a href="{{ url('admin/roles/ver/'.$rol->id) }}">
						<button type="button d-inline" class="btn btn-info btn-xs"><small>Ver</small></button></a>
					</a>
					<!--Editar-->
					<a href="{{ url('admin/roles/editar/'.$rol->id) }}">
						<button type="button d-inline" class="btn btn-default btn-xs"><small>Editar</small></button></a>
					</a>
					<!--Eliminar-->
					<form method="post" class="d-inline" action="{{ url('admin/roles/eliminar/'.$rol->id)}}" onsubmit="return confirm('Confirma que desea eliminar el elemento?');">
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
    {{ $roles->links() }}
@stop
