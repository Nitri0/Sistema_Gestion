@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	@include('alerts.mensaje_error')
	@include('alerts.mensaje_success')

	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/actividades/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Crear actividad">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>
        

        <h1 class="page-header">Lista de Actividades </h1>
        
        <div ng-init="actividades={{$actividades}}"></div>
        <div ng-init="url='{{url()}}'"></div>

		<div class="row">
            <div class="col-12">
                <div class="panel-group" id="accordion">
                	<div class="row text-list">
                		<div class="col-sm-5"> 
                			<div class="row">
                				<div class="col-sm-3"># </div>
                				<div class="col-sm-9">
                        			Nombre actividad
                        		</div>
                			</div>
                		</div>
                		<div class="col-sm-4">
							Fecha de creación
                		</div>
                	</div>

                	<br>
                    
                    <div class="panel panel-inverse overflow-hidden custon-list" ng-repeat="actividad in actividades | filter:opciones.buscador | orderBy:sort:reverse  track by $index">
                        <div class="panel-heading">
                            <h3 class="panel-title list-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#[[$index+1]]">
                                    <i class="fa fa-plus pull-right"></i> 
                                </a>	
                            </h3>
                            <div class="box-button-list">
		        				<a class="btn btn-sm btn-info btn-cirule" ng-href="{{ url( '/actividades/[[actividad.id_actividad]]/edit' ) }}" data-toggle="tooltip" data-title="Editar"><i class="fa fa-list"></i></a>
		        				<a class="btn btn-sm btn-white btn-cirule" target="_blank" ng-href="{{ url( '/actividades/preview/[[actividad.id_actividad]]' ) }}" data-toggle="tooltip" data-title="Preview"><i class="fa fa-eye"></i></a>
		        			</div>
                            <h3 class="panel-title list-title">
                            	<div class="row">
                            		<div class="col-sm-5"> 
                            			<div class="row">
                            				<div class="col-sm-3"> [[$index+1]] </div>
                            				<div class="col-sm-9">
		                            			[[actividad.nombre_actividad]]
		                            		</div>
                            			</div>
                            		</div>

                            		<div class="col-sm-4">
										[[actividad.fecha_creacion_actividad ]]
                            		</div>

                            	</div>                           	 
                            </h3>
                        </div>
                        <div id="[[$index+1]]" class="panel-collapse collapse">
                            <div class="panel-body">
                            	[[actividad.descripcion_actividad]]
                            	<a ng-href="{{ url( '/actividades/[[actividad.id_actividad]]/destroy' ) }}" class="btn btn-sm btn-danger pull-right" data-toggle="tooltip" data-title="Eliminar"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div><!-- content -->
	
</div>
@endsection