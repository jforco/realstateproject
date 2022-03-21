@extends('layouts.master')

@section('titulo', 'Perfil')

@section('body')
<br><br><br>
<div class="row no-gutters">

	<div class="col-2 col-sm-1">
		<div class="barraLateral py-3 shadow" id="menuUsuario">
			
			<div class="itemLateral" id="perfil">
				<a href="{{ url('perfil') }}" class="link">
					<div class="py-2">
						<div class="img-item">
							<img src="{{ url('img/perfil-blanco.png') }}" width="100%">
						</div>
						<p class="text-center text-white titulo-link p-0 m-0">Mi Perfil</p>
					</div>
				</a>
			</div>

			<div class="itemLateral" id="mis-anuncios">
				<a href="{{ url('mis-anuncios') }}" class="link">
					<div class="py-2">
						<div class="img-item">
							<img src="{{ url('img/anuncios-blanco.png') }}" width="100%">
						</div>
						<p class="text-center text-white titulo-link p-0 m-0">Mis Anuncios</p>
					</div>
				</a>
			</div>

			<div class="itemLateral" id="mis-favoritos">
				<a href="{{ url('mis-favoritos') }}" class="link">
					<div class="py-2">
						<div class="img-item">
							<img src="{{ url('img/favoritos-blanco.png') }}" width="100%">
						</div>
						<p class="text-center text-white titulo-link p-0 m-0">Mis Favoritos</p>
					</div>
				</a>
			</div>

			@if(Auth::user()->agente == 'si')
			<div class="itemLateral" id="mis-anuncios-agente">
				<a href="{{ url('mis-anuncios-agente') }}" class="link">
					<div class="py-2">
						<div class="img-item">
							<img src="{{ url('img/anuncios-blanco.png') }}" width="100%">
						</div>
						<p class="text-center text-white titulo-link p-0 m-0">Soy Agente</p>
					</div>
				</a>
			</div>
			@endif
		</div>
	</div>

	<div class="col-9 col-sm-10">
		<div class="p-0">
			<br>
			@yield('contenido-user')
		</div>
	</div>
			


</div>

@endsection