@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-header-fixed">
	
	@include('layouts/navbar-admin')

	@include('alerts.mensaje_success')
	@include('alerts.mensaje_error')
    
    <div ng-init="grupoetapas={{$tipo_proyectos}}"></div>
    <div ng-init="url='{{url()}}'"></div>

	<div id="content" class="content content-asistente ng-scope">
		
		<ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group list-none-click" ng-show="!grupoetapas">
                    <h4>Haga click aqui para registrar <i class="fa fa-arrow-right"></i></h4>
                </div>
                <div class="btn-group">
                    <a href="{{ url( 'asistente/paso2/create' ) }}" class="btn btn-success" data-toggle="tooltip" data-title="Crear Tipo Proyecto">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>

        <section id="do_action" ng-show="!grupoetapas">
            <div class="container center">
                <div class="row">
                    <div class="col-md-12 list-none">
                        <i class="fa fa-ban"></i>
                        <h1> No tiene Tipo de Proyectos registrados.</h1>
                    </div>
                </div>
            </div>
        </section>

		<h1 class="page-header" ng-show="grupoetapas">Lista de Tipo de Proyecto </h1>

        <div class="row" ng-show="grupoetapas">
            <div class="col-12">
                <div class="panel-group" id="accordion">
                	<div class="row text-list">
                		<div class="col-sm-4"> 
                			<div class="row">
                				<div class="col-sm-2">N° </div>
                				<div class="col-sm-10">
                        			Identificador de proyecto
                        		</div>
                			</div>
                		</div>
                		<div class="col-sm-3">
							Cantidad de etapas
                		</div>
                	</div>

                	<br>
                    
                    <div class="panel panel-inverse overflow-hidden custon-list" ng-repeat="etapa in grupoetapas| filter:opciones.buscador | orderBy:sort:reverse  track by $index">
                        <div class="panel-heading">
                            <!--<h3 class="panel-title list-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#[[$index+1]]">
                                    <i class="fa fa-plus pull-right"></i> 
                                </a>	
                            </h3>-->
                            <!--<div class="box-button-list">
		        				<a class="btn btn-list" ng-href="{{ url( '/tipo_proyectos/[[etapa.id_grupo_etapas]]' ) }}" data-toggle="tooltip" data-title="Detalle"><i class="fa fa-list"></i></a>
		        			</div>-->
                            <h3 class="panel-title list-title">
                            	<div class="row">
                            		<div class="col-sm-4"> 
                            			<div class="row">
                            				<div class="col-sm-2"> [[$index+1]] </div>
                            				<div class="col-sm-10">
		                            			[[etapa.nombre_grupo_etapas]]
		                            		</div>
                            			</div>
                            		</div>

                            		<div class="col-sm-2">
										<center>[[etapa.cantidad_etapas]]</center>
                            		</div>
                            	</div>                           	 
                            </h3>
                        </div>
                        <div id="[[$index+1]]" class="panel-collapse collapse">
                            <div class="panel-body">
                            	<p>Descripción: [[etapa.descripcion_grupo_etapas]]</p>
                            	
                            	<a class="btn btn-sm btn-danger pull-right" href="{{ url( '/tipo_proyectos/[[etapa.id_grupo_etapas]]/destroy' ) }}" data-toggle="tooltip" data-title="Eliminar"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <br><br>
            
        </div>

	</div><!-- content -->
	
	<!-- Navbar fixed bottom -->
	<div class="navbar navbar-default navbar-fixed-bottom" role="navigation">
	  	<div class="container">
	    	<div class="navbar-header">
	      		<a class="navbar-brand" href="#">Paso 2/5 Tipo Proyecto</a>
	    	</div>
	    	<div class="navbar-collapse collapse">
	      		<!-- Right nav -->
	      		<ul class="nav-siguiente navbar-right">
	        		<li><a href="{{ url('asistente/paso3/list') }}" class="btn btn-success m-r-5 m-b-5" ng-disabled="!grupoetapas">Siguiente</a></li>
	      		</ul>
                <ul class="nav-siguiente navbar-right">
                    <li><a href="{{ url('asistente/paso1/list') }}" class="btn btn-success m-r-5 m-b-5">Atras</a></li>
                </ul>
	    	</div><!--/.nav-collapse -->
	  	</div><!--/.container -->
	</div>

</div>
@endsection