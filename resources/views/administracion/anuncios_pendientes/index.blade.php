@extends('adminlte::page')

@section('title', 'Anuncios')

@section('content_header')
    <h1>Anuncios Pendientes</h1>
@stop

@section('content')
    <p>lista de los Anuncios Pendientes</p>
    <div class="table-responsive">
    	<br>
    	<table class="table table-hover table-bordered  bg-white">
    		<tr>
			    <th>Codigo</th>
			    <th>Tipo de Inmueble</th>
			    <th>Direccion</th>
			    <th>Tipo de Oferta</th>
			    <th>Precio</th>
			    <th>Moneda</th>
			    <th>Estado</th>
			    <th>Fecha de Creación</th>
			    <th>Acciones</th>
			 </tr>
    		@forelse($anuncios as $anuncio)
		    <tr>
				<td>{{$anuncio->codigo}}</td>
				<td>{{$anuncio->tipo_inmueble}}</td>
				<td>{{$anuncio->direccion}}</td>
				<td>{{$anuncio->tipo_oferta}}</td>
				<td><span class="precio">{{$anuncio->precio}}</span></td>
				<td>{{$anuncio->moneda}}</td>
				<td>
					@if($anuncio->estado == 'pendiente')
					<span class="label label-warning">{{$anuncio->estado}}</span>
					@else
					<span class="label label-success">{{$anuncio->estado}}</span>
					@endif
				</td>
				<td>{{$anuncio->created_at}}</td>
				<td>
					<!--Ver-->
					<a href="{{ url('admin/pendientes/ver/'.$anuncio->id) }}">
						<button type="button d-inline" class="btn btn-info btn-xs"><small>Ver</small></button></a>
					</a>
					<!--Editar-->
					<a href="{{ url('admin/pendientes/editar/'.$anuncio->id) }}">
						<button type="button d-inline" class="btn btn-default btn-xs"><small>Editar</small></button></a>
					</a>
					<!--Eliminar-->
					<form method="post" class="d-inline" action="{{ url('admin/pendientes/eliminar/'.$anuncio->id)}}" onsubmit="return confirm('Confirma que desea eliminar el elemento?');">
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
    {{ $anuncios->links() }}
@endsection

@section('js')
<script type="text/javascript">
	$( document ).ready(function() {
		$('.precio').each(function(){
			let nro = $(this).html();
			$(this).html(new Intl.NumberFormat('es-MX').format(nro));
		});

	});
</script>
@endsection
