<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />

    <title>@yield('titulo')</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">  
    <!-- Styles -->
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{asset('img/lucasas-logo2.png')}}" rel="icon">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
    @yield('css')
</head>
<body>
    <!-- #header -->   
    <section id="menu">
        <!--barra de navegacion-->
        <nav class="navbar navbar-expand-md fixed-top bg-principal py-1 shadow" id="navbar_principal">
            <!--<div class="container">-->
                <a class="navbar-brand py-0 text-white" href="{{ url('') }}">
                    <img src="{{ url('/img/nuevo_logo.png') }}" class="imagen_logo"/>
                </a>
                <button class="navbar-toggler align-middle" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="fa fa-bars"></i></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto letra-small">

                        @guest
                        <li class="nav-item m-1">
                            <a class="nav-link btn btn-principal-orange btn-sm py-1" id="registerLink" href="" data-toggle="modal" data-target="#accesoModal">Registrate</a>
                        </li>
                        <li class="nav-item m-1">
                            <a class="nav-link btn btn-principal-orange btn-sm py-1" id="loginLink" href="" data-toggle="modal" data-target="#accesoModal">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item m-1">
                            <a class="nav-link btn btn-principal-orange btn-sm py-1" href="{{ route('social.auth', 'facebook') }}">Iniciar sesion con Facebook</a>
                        </li>
                        @endguest

                        @auth
                        <li class="nav-item m-1">
                            <a class="nav-link btn btn-grad -o btn-sm py-1" href="{{ url('arma_tu_plan') }}">Publicar Nuevo
                            </a>
                        </li>
                        <li class="nav-item dropdown m-1">
                            <a class="nav-link btn btn-grad -o btn-sm letra-small dropdown-toggle py-1" href="#" id="perfilDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="d-inline" src="{{ asset(Auth::user()->avatar) }}" alt="{{ Auth::user()->nombre }}" height="19px">
                                <p class="d-inline m-0 px-1 nombre_user">{{Auth::user()->nombre}}</p>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right letra-small" aria-labelledby="perfilDropdown">
                                <a class="dropdown-item" href="{{ url('perfil') }}">
                                    <i class="fa fa-user pl-1" aria-hidden="true"></i> Perfil
                                    @if(Auth::user()->agente === 'si')
                                    <span>(de Agente)</span>
                                    @endif
                                </a>
                                <a class="dropdown-item" href="{{ url('mis-anuncios') }}">
                                    <i class="fa fa-volume-off pl-2" aria-hidden="true"></i> Mis anuncios
                                </a>
                                <a class="dropdown-item" href="{{ url('mis-favoritos') }}">
                                    <i class="fa fa-heart" aria-hidden="true"></i> Mis favoritos
                                </a>
                                @if(Auth::user()->agente == 'si')
                                <a class="dropdown-item" href="{{ url('mis-anuncios-agente') }}">
                                    <i class="fa fa-volume-off pl-2" aria-hidden="true"></i> Soy agente
                                </a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <form method="post" action="{{ url('logout') }}">
                                    @csrf
                                    
                                    <input type="submit" class="logout-link" value="Cerrar Sesion">
                                </form>
                            </div>
                        </li>
                        @endauth

                    </ul>
                </div>
            <!--</div>-->
        </nav>
    </section>
    @guest
    <section class="letra-small">
        <!-- Modal register/login -->
        <div class="modal fade" id="accesoModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link" id="register-title" data-toggle="tab" href="#register-content">REGISTRATE</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="login-title" data-toggle="tab" href="#login-content">INICIAR SESION</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane" id="register-content">
                                <div class="row">
                                    <div class="col-10 offset-1">
                                        <br>
                                        <form action="{{ url('register') }}" method="post" id="registro_form">
                                            @csrf
                                            <input class="form-control" type="text" name="nombre" placeholder="Nombre" required><br>
                                            <input class="form-control" type="text" name="correo" placeholder="Correo" required><br>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <select id="banderas_select" class="custom-select-sm" form="registro_form">
                                                        <option value="+54" data-imagesrc="{{ url('img/icons/banderas/argentina.png') }}">+54</option>
                                                        <option value="+591" data-imagesrc="{{ url('img/icons/banderas/bolivia.png') }}" selected>+591</option>
                                                        <option value="+55" data-imagesrc="{{ url('img/icons/banderas/brasil.png') }}" selected>+55</option>
                                                        <option value="+56" data-imagesrc="{{ url('img/icons/banderas/chile.png') }}" selected>+56</option>
                                                        <option value="+57" data-imagesrc="{{ url('img/icons/banderas/colombia.png') }}" selected>+57</option>
                                                        <!--<option value="+506" data-imagesrc="{{ url('img/icons/banderas/costa-rica.png') }}" selected>+506</option>
                                                        <option value="+53" data-imagesrc="{{ url('img/icons/banderas/cuba.png') }}" selected>+53</option>-->
                                                        <option value="+593" data-imagesrc="{{ url('img/icons/banderas/ecuador.png') }}" selected>+593</option>
                                                        <!--<option value="+503" data-imagesrc="{{ url('img/icons/banderas/el-salvador.png') }}" selected>+503</option>
                                                        <option value="+502" data-imagesrc="{{ url('img/icons/banderas/guatemala.png') }}" selected>+502</option>
                                                        <option value="+504" data-imagesrc="{{ url('img/icons/banderas/honduras.png') }}" selected>+504</option>-->
                                                        <!--<option value="+52" data-imagesrc="{{ url('img/icons/banderas/mexico.png') }}" selected>+52</option>
                                                        <option value="+505" data-imagesrc="{{ url('img/icons/banderas/nicaragua.png') }}" selected>+505</option>
                                                        <option value="+507" data-imagesrc="{{ url('img/icons/banderas/panama.png') }}" selected>+507</option>-->
                                                        <option value="+595" data-imagesrc="{{ url('img/icons/banderas/paraguay.png') }}" selected>+595</option>
                                                        <option value="+51" data-imagesrc="{{ url('img/icons/banderas/peru.png') }}" selected>+51</option>
                                                        <!--<option value="+1" data-imagesrc="{{ url('img/icons/banderas/puerto-rico.png') }}" selected>+1</option>-->
                                                        <option value="+598" data-imagesrc="{{ url('img/icons/banderas/uruguay.png') }}" selected>+598</option>
                                                        <option value="+58" data-imagesrc="{{ url('img/icons/banderas/venezuela.png') }}" selected>+58</option>
                                                    </select>
                                                </div>
                                                <input type="telefono" class="form-control" name="telefono" id="input_telefono" pattern="\d*" title="Un telefono solo contiene Números" required>
                                            </div>
                                            <input type="hidden" id="hidden_codigo" class="form-control" name="codigo" value="+591" required>
                                            <label><input type="radio" name="genero" value="masculino" checked> Masculino</label>
                                            <label><input type="radio" name="genero" value="femenino"> Femenino</label>
                                            <br>
                                            <input class="form-control" type="password" name="password1" placeholder="Contraseña" required><br>
                                            <input class="form-control" type="password" name="password2" placeholder="Repita Contraseña" required><br>
                                            <input class="form-check-input ml-0" type="checkbox" value="si" name="inmobiliaria" id="inmobiliaria_check">
                                            <label class="form-check-label ml-4 mb-3" for="inmobiliaria_check">
                                                Soy Agente Inmobiliario
                                            </label>
                                            <p class="small px-5">* Al registrarse Ud. está aceptando las 
                                                <a href="{{ url('politicadeprivacidad') }}" class="link"><u>políticas de privacidad</u></a> y los 
                                                <a href="{{ url('terminosdeuso') }}" class="link"><u>términos de uso</u></a>.
                                            </p>
                                            <input type="submit" class="btn btn-principal form-control" value="Registrarte">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="login-content">
                                <div class="row">
                                    <div class="col-10 offset-1">
                                        <br>
                                        <form action="{{ url('login') }}" method="post" id="login_form">
                                            @csrf
                                            <input class="form-control" type="email" name="correo" placeholder="Correo" required><br>
                                            <input class="form-control" type="password" name="password" placeholder="Contraseña" required><br>
                                            <input type="submit" class="btn btn-principal form-control" value="Iniciar Sesion">
                                        </form>
                                        <br>
                                        <a href="{{ url('recuperar_contra') }}" class="link"><u>Olvidé mi contraseña</u></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer py-0">
                        <p class="pt-3">Tambien puedes </p>
                        <a class="btn botonFacebook letra-small p-1 mt-0 text-white" href="{{ route('social.auth', 'facebook') }}">Iniciar sesion con Facebook</a>
                    </div>
                </div>
            </div>
        </div>
                        
    </section>
    @endguest

    <section id="body">
        @yield('body')
    </section>

    <section class="bg-principal" id="footer_master">
   
    <div class="container p-4 pb-0">
    
      <!-- Section: Links -->
      <section class="">
        <!--Grid row-->
        <div class="row ">
           <div class="col-xs-12 col-sm-6 col-md-3 logo-part">
    		    <div class="footers-logo">
    		        <img src="{{ url('/img/nuevo_logo.png') }}" alt="Logo" style="width:150px;">
    		    </div>
    		    
    		    <div class="social-icons"> 
            <a href="https://www.facebook.com/Lucasas-708208516684105" target="blank" class="text-white">
                                <img src="{{ url('/img/fb.png') }}" width="20" /> 
                            </a> 
                            <a href="https://www.instagram.com/lucasas_portal_inmobiliario/" target="blank" class="text-white">
                                <img src="{{ url('/img/insta.png') }}" width="20"/> 
                            </a>
                            <a href="https://www.youtube.com/channel/UCmKhHUPHwVrwxgUREuC8LUw" target="blank" class="text-white">
                                <img src="{{ url('/img/yout.png') }}" width="20"/> 
                            </a>
                            <a href="https://www.tiktok.com/@lucasasinmobiliario?lang=es" target="blank" class="text-white">
                                <img src="{{ url('/img/tktk.png') }}" width="20"/> 
                            </a>
                            <a href="https://wa.me/59172204144?text=Hola%20Lucasas!" target="blank" class="text-white">
                                <img src="{{ url('/img/whts.png') }}" width="20"/> 
                            </a>
	        </div>
          <div class="footers-info mt-3">
    		        <p class="text-white" style="font-size: 14px;"> Todos los derechos reservados <i class="fa fa-copyright"></i> 2021 </p>
    		    </div>
    		</div>
    	   <div class="col-xs-12 col-sm-6 col-md-2 logo-part">
    		    <h5 class="tile-heading">Atencion al cliente </h5>
    		    <ul class="list-unstyled ">
    			 <li><a href="{{ url('centro-de-ayuda') }}">Centro de ayuda</a></li>
    			 <li><a href="{{ url('como-comprar') }}">¿Cómo publicar?</a></li>
    			 
    			</ul>
    		</div>
    	   <div class="col-xs-12 col-sm-6 col-md-2 logo-part">
    		    <h5 class="tile-heading">Legal </h5>
    		    <ul class="list-unstyled">
    			 <li><a href="{{ url('terminosdeuso') }}">Términos y condiciones</a></li>
    			 <li><a href="{{ url('politicadeprivacidad') }}">Política de privacidad</a></li>
    	
    			</ul>
    		</div>
    	   <div class="col-xs-12 col-sm-6 col-md-2 logo-part">
    		    <h5 class="tile-heading">Servicios</h5>
    		    <ul class="list-unstyled blanco">
    			 <li><a href="{{ url('video-profesional') }}">Video Profesional</a></li>
    			 <li><a href="{{ url('fotos-profesionales') }}">Fotos Profesionales</a></li>
    			 <li><a href="{{ url('recorrido-360') }}">Recorrido 360°</a></li>
    			 <li><a href="{{ url('agente-inmobiliario') }}">Agente Inmobiliario</a></li>
    			 <li><a href="{{ url('arma_tu_plan') }}">Vende tu casa</a></li>
    			</ul>
    		</div>
    	   <div class="col-xs-12 col-sm-6 col-md-3 ">
    		    <h5 class="tile-heading">Contáctate con Nosotros </h5>
    		    <ul class="list-unstyled">
    			 <li><a href="https://wa.me/59172204144?text=Hola%20Lucasas!" target="blank">Llámanos +591 72204144</a></li>
                 <li><a href="{{ url('contacto') }}">Mándanos un mensaje</a></li>
    			 <li><a href="{{ url('acerca-de-nosotros') }}">Acerca de nosotros</a></li>
    			 <li><p>Escríbenos: <a href="mailto:info@lucasas.com?subject=Requiero%20m%C3%A1s%20informaci%C3%B3n" target="blank">info@lucasas.com</a></p></li>
                
    			</ul>
    		</div>
    		
       </div>
        <!--Grid row-->
      </section>
      <!-- Section: Links -->

   
      <!-- Section: CTA -->

      <hr class="mb-4" />

     
      <!-- Section: Social media -->
    </div>
    <!-- Grid container -->

   
    </section>
    

    @if($errors->has('mensaje'))
    <!-- MODAL PARA LOS MENSAJES -->
        @component('layouts.mensajeModal')
            @slot('mensajeModal', $errors->first('mensaje'))
        @endcomponent
    @endif
    

    <script type="text/javascript" src="{{ asset('/js/jquery.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.bundle.min.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('/js/popper.min.js') }}" ></script>

    @guest
    <script type="text/javascript">
        $('#loginLink').click(function(){
            $('#register-title').removeClass('active');
            $('#register-content').removeClass('active');

            $('#login-title').addClass('active');
            $('#login-content').addClass('active');
        });
        $('#registerLink').click(function(){
            $('#register-title').addClass('active');
            $('#register-content').addClass('active');

            $('#login-title').removeClass('active');
            $('#login-content').removeClass('active');  
        });
    </script>
    
    <script type="text/javascript" src="{{ asset('/js/ddslick.min.js') }}" ></script>
    <script type="text/javascript">
        $('#banderas_select').ddslick({
            width: 85,
        });
        $('#banderas_select').ddslick('select', {index: 1 });
    </script>
    @endguest

    @yield('js')

    @if($errors->has('mensaje'))
    <script type="text/javascript">
        $('#ModalMensaje').modal('show');
    </script>
    @endif
    <script type="text/javascript" src="{{ asset('/js/app.js') }}"></script>


</body>
</html>
