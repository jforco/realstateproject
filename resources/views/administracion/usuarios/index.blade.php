@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios de la plataforma</h1>
@stop

@section('content')
    <p>lista de Usuarios que usan la plataforma</p>
    <a href="{{ url('admin/usuarios/registrar') }}">
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
			    <th>Correo</th>
			    <th>Genero</th>
			    <th>Avatar</th>
			    <th>Fecha de Creación</th>
			    <th>Acciones</th>
			</tr>
    		@forelse($users as $user)
		    <tr>
				<td>{{$user->id}}</td>
				<td>{{$user->nombre}}</td>
				<td>{{$user->correo}}</td>
				<td>{{$user->genero}}</td>

				<td><img src="{{ url($user->avatar) }}" height="30px" width="30px"></td>
				
				<td>{{$user->created_at}}</td>
				<td>
					<!--Ver-->
					<a href="{{ url('admin/usuarios/ver/'.$user->id) }}">
						<button type="button d-inline" class="btn btn-info btn-xs"><small>Ver</small></button></a>
					</a>
					<!--Editar-->
					<a href="{{ url('admin/usuarios/editar/'.$user->id) }}">
						<button type="button d-inline" class="btn btn-default btn-xs"><small>Editar</small></button></a>
					</a>
					<!--Eliminar-->
					<form method="post" class="d-inline" action="{{ url('admin/usuarios/eliminar/'.$user->id)}}" onsubmit="return confirm('Confirma que desea eliminar el elemento?');">
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
    {{ $users->links() }}
@stop
