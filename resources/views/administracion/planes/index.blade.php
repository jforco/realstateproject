@extends('adminlte::page')

@section('title', 'Planes')

@section('content_header')
    <h1>Planes de publicación</h1>
@stop

@section('content')
    <p>lista de Planes</p>
    <a href="{{ url('admin/planes/registrar') }}">
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
			    <th>Precio</th>
			    <th>Foto de vendedor</th>
			    <th>Icono</th>
			    <th>Prioridad</th>
			    <th>Cantidad de Fotos</th>
			    <th>Servicio de fotos</th>
			    <th>Cantidad de Videos</th>
			    <th>Servicio de video</th>
			    <th>Facebook</th>
			    <th>Portada</th>
			    <th>Notificaciones</th>
			    <th>Agente</th>
			    <th>Soporte</th>
			    <th>es Promocion?</th>
			    <th>Fecha de Creación</th>
			    <th>Acciones</th>
			 </tr>

    		@forelse($planes as $plan)
		    <tr>
				<td>{{$plan->id}}</td>
				<td>{{$plan->nombre}}</td>
				<td>{{$plan->precio}}</td>
				<td>{{$plan->foto_vendedor}}</td>
				<td>{{$plan->icono}}</td>
				<td>{{$plan->prioridad}}</td>
				<td>{{$plan->cant_fotos}}</td>
				<td>{{$plan->fotos_empresa}}</td>
				<td>{{$plan->cant_videos}}</td>
				<td>{{$plan->video_empresa}}</td>
				<td>{{$plan->facebook}}</td>
				<td>{{$plan->portada}}</td>
				<td>{{$plan->notificaciones}}</td>
				<td>{{$plan->elegir_agente}}</td>
				<td>{{$plan->soporte}}</td>
				<td>{{$plan->es_promocion}}</td>
				<td>{{$plan->created_at}}</td>
				<td>
					<!--Ver-->
					<a href="{{ url('admin/planes/ver/'.$plan->id) }}">
						<button type="button d-inline" class="btn btn-info btn-xs"><small>Ver</small></button></a>
					</a>
					<!--Editar-->
					<a href="{{ url('admin/planes/editar/'.$plan->id) }}">
						<button type="button d-inline" class="btn btn-default btn-xs"><small>Editar</small></button></a>
					</a>
					<!--Eliminar-->
					<form method="post" class="d-inline" action="{{ url('admin/planes/eliminar/'.$plan->id)}}" onsubmit="return confirm('Confirma que desea eliminar el elemento?');">
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
    {{ $planes->links() }}
@stop
