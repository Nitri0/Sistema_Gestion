@extends('base-admin')

@section('js')
    <script src="{{ asset('/js/controllers/grupo_etapas.js') }}"></script>
@endsection

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="GrupoEtapasController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')

    @include('alerts.mensaje_error')
    @include('alerts.mensaje_success')

    @include('modals/eliminar')
	
	<div id="content" class="content ng-scope">
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/tipo_proyectos/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Agregar">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>

        <h1 class="page-header">Lista de tipos de proyectos</h1>
        
		<div ng-init="grupoetapas={{$grupo_etapas}}"></div>
		<div ng-init="url='{{url()}}'"></div>

        <div class="row">
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
                            <h3 class="panel-title list-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#[[$index+1]]">
                                    <i class="fa fa-plus pull-right"></i> 
                                </a>	
                            </h3>
                            <div class="box-button-list">
		        				<a class="btn btn-list" ng-href="{{ url( '/tipo_proyectos/[[etapa.id_grupo_etapas]]' ) }}" data-toggle="tooltip" data-title="Detalle"><i class="fa fa-list"></i></a>
		        			</div>
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
                            	<div ng-init="eliminar_url='/tipo_proyectos/'+[[etapa.id_grupo_etapas]]+'/destroy'"></div>
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