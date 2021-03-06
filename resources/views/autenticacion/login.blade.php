@extends('base-cliente')

@section('css')
	<link href="{{ asset('/css/login/style.css') }}" rel="stylesheet">
    
@endsection

@section('content')
<div id="page-container" class="fade">

	<div class="login login-with-news-feed">
        <!-- begin news-feed -->
        <div class="news-feed">
            <div class="news-image">
            	<ul class="cb-slideshow ul-login">
			        <li class="li-login"><span></span></li>
			        <li class="li-login"><span></span></li>
			        <li class="li-login"><span></span></li>
			        <li class="li-login"><span></span></li>
			        <li class="li-login"><span></span></li>
			        <li class="li-login"><span></span></li>
			    </ul>
                <!--<img src="{{ asset('/img/bg-7.jpg') }}" data-id="login-cover-image" alt="">-->
            </div>
            <div class="news-caption" align="center">
                <h4 class="caption-title"> Gesti <img class="login-icono" src="{{ asset('/img/logo.png') }}"> nlist</h4>
            </div>
        </div>
        <!-- end news-feed -->
        <!-- begin right-content -->
        <div class="right-content">
            <!-- begin login-header -->
            <div class="login-header">
                <div class="brand" align="center">
                    <img class="login-icono" src="{{ asset('/img/logo.png') }}">
                    <big>Gestionlist</big>
                    <small align="center"> Organiza tus ideas...</small>
                </div>
                <!--<div class="icon">
                    <i class="fa fa-key"></i>
                </div>-->
            </div>
            <!-- end login-header -->
            <!-- begin login-content -->
            <div class="login-content">
                <form role="form" method="POST" action="{{ url('/login') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					
					@include('alerts.mensaje_error-login')
					@include('alerts.mensaje_success-login')

                    <div class="form-group m-b-15">
                        <input type="email" class="form-control input-lg" name="correo_usuario" value="{{ old('correo_usuario') }}" placeholder="Correo Electrónico" >
                    </div>
                    <div class="form-group m-b-15">
                        <input type="password" class="form-control input-lg" name="clave_usuario" placeholder="Contraseña">
                    </div>
<!-- 	                    <div class="form-group">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="remember"> Recordar
							</label>
						</div>			
					</div> -->
                    
                    <div class="login-buttons" align="center">
                        <a class="btn btn-link btn-oldivar" href="{{ url('/recuperar-contraseña') }}">¿Olvidó su Contraseña?</a>   
                        <!--<button type="submit" class="btn btn-success btn-block btn-lg">Sign me in</button>-->
                        <button class="btn btn-primary btn-block btn-lg" type="submit">Iniciar Sesión </button>
                    </div>
                    <div class="m-t-40 m-b-40 p-b-40" align="center">
                       <h5> ¿No eres miembro todavía? <a href="{{ url('/registrar') }}" class="text-success">Haga clic aquí </a> para registrarse.</h5>
                    </div>
                    <hr>
                    <p class="text-center text-inverse">
                        © Copyright Key Systems C.A 2015
                    </p>

                </form>
            </div>
            <!-- end login-content -->
        </div>
        <!-- end right-container -->
    </div>
    

</div>
@endsection

