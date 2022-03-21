<?php

//URLS PARA ACCESO PUBLICO
Route::get('/mail', function () {
    return new App\Mail\activarCuenta("token1234", "nombree");
});

//Rutas con controladores en la carpeta "App\Http\Controllers\Admin"


Route::namespace('Admin')->group(function () {
	
    // Rutas con el prefijo '/admin/'
    Route::prefix('admin')->group(function () {
    	// rutas de autenticacion
		
    	Route::get('login', 'AuthController@show_login');
    	Route::post('login', 'AuthController@login');
	    	
    	Route::middleware(['admin'])->group(function () {
			
		    Route::get('', 'AdministracionController@index');
	    	Route::post('logout', 'AuthController@logout');

	    	//Gestion de usuarios Adm
	    	Route::prefix('usuariosAdm')->group(function(){
	    		//ver todos
	    		Route::get('', 'UsuarioAdmController@index');
	    		//ver uno
	    		Route::get('ver/{id}', 'UsuarioAdmController@show');
	    		//registrar
	    		Route::get('registrar', 'UsuarioAdmController@show_registrar');
	    		Route::post('registrar', 'UsuarioAdmController@registrar');
	    		//editar
	    		Route::get('editar/{id}', 'UsuarioAdmController@show_editar');
	    		Route::post('editar/{id}', 'UsuarioAdmController@editar');
	    		//eliminar
	    		Route::post('eliminar/{id}', 'UsuarioAdmController@eliminar');
	    	});

	    	//Gestion de roles
	    	Route::prefix('roles')->group(function(){
	    		//ver todos
	    		Route::get('', 'RolController@index');
	    		//ver uno
	    		Route::get('ver/{id}', 'RolController@show');
	    		//registrar
	    		Route::get('registrar', 'RolController@show_registrar');
	    		Route::post('registrar', 'RolController@registrar');
	    		//editar
	    		Route::get('editar/{id}', 'RolController@show_editar');
	    		Route::post('editar/{id}', 'RolController@editar');
	    		//eliminar
	    		Route::post('eliminar/{id}', 'RolController@eliminar');
	    	});

	    	//Gestion de lugares
	    	Route::prefix('lugares')->group(function(){
	    		//ver todos
	    		Route::get('', 'LugarController@index');
	    		//ver uno
	    		Route::get('ver/{id}', 'LugarController@show');
	    		//registrar
	    		Route::get('registrar', 'LugarController@show_registrar');
	    		Route::post('registrar', 'LugarController@registrar');
	    		//editar
	    		Route::get('editar/{id}', 'LugarController@show_editar');
	    		Route::post('editar/{id}', 'LugarController@editar');
	    		//eliminar
	    		Route::post('eliminar/{id}', 'LugarController@eliminar');
	    	});

	    	//Gestion de usuarios
	    	Route::prefix('usuarios')->group(function(){
	    		//ver todos
	    		Route::get('', 'UsuarioController@index');
	    		//ver uno
	    		Route::get('ver/{id}', 'UsuarioController@show');
	    		//registrar
	    		Route::get('registrar', 'UsuarioController@show_registrar');
	    		Route::post('registrar', 'UsuarioController@registrar');
	    		//editar
	    		Route::get('editar/{id}', 'UsuarioController@show_editar');
	    		Route::post('editar/{id}', 'UsuarioController@editar');
	    		//eliminar
	    		Route::post('eliminar/{id}', 'UsuarioController@eliminar');
	    	});

	    	//Gestion de usuarios
	    	Route::prefix('agentes')->group(function(){
	    		//ver todos
	    		Route::get('', 'AgenteController@index');
	    		//ver uno
	    		Route::get('ver/{id}', 'AgenteController@show');
	    		//registrar
	    		Route::get('registrar', 'AgenteController@show_registrar');
	    		Route::post('registrar', 'AgenteController@registrar');
	    		//editar
	    		Route::get('editar/{id}', 'AgenteController@show_editar');
	    		Route::post('editar/{id}', 'AgenteController@editar');
	    		//eliminar
	    		Route::post('eliminar/{id}', 'AgenteController@eliminar');
	    	});

	    	//Gestion de tipos de inmueble
	    	Route::prefix('inmuebles')->group(function(){
	    		//ver todos
	    		Route::get('', 'InmuebleController@index');
	    		//ver uno
	    		Route::get('ver/{id}', 'InmuebleController@show');
	    		//registrar
	    		Route::get('registrar', 'InmuebleController@show_registrar');
	    		Route::post('registrar', 'InmuebleController@registrar');
	    		//editar
	    		Route::get('editar/{id}', 'InmuebleController@show_editar');
	    		Route::post('editar/{id}', 'InmuebleController@editar');
	    		//eliminar
	    		Route::post('eliminar/{id}', 'InmuebleController@eliminar');
	    	});

	    	//Gestion de tipos de ofertas
	    	Route::prefix('ofertas')->group(function(){
	    		//ver todos
	    		Route::get('', 'OfertaController@index');
	    		//ver uno
	    		Route::get('ver/{id}', 'OfertaController@show');
	    		//registrar
	    		Route::get('registrar', 'OfertaController@show_registrar');
	    		Route::post('registrar', 'OfertaController@registrar');
	    		//editar
	    		Route::get('editar/{id}', 'OfertaController@show_editar');
	    		Route::post('editar/{id}', 'OfertaController@editar');
	    		//eliminar
	    		Route::post('eliminar/{id}', 'OfertaController@eliminar');
	    	});

	    	//Gestion de marcas usadas
	    	Route::prefix('marcas')->group(function(){
	    		//ver todos
	    		Route::get('', 'MarcaController@index');
	    		//ver uno
	    		Route::get('ver/{id}', 'MarcaController@show');
	    		//registrar
	    		Route::get('registrar', 'MarcaController@show_registrar');
	    		Route::post('registrar', 'MarcaController@registrar');
	    		//editar
	    		Route::get('editar/{id}', 'MarcaController@show_editar');
	    		Route::post('editar/{id}', 'MarcaController@editar');
	    		//eliminar
	    		Route::post('eliminar/{id}', 'MarcaController@eliminar');
	    	});

	    	//Gestion de codigos de promocion
	    	Route::prefix('codigos')->group(function(){
	    		//ver todos
	    		Route::get('', 'CodigoController@index');
	    		//ver uno
	    		Route::get('ver/{id}', 'CodigoController@show');
	    		//registrar
	    		Route::get('registrar', 'CodigoController@show_registrar');
	    		Route::post('registrar', 'CodigoController@registrar');
	    		//editar
	    		Route::get('editar/{id}', 'CodigoController@show_editar');
	    		Route::post('editar/{id}', 'CodigoController@editar');
	    		//eliminar
	    		Route::post('eliminar/{id}', 'CodigoController@eliminar');
	    	});

	    	//Gestion de anuncios 
	    	Route::prefix('anuncios')->group(function(){
			
	    		//ver todos
	    		Route::get('', 'AnuncioController@index');
				//ver todos y filtrado por combo
				Route::get('filtrarestadoanuncio', 'AnuncioController@filtrar_anuncio');
				//pasarela-Prueba
				Route::get('pruebapasarela', 'AnuncioController@prueba_pasarela');
			
	    		//ver uno
	    		Route::get('ver/{id}', 'AnuncioController@show');
	    		//editar
	    		Route::get('editar/{id}', 'AnuncioController@show_editar');
	    		Route::post('editar/{id}', 'AnuncioController@editar');
	    		//eliminar
	    		Route::post('eliminar/{id}', 'AnuncioController@eliminar');
	    	});

		});
	});
});

