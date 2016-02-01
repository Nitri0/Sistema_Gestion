@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	
	@include('layouts/navbar-admin')

	@include('alerts.mensaje_success')
	@include('alerts.mensaje_error')

    <div ng-init="usuarios={{$usuarios}}"></div>
    <div ng-init="url='{{url()}}'"></div>

	<div id="content" class="content content-asistente ng-scope">

		<ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group list-none-click" ng-show="!usuarios">
                    <h4>Haga click aqui para registrar <i class="fa fa-arrow-right"></i></h4>
                </div>
                <div class="btn-group">
                    <a href="{{ url( 'asistente/paso3/create' ) }}" class="btn btn-success" data-toggle="tooltip" data-title="Crear Tipo Proyecto">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>
        
        <section id="do_action" ng-show="!usuarios">
            <div class="container center">
                <div class="row">
                    <div class="col-md-12 list-none">
                        <i class="fa fa-ban"></i>
                        <h1> No tiene Usuarios registrados.</h1>
                    </div>
                </div>
            </div>
        </section>

        <h1 class="page-header" ng-show="usuarios">Lista de Usuarios </h1>

        <div class="row" ng-show="usuarios">
            <div class="col-12">
                <div class="panel-group" id="accordion">
                    <div class="row text-list">
                        <div class="col-sm-3"> 
                            <div class="row">
                                <div class="col-sm-3"># </div>
                                <div class="col-sm-9">
                                    Correo Usuario
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 center">
                            Estatus
                        </div>
                    </div>

                    <br>
                    
                    <div class="panel panel-inverse overflow-hidden custon-list" ng-repeat="usuario in usuarios| filter:opciones.buscador | orderBy:sort:reverse  track by $index">
                        <div class="panel-heading">
                            <!--<h3 class="panel-title list-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#[[$index+1]]">
                                    <i class="fa fa-plus pull-right"></i> 
                                </a>    
                            </h3>-->
                            <div class="box-button-list">
                                <!--<a class="btn btn-sm btn-info btn-cirule" ng-href="{{ url( '/admin_usuarios/[[usuario.id_usuario]]/edit' ) }}" data-toggle="tooltip" data-title="Editar"><i class="fa fa-pencil-square-o"></i></a>-->
                            	<a ng-if="usuario.habilitado_usuario == 1" class="btn btn-list" ng-href="{{ url( '/admin_usuarios/[[usuario.id_usuario]]/destroy' ) }}" data-toggle="tooltip" data-title="Deshabilitar"><i class="fa fa-thumbs-o-down"></i></a>
                            	<a ng-if="usuario.habilitado_usuario == 0" class="btn btn-list" ng-href="{{ url( '/admin_usuarios/[[usuario.id_usuario]]/habilitar' ) }}" data-toggle="tooltip" data-title="Habilitar"><i class="fa fa-thumbs-o-up"></i></a>
                            </div>
                            <h3 class="panel-title list-title">
                                <div class="row">
                                    <div class="col-sm-3"> 
                                        <div class="row">
                                            <div class="col-sm-3"> [[$index+1]] </div>
                                            <div class="col-sm-9">
                                                [[usuario.correo_usuario]]
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="icon-usuario-habilitado center" ng-if="usuario.habilitado_usuario == 1">
                                            <i class="fa fa-check-circle"></i>
                                        </div>
                                        <div class="icon-usuario-desabilitado center" ng-if="usuario.habilitado_usuario == 0">
                                            <i class="fa fa-times"></i>
                                        </div>
                                    </div>

                                </div>                               
                            </h3>
                        </div>
                        <div id="[[$index+1]]" class="panel-collapse collapse">
                            <div class="panel-body">
                                [[usuario]]
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <br><br>

        </div>

	</div>

	<!-- Navbar fixed bottom -->
	<div class="navbar navbar-default navbar-fixed-bottom" role="navigation">
	  	<div class="container">
	    	<div class="navbar-header">
	      		<a class="navbar-brand" href="#">Paso 3 Usuarios</a>
	    	</div>
	    	<div class="navbar-collapse">
	      		<!-- Right nav -->
	      		<ul class="nav-siguiente navbar-right">
	        		<li><a href="{{ url('asistente/paso4/list') }}" class="btn btn-success m-r-5 m-b-5" ng-disabled="!usuarios">Siguiente</a></li>
	      		</ul>
	      		<ul class="nav-siguiente navbar-right">
	        		<li><a href="{{ url('asistente/paso2/list') }}" class="btn btn-success m-r-5 m-b-5">Atras</a></li>
	      		</ul>
	    	</div><!--/.nav-collapse -->
	  	</div><!--/.container -->
	</div>

</div>