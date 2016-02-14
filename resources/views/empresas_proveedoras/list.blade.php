@extends('base-admin')

@section('js')
    <script src="{{ asset('/js/controllers/empresa_proveedora.js') }}"></script>
@endsection

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="ProveedorController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')

    @include('alerts.mensaje_error')
    @include('alerts.mensaje_success')

    @include('modals/eliminar')

    <div ng-init="empresaproveedoras={{$empresas_proveedoras}}"></div>
	<div ng-init="url='{{url()}}'"></div>
	
	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/empresas_proveedoras/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Agregar Empresas Proveedoras">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>

        <h1 class="page-header">Empresas Proveedoras </h1>

        <div class="row">
            <div class="col-12">
                <div class="panel-group" id="accordion">
                	<div class="row text-list">
                		<div class="col-sm-5"> 
                			<div class="row">
                				<div class="col-sm-3">N° </div>
                				<div class="col-sm-9">
                        			Nombre Proveedor
                        		</div>
                			</div>
                		</div>
                		<div class="col-sm-3">
							Telefono
                		</div>
                	</div>

                	<br>
                    
                    <div class="panel panel-inverse overflow-hidden custon-list" ng-repeat="proveedora in empresaproveedoras| filter:opciones.buscador | orderBy:sort:reverse  track by $index">
                        <div class="panel-heading">
                            <h3 class="panel-title list-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#[[$index+1]]">
                                    <i class="fa fa-plus pull-right"></i> 
                                </a>	
                            </h3>
                            <div class="box-button-list">
		        				<a class="btn btn-list" ng-href="{{ url( '/empresas_proveedoras/[[proveedora.id_empresa_proveedora]]/edit' ) }}" data-toggle="tooltip" data-title="Detalle"><i class="fa fa-pencil-square-o"></i></a>
		        			</div>
                            <h3 class="panel-title list-title">
                            	<div class="row">
                            		<div class="col-sm-5"> 
                            			<div class="row">
                            				<div class="col-sm-3"> [[$index+1]] </div>
                            				<div class="col-sm-9">
		                            			[[proveedora.nombres_empresa_proveedora]]
		                            		</div>
                            			</div>
                            		</div>

                            		<div class="col-sm-3">
										[[proveedora.telefono_empresa_proveedora]]
                            		</div>
                            	</div>                           	 
                            </h3>
                        </div>
                        <div id="[[$index+1]]" class="panel-collapse collapse">
                            <div class="panel-body">
                            	<p>Fecha Creación: [[proveedora.fecha_creacion_empresa_proveedora]]</p>
                            	<div ng-init="eliminar_url='/empresas_proveedoras/'+[[proveedora.id_empresa_proveedora]]+'/destroy'"></div>
                            	<a class="btn btn-list pull-right" ng-click="eliminar(eliminar_url)" href="#eliminar"  data-toggle="modal"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div><!-- content -->
	
</div>
@endsection
