@extends('adminlte::page')

@section('title', 'Lugares')

@section('content_header')
    <h1>Lugares de la aplicacion</h1>
@stop

@section('content')

    <p>lista de Lugares</p>
    <a href="{{ url('admin/lugares/registrar') }}">
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
			    <th>Latitud</th>
			    <th>Longitud</th>
			    <th>Pertenece a</th>
			    <th>Tipo</th>
			    <th>Fecha de Creacion</th>
			    <th>Acciones</th>
			 </tr>
    		@forelse($lugares as $lugar)
		    <tr>
				<td>{{$lugar->id}}</td>
				<td>{{$lugar->nombre}}</td>
				<td>{{$lugar->posX}}</td>
				<td>{{$lugar->posY}}</td>
				@isset($lugar->lugar)
				<td>{{$lugar->lugar->nombre}}</td>
				@endisset

				@empty($lugar->lugar)
				<td>ninguno</td>
				@endempty
				<td>{{$lugar->tipo}}</td>
				<td>{{$lugar->created_at}}</td>
				<td>
					<!--Ver-->
					<a href="{{ url('admin/lugares/ver/'.$lugar->id) }}">
						<button type="button d-inline" class="btn btn-info btn-xs"><small>Ver</small></button></a>
					</a>
					<!--Editar-->
					<a href="{{ url('admin/lugares/editar/'.$lugar->id) }}">
						<button type="button d-inline" class="btn btn-default btn-xs"><small>Editar</small></button></a>
					</a>
					<!--Eliminar-->
					<form method="post" class="d-inline" action="{{ url('admin/lugares/eliminar/'.$lugar->id)}}" onsubmit="return confirm('Confirma que desea eliminar el elemento?');">
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
    {{ $lugares->links() }}
@stop
