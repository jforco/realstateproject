@extends('adminlte::page')

@section('title', 'Codigos')

@section('content_header')
    <h1>Codigos de Promocion</h1>
@stop

@section('content')
    <p>lista de Codigos de Promocion</p>
    <a href="{{ url('admin/codigos/registrar') }}">
    	<button type="button" class="btn btn-primary">
    		Registrar
    	</button>
    </a>
    
    <div class="table-responsive">
    	<br>
    	<table class="table table-hover table-bordered  bg-white">
    		<tr>
			    <th>Id</th>
			    <th>Codigo</th>
			    <th>Fecha Límite de Uso</th>
			    <th>Fecha de Creación</th>
			    <th>Acciones</th>
			 </tr>
    		@forelse($codigos as $codigo)
		    <tr>
				<td>{{$codigo->id}}</td>
				<td>{{$codigo->nombre}}</td>
				<td>{{$codigo->fecha_fin}}</td>
				<td>{{$codigo->created_at}}</td>
				<td>
					<!--Ver-->
					<a href="{{ url('admin/codigos/ver/'.$codigo->id) }}">
						<button type="button d-inline" class="btn btn-info btn-xs"><small>Ver</small></button></a>
					</a>
					<!--Editar-->
					<a href="{{ url('admin/codigos/editar/'.$codigo->id) }}">
						<button type="button d-inline" class="btn btn-default btn-xs"><small>Editar</small></button></a>
					</a>
					<!--Eliminar-->
					<form method="post" class="d-inline" action="{{ url('admin/codigos/eliminar/'.$codigo->id)}}" onsubmit="return confirm('Confirma que desea eliminar el elemento?');">
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
    {{ $codigos->links() }}
@stop
