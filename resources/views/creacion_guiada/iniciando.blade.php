@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-header-fixed">
	
	@include('layouts/navbar-admin')

	@include('alerts.mensaje_success')
	@include('alerts.mensaje_error')

	<div id="content" class="content content-asistente ng-scope">
		<section id="slider"><!--slider-->
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div id="slider-carousel" class="carousel slide" data-ride="carousel">
							<ol class="carousel-indicators">
								<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
								<li data-target="#slider-carousel" data-slide-to="1"></li>
								<li data-target="#slider-carousel" data-slide-to="2"></li>
								<li data-target="#slider-carousel" data-slide-to="3"></li>
								<li data-target="#slider-carousel" data-slide-to="4"></li>
							</ol>
							
							<div class="carousel-inner">
								<div class="item active">
									<div class="col-sm-6">
										<h1><span>Key</span>Gestión</h1>
										<h2>Bienvenida</h2>
										<p>Este asistente te guiará en el proceso de creación de los  proyectos de tu empresa y conocerás lo sencillo de gestionar tus proyectos.<p>
									</div>
									<div class="col-sm-6">
										<img src="{{ asset('img/creacion-guiada/laptop-inicio-01.png') }}" class="girl img-responsive" alt="" />
										<!--<img src="{{ asset('/cart/Eshopper/images/home/pricing.png') }}"  class="pricing" alt="" />-->
									</div>
								</div>
								<div class="item">
									<div class="col-sm-6">
										<h1>Clientes</h1>
										<p>Comenzará por crear los clientes que estén relacionados a algún  proyecto de tu empresa con todos sus datos de contacto.</p>
									</div>
									<div class="col-sm-6">
										<img src="{{ asset('img/creacion-guiada/cliente-01.png') }}" class="girl img-responsive" alt="" />
										<!--<img src="{{ asset('/cart/Eshopper/images/home/pricing.png') }}"  class="pricing" alt="" />-->
									</div>
								</div>
								
								<div class="item">
									<div class="col-sm-6">
										<h1>Tipos de Proyectos</h1>
										<p>Agregue las diferentes etapas del proceso que defina un  proyecto, de esta manera su equipo de trabajo trabajará en conjunto para una  determinada meta.</p>
									</div>
									<div class="col-sm-6">
										<img src="{{ asset('img/creacion-guiada/tipo-de-proyecto-01.png') }}" class="girl img-responsive" alt="" />
										<!--<img src="{{ asset('/cart/Eshopper/images/home/pricing.png') }}" class="pricing" alt="" />-->
									</div>
								</div>

								<div class="item">
									<div class="col-sm-6">
										<h1>Usuarios del Sistema</h1>
										<p>Administre los permisos de los integrantes de su equipo de  trabajo, de esta manera logrará conocer los responsables de cada área.</p>
									</div>
									<div class="col-sm-6">
										<img src="{{ asset('img/creacion-guiada/usuarios-01.png') }}" class="girl img-responsive" alt="" />
										<!--<img src="{{ asset('/cart/Eshopper/images/home/pricing.png') }}" class="pricing" alt="" />-->
									</div>
								</div>

								<div class="item">
									<div class="col-sm-6">
										<h1>Roles del Sistema</h1>
										<p>Podrá definir los roles que ejecutarán los integrantes de su  equipo de trabajo en algún proyecto determinado.</p>
									</div>
									<div class="col-sm-6">
										<img src="{{ asset('img/creacion-guiada/roles-01.png') }}" class="girl img-responsive" alt="" />
										<!--<img src="{{ asset('/cart/Eshopper/images/home/pricing.png') }}" class="pricing" alt="" />-->
									</div>
								</div>
								
							</div>
						</div>		
					</div>
				</div>
			</div>
		</section><!--/slider-->
	</div>

	<!-- Navbar fixed bottom -->
	<div class="navbar navbar-default navbar-fixed-bottom" role="navigation">
	  	<div class="container">
	    	<div class="navbar-header">
	      		<a class="navbar-brand" href="#">Creación guiada</a>
	    	</div>
	    	<div class="navbar-collapse collapse">
	      		<!-- Right nav -->
	      		<ul class="nav-siguiente navbar-right">
	        		<li><a href="{{ url('asistente/paso1/list') }}" class="btn btn-success m-r-5 m-b-5">Iniciar</a></li>
	      		</ul>
	      		<ul class="nav-siguiente navbar-right">
                    <li><a href="{{ url('mis-proyectos') }}" class="btn btn-danger m-r-5 m-b-5">Cerrar</a></li>
                </ul>
	    	</div><!--/.nav-collapse -->
	  	</div><!--/.container -->
	</div>

</div>