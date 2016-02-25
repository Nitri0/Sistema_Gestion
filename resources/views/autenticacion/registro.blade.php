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
        	<br>
            <!-- begin login-header -->
            
                <div class="brand" align="center">
                    
                    <big>Gesti <img src="{{ asset('/img/logo.png') }}" width="30"> nlist</big>	
                </div>
            
            <!-- end login-header -->
            <!-- begin login-content -->
            <div class="login-content">
					
				@include('alerts.mensaje_success-login')
				@include('alerts.mensaje_error-login')

				<form class="form-horizontal" role="form" method="POST" action="{{ url('/registrar') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group m-b-15">
						<input type="text" class="form-control input-lg" name="nombre" placeholder="Nombres">
					</div>

					<div class="form-group m-b-15">
						<input type="text" class="form-control input-lg" name="apellido" placeholder="Apellidos">
					</div>

					<div class="form-group m-b-15">
						<input type="text" class="form-control input-lg" name="empresa" placeholder="Nombre de empresa">
					</div>

					<div class="form-group m-b-15">
						<input type="email" class="form-control input-lg" name="correo_usuario" placeholder="Correo Electrónico">
					</div>

					<div class="form-group m-b-15">
						<input type="password" class="form-control input-lg" name="password" placeholder="Contraseña">
					</div>
					<div class="form-group m-b-15">
						<input type="password" class="form-control input-lg" name="re_password" placeholder="Repetir Contraseña">
					</div>						
			
			 		<div class="register-buttons">
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Registrar</button>
                    </div>
					<hr>
					<div class="m-t-20 m-b-40 p-b-40">
                           	¿Ya eres miembro? Click <a href="{{ url('/login') }}">Aquí</a> para Ingresar..
                        </div>
                    <!--<p class="text-center text-inverse">
                        © Copyright Key Systems C.A 2015
                    </p>-->
				</form>
				
			</div>
            <!-- end login-content -->
        </div>
        <!-- end right-container -->
    </div>

</div>

@endsection