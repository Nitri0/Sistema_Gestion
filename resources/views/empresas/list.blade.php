@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/admin_empresas/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Agregar Empresas">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>
        
		@include('alerts.mensaje_success')
		@include('alerts.mensaje_error')
		<div ng-init="models={{$empresas}}"></div>

        <h1 class="page-header">Lista de Empresas </h1>

        <div class="row">
            <div class="col-12">
                <div class="panel-group" id="accordion">
                	<div class="row text-list">
                		<div class="col-sm-4"> 
                			<div class="row">
                				<div class="col-sm-3"><a href="#" ng-click="changeSort('index')"># </a></div>
                				<div class="col-sm-9">
                        			<a href="#" ng-click="changeSort('nombre_empresa')">Nombre Empresa</a>
                        		</div>
                			</div>
                		</div>
                		<div class="col-sm-3">
							<a href="#" ng-click="changeSort('rif_empresa')">Rif </a>
                		</div>
                		<div class="col-sm-3">
                			<a href="#" ng-click="changeSort('email_empresa')">Email</a>
                		</div>
                        <div class="col-sm-2">
                            <a>Estatus</a>
                        </div>
                	</div>

                	<br>
                    
                    <div class="panel panel-inverse overflow-hidden custon-list" ng-repeat="model in models| filter:opciones.buscador | orderBy:sort:reverse  track by $index">
                        <div class="panel-heading">
                            <h3 class="panel-title list-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#[[$index+1]]">
                                    <i class="fa fa-plus pull-right"></i> 
                                </a>	
                            </h3>
                            <div class="box-button-list">
		        				<!--<a class="btn btn-sm btn-info btn-cirule" ng-href="{{ url( '/admin_empresas/[[model.id_empresa]]' ) }}" data-toggle="tooltip" data-title="Detalle"><i class="fa fa-list"></i></a>-->
		        				<a class="btn btn-sm btn-success btn-cirule" ng-href="{{ url( '/admin_empresas/[[model.id_empresa]]/edit' ) }}" data-toggle="tooltip" data-title="Editar"><i class="fa fa-pencil-square-o"></i></a>
		        			</div>
                            <h3 class="panel-title list-title">
                            	<div class="row">
                            		<div class="col-sm-4"> 
                            			<div class="row">
                            				<div class="col-sm-3"> [[$index+1]] </div>
                            				<div class="col-sm-9">
		                            			[[model.nombre_empresa]]
		                            		</div>
                            			</div>
                            		</div>

                            		<div class="col-sm-3">
										[[model.rif_empresa]]
                            		</div>

                            		<div class="col-sm-3">
										[[model.correo_empresa]]
                            		</div>
                                    
                                    <div class="col-sm-1">
                                        <div class="icon-usuario-habilitado center" ng-if="model.habilitado_empresa == 1">
                                            <i class="fa fa-check-circle"></i>
                                        </div>
                                        <div class="icon-usuario-desabilitado center" ng-if="model.habilitado_empresa == 0">
                                            <i class="fa fa-times"></i>
                                        </div>
                                    </div>

                            	</div>                           	 
                            </h3>
                        </div>
                        <div id="[[$index+1]]" class="panel-collapse collapse">
                            <div class="panel-body">
                            	<p>Dirección: [[model.direccion_empresa]]</p>
                            	<p>Telefono [[model.telefono_empresa]]</p>
                            	<p>Fecha de Creación: [[model.created_at]]</p>
                            	
                            	<a ng-if="model.habilitado_empresa == 0" class="btn btn-sm btn-success pull-right" ng-href="{{ url( '/admin_empresas/[[model.id_empresa]]/habilitar') }}" data-toggle="tooltip" data-title="Habilitar"><i class="fa fa-thumbs-o-up"></i></i></a>
						        <a ng-if="model.habilitado_empresa == 1" class="btn btn-sm btn-danger pull-right" ng-href="{{ url( '/admin_empresas/[[model.id_empresa]]/destroy') }}" data-toggle="tooltip" data-title="Deshabilitar"><i class="fa fa-thumbs-o-down"></i></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div><!-- content -->
	
</div>
@endsection
