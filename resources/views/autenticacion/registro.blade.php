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
             <div class="news-caption">
                <h4 class="caption-title"> <img class="login-icono" src="{{ asset('/img/ks-logo.png') }}">  Key Systems </h4>
                <p>
                    Refleja tus ideas.
                </p>
            </div>
        </div>
        <!-- end news-feed -->
        <!-- begin right-content -->
        <div class="right-content">
            <!-- begin login-header -->
            <div class="login-header">
              	<div class="brand">
                    <img class="login-icono" src="{{ asset('/img/logo.png') }}"> Sistema de Gestión
                    <small> Organiza tus ideas...</small>
                </div>
                <div class="icon">
                    <i class="fa fa-pencil-square-o"></i>
                </div>
            </div>
            <!-- end login-header -->
            <!-- begin login-content -->
            <div class="login-content">
					
				@include('alerts.mensaje_success-login')
				@include('alerts.mensaje_error-login')

				<form class="form-horizontal" role="form" method="POST" action="{{ url('/registrar') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="form-group m-b-15">
						<input type="text" class="form-control" name="empresa" value="{{ old('email') }}" placeholder="Nombre de empresa">
					</div>

					<div class="form-group m-b-15">
						<input type="text" class="form-control" name="identificador" value="{{ old('email') }}" placeholder="Identificador de empresa (ejemplo: RIF, ID, ect)">
					</div>

					<div class="form-group m-b-15">
						<input type="email" class="form-control" name="correo_usuario" value="{{ old('email') }}" placeholder="Correo Electrónico">
					</div>

					<div class="form-group m-b-15">
						<input type="password" class="form-control" name="password" placeholder="Contraseña">
					</div>
					<div class="form-group m-b-15">
						<input type="password" class="form-control" name="re_password" placeholder="Repetir Contraseña">
					</div>						
			
					<br>

					<div class="login-buttons">
						<button type="submit" class="btn btn-danger btn-block btn-lg">
							Registrar
						</button>
					</div>

					<hr>
                    <p class="text-center text-inverse">
                        © Copyright Key Systems C.A 2015
                    </p>

                    <p class="text-center text-inverse">
                       <a href="{{ url('/login') }}">Iniciar Sesión</a>
                    </p>

				</form>
				
			</div>
            <!-- end login-content -->
        </div>
        <!-- end right-container -->
    </div>

</div>

@endsection