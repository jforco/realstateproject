@extends('adminlte::page')

@section('title', 'Usuarios ADM')

@section('content_header')
    <h1>Usuarios Administrativos</h1>
@stop

@section('content')
    <p>lista de Usuarios Administrativos</p>
    <a href="{{ url('admin/usuariosAdm/registrar') }}">
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
			    <th>Telefono</th>
			    <th>Rol</th>
			    <th>Fecha de Creación</th>
			    <th>Acciones</th>
			 </tr>
    		@forelse($users as $user)
		    <tr>
				<td>{{$user->id}}</td>
				<td>{{$user->nombre}}</td>
				<td>{{$user->correo}}</td>
				<td>{{$user->telefono}}</td>

				@isset($user->rol->nombre)
				<td>{{$user->rol->nombre}}</td>
				@endisset
				@empty($user->rol->nombre)
				<td style="color: red;">Sin Rol Valido</td>
				@endempty
				
				<td>{{$user->created_at}}</td>
				<td>
					<!--Ver-->
					<a href="{{ url('admin/usuariosAdm/ver/'.$user->id) }}">
						<button type="button d-inline" class="btn btn-info btn-xs"><small>Ver</small></button></a>
					</a>
					<!--Editar-->
					<a href="{{ url('admin/usuariosAdm/editar/'.$user->id) }}">
						<button type="button d-inline" class="btn btn-default btn-xs"><small>Editar</small></button></a>
					</a>
					<!--Eliminar-->
					<form method="post" class="d-inline" action="{{ url('admin/usuariosAdm/eliminar/'.$user->id)}}" onsubmit="return confirm('Confirma que desea eliminar el elemento?');">
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
