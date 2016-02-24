@extends('base-admin')

@section('js')
    <script src="{{ asset('/js/controllers/roles.js') }}"></script>
@endsection

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="RolesController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')

    @include('alerts.mensaje_success')
	@include('alerts.mensaje_error')

    @include('modals/eliminar')

	<div ng-init="models={{$roles}}"></div>
	<div ng-init="url='{{url()}}'"></div>
	
	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/roles/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Agregar Dominio">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>

        <h1 class="page-header">Lista de Roles</h1>
        
        <div class="row">
            <div class="col-12">
                <div class="panel-group" id="accordion">
                	<div class="row text-list">
                		<div class="col-sm-5"> 
                			<div class="row">
                				<div class="col-sm-2" align="center">N° </div>
                				<div class="col-sm-10">
                        			Nombre
                        		</div>
                			</div>
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
		        				<a class="btn btn-list" ng-href="{{ url( '/roles/[[model.id_tipo_rol]]/edit' ) }}" data-toggle="tooltip" data-title="Editar"><i class="fa  fa-pencil-square-o"></i></a>
		        				<!--<a class="btn btn-sm btn-inverse" ng-href="{{ url( '/roles/[[model.id_tipo_rol]]') }}" data-toggle="tooltip" data-title="Gestionar"><i class="fa fa-cogs"></i></a>-->
		        			</div>
                            <h3 class="panel-title list-title">
                            	<div class="row">
                            		<div class="col-sm-5"> 
                            			<div class="row">
                            				<div class="col-sm-2"> [[$index+1]] </div>
                            				<div class="col-sm-10">
		                            			[[model.nombre_tipo_rol]]
		                            		</div>
                            			</div>
                            		</div>
                            	</div>                           	 
                            </h3>
                        </div>
                        <div id="[[$index+1]]" class="panel-collapse collapse">
                            <div class="panel-body">
                            	<p>Descripción: [[model.descripcion_tipo_rol]]</p>
                                <div ng-init="eliminar_url='/roles/'+[[model.id_tipo_rol]]+'/destroy'"></div>
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