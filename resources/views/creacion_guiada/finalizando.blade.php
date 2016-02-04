@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	
	@include('layouts/navbar-admin')

	@include('alerts.mensaje_success')
	@include('alerts.mensaje_error')

	<div id="content" class="content content-asistente ng-scope">
		<section id="slider"><!--slider-->
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div id="slider-carousel" class="carousel slide" data-ride="carousel">							
							<div class="carousel-inner">
								<div class="item active">
									<div class="col-sm-6">
										<h1><span>Proyecto</span> Creado</h1>
										<h2></h2>
										<p>El proyecto fue creado exitosamente puedo verlos en la <a href="{{ url('proyectos') }}">lista de proyecto.</a></p>
									</div>
									<div class="col-sm-6">
										<img src="{{ asset('img/creacion-guiada/poyecto-finalizado-01.png') }}" class="girl img-responsive" alt="" />
										<!--<img src="{{ asset('/cart/Eshopper/images/home/pricing.png') }}"  class="pricing" alt="" />-->
									</div>
								</div>
							</div>
						</div>		
					</div>
				</div>
			</div>
		</section>
	</div>

	<!-- Navbar fixed bottom -->
	<div class="navbar navbar-default navbar-fixed-bottom" role="navigation">
	  	<div class="container">
	    	<div class="navbar-header">
	      		<a class="navbar-brand" href="#">Finalizado</a>
	    	</div>
	    	<div class="navbar-collapse collapse">
	      		<!-- Right nav -->
	      		<ul class="nav-siguiente navbar-right">
	        		<li><a href="{{ url('proyectos') }}" class="btn btn-danger m-r-5 m-b-5">Cerrar</a></li>
	      		</ul>
	      		<!-- Right nav -->
	      		<ul class="nav-siguiente navbar-right">
	        		<li><a href="{{ url('asistente/paso1/list') }}" class="btn btn-success m-r-5 m-b-5">Crear proyecto</a></li>
	      		</ul>
	    	</div><!--/.nav-collapse -->
	  	</div><!--/.container -->
	</div>

</div>