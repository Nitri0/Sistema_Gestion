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
                    <br><big>Gestionlist</big>
                    <small align="center"> Organiza tus ideas...</small>
                </div>
                <!--<div class="icon">
                    <i class="fa fa-key"></i>
                </div>-->
            </div>
            <!-- end login-header -->
            <!-- begin login-content -->
            <div class="login-content">
					
				@include('alerts.mensaje_success-login')
				@include('alerts.mensaje_error-login')

				<form class="form-horizontal" role="form" method="POST" action="{{ url('/recuperar-contraseña') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					
					<br>

					<div class="form-group m-b-15">
						<input type="email" class="form-control input-lg" name="correo" value="{{ old('email') }}" placeholder="Correo Electronico">
					</div>
					
					<br>

					<div class="login-buttons">
						<button type="submit" class="btn btn-success btn-block btn-lg">
							Enviar Contraseña
						</button>
					</div>
					<hr>
                    <div class="m-t-20 m-b-40 p-b-40">
                        ¿La Recordaste? Click <a href="{{ url('/login') }}">Aquí</a> para Ingresar..
                    </div>

				</form>
				
			</div>
            <!-- end login-content -->
        </div>
        <!-- end right-container -->
    </div>

</div>

@endsection