//Rutas con controladores en la carpeta "App\Http\Controllers\User"
Route::namespace('User')->group(function(){
	//inicio
	Route::get('', 'BusquedaController@index');
	
	//urls de registro y login con facebook
	Route::get('auth/{provider}', 'SocialAuthController@redirectToProvider')->name('social.auth');
	Route::get('auth/{provider}/callback', 'SocialAuthController@handleProviderCallback');

	//pagoexitoso
	Route::get('pagoexitoso/{id}', 'AnuncioController@pago_exitoso');
	//pagoCancelado
	Route::get('pagocancelado', 'AnuncioController@pago_cancelado');

	//urls de registro y login con datos
	Route::post('register', 'AuthController@register');
	Route::post('login', 'AuthController@login');
	Route::post('logout', 'AuthController@logout');

	//url de activacion de cuenta por email
	Route::get('activar_cuenta/{token}', 'AuthController@activar');

	//busquedas
	Route::get('buscar', 'BusquedaController@buscar');
	Route::get('anuncios/{codigo}', 'AnuncioController@ver_publicacion');

	//contactar vendedor
	Route::get('contactar_vendedor', 'AnuncioController@contactar_vendedor');

	Route::get('agentes/{id}', 'UserController@ver_agente');

	Route::get('contacto', 'UserController@contacto');
	Route::post('contacto', 'UserController@contacto_process');
	
	Route::view('/politicadeprivacidad', 'politicas');
	Route::view('/terminosdeuso', 'terminos');
	Route::view('/centro-de-ayuda', 'centrodeayuda');
	Route::view('/recorrido-360', 'recorrido');
	Route::view('/fotos-profesionales', 'fotosprofesionales');
	Route::view('/video-profesional', 'videoprofesional');
	Route::view('/agente-inmobiliario', 'agenteinmobiliario');
	Route::view('/como-comprar', 'comocomprar');
	Route::view('/acerca-de-nosotros', 'acercadenosotros');

	//recuperarContraseña
	Route::middleware(['guest'])->group(function (){
		Route::get('recuperar_contra', 'UserController@recuperacion_ver');
		Route::post('recuperacion', 'UserController@recuperacion_enviar');
		Route::get('reestablecer_password/{token}', 'UserController@recuperacion_nuevo_password');
		Route::post('reestablecer_password', 'UserController@recuperacion_confirmacion');
	});

	//Urls de gestion de datos de usuario
	Route::middleware(['user'])->group(function (){
		//ver perfil
		Route::get('perfil', 'UserController@perfil');
		//ver mis anuncios
		Route::get('mis-anuncios', 'UserController@mis_anuncios');
		//ver mis anuncios
		Route::get('mis-favoritos', 'UserController@mis_favoritos');
		//ver los anuncios donde soy agente
		Route::get('mis-anuncios-agente', 'UserController@mis_anuncios_agente');
		//editar perfil
		Route::post('edit', 'UserController@editar');
		//cambiar contraseña
		Route::post('cambiarContra', 'UserController@cambiarContra');
		//cambiar foto
		Route::post('cambiarAvatar', 'UserController@cambiarAvatar');
		//registrar agente
		Route::get('registrarAgente', 'UserController@registrarAgente');
		//eliminar registro de agente
		Route::get('eliminarAgente', 'UserController@eliminarRegistroAgente');
		//eliminar cuenta
		Route::post('eliminarCuenta', 'UserController@eliminarCuenta');

		//elegir plan de publicacion
		Route::get('arma_tu_plan', 'AnuncioController@ver_planes');
		Route::post('nueva_publicacion', 'AnuncioController@plan_elegido');
		
		// ver formulario, guardar y eliminar, marcar favorito
		Route::get('anuncios/{codigo}/editar', 'AnuncioController@editar_formulario');
		Route::post('anuncios/{codigo}/guardar', 'AnuncioController@guardar_formulario');
		//cambiar a vendido
		Route::post('exito_anuncio', 'AnuncioController@exito_publicacion');
		//cancelado
		Route::post('eliminar_anuncio', 'AnuncioController@eliminar_publicacion');
		//marcar favorito
		Route::get('guardar_favorito', 'AnuncioController@guardar_favorito');
		

		//subir imagenes
		Route::post('subir_imagen/{codigo}', 'UploadMediaController@storeImage');
		Route::post('eliminar_imagen', 'UploadMediaController@destroy');
		Route::post('eliminar_imagen2', 'UploadMediaController@destroy');

		//calificar agente
		Route::post('calificar_agente', 'AnuncioController@calificar_agente');
	});
	
});

	