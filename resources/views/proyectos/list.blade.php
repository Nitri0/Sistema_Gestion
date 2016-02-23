@extends('base-admin')

@section('js')
    <script src="{{ asset('/js/controllers/proyecto.js') }}"></script>
@endsection

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="ProyectoController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')

    @include('alerts.mensaje_success')
	@include('alerts.mensaje_error')
	
	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/proyectos/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Agregar Proyecto">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>
        
        <h1 class="page-header">Todos los proyectos </h1>

		<div ng-init="proyectos={{$proyectos}}"></div>

        <div class="row">
            <div class="col-12">
                <div class="panel-group" id="accordion">
                	<div class="row text-list">
                		<div class="col-sm-3"> 
                			<div class="row">
                				<div class="col-sm-3"><a href="#" ng-click="changeSort('index')">N°</a> </div>
                				<div class="col-sm-9">
                        			<a href="#" ng-click="changeSort('nombre_proyecto')">Proyecto</a>
                        		</div>
                			</div>
                		</div>
                        <div class="col-sm-3">
                            <a href="#" ng-click="changeSort('nombre_cliente')">Clientes</a>
                        </div>
                        <div class="col-sm-3">
							<a href="#" ng-click="changeSort('nombre_etapa')">Estatus</a>
                		</div>
                		<div class="col-sm-3">
							<a href="#" ng-click="changeSort('fecha_creacion_avance')">Ultimo avance</a>
                		</div>
                	</div>

                	<br>
                    
                    <div class="panel panel-inverse overflow-hidden custon-list" ng-repeat="proyecto in proyectos | filter:opciones.buscador | orderBy:sort:reverse  track by $index">
                        <div class="panel-heading">
                            <h3 class="panel-title list-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#[[$index+1]]">
                                    <i class="fa fa-plus pull-right"></i> 
                                </a>	
                            </h3>
                            <div class="box-button-list">
		        				<a class="btn btn-list" ng-href="{{ url( '/proyectos/[[proyecto.id_proyecto]]' ) }}" data-toggle="tooltip" data-title="Detalle"><i class="fa fa-list"></i></a>
		        			</div>
                            <h3 class="panel-title list-title">
                            	<div class="row">
                            		<div class="col-sm-3"> 
                            			<div class="row">
                            				<div class="col-sm-3"> [[$index+1]] </div>
                            				<div class="col-sm-9">
		                            			[[proyecto.nombre_proyecto]]
		                            		</div>
                            			</div>
                            		</div>

                                    <div class="col-sm-3" ng-if="!proyecto.proyecto_interno">
                                        [[proyecto.nombre_cliente]]
                                    </div> 
                                    <div class="col-sm-3" ng-if="proyecto.proyecto_interno && proyecto.nombre_lider_proyecto">
										[[proyecto.nombre_lider_proyecto]]
                            		</div>
                                    <div class="col-sm-3" ng-if="proyecto.proyecto_interno && !proyecto.nombre_lider_proyecto">
                                        [[proyecto.correo_usuario]]
                                    </div>                                    

                                    <div class="col-sm-3">
                                        [[proyecto.nombre_etapa]]
                                    </div>

                            		<div class="col-sm-1 center">
										[[proyecto.fecha_creacion_avance | DateForHumans]]
                            		</div>

                            	</div>                           	 
                            </h3>
                        </div>
                        <div id="[[$index+1]]" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p ng-if="!proyecto.proyecto_interno">Nombre del Cliente: [[proyecto.nombre_cliente]]</p>
                                <p ng-if="proyecto.proyecto_interno && proyecto.nombre_lider_proyecto">Lider de proyecto: [[proyecto.nombre_lider_proyecto]]</p>
                            	<p ng-if="proyecto.proyecto_interno && !proyecto.nombre_lider_proyecto">Lider de proyecto: [[proyecto.correo_usuario]]</p>
                                <p ng-if="proyecto.proyecto_interno" class="btn-info">Proyecto Interno</p>
                            	<p ng-show="proyecto.nombre_dominio" >Dominio: <a ng-href="[[proyecto.nombre_dominio]]" target="_blank"> [[proyecto.nombre_dominio]] </a> </p>
                                <p>Tipo de Proyecto: [[proyecto.nombre_grupo_etapas]]</p>
                                <div ng-if="proyecto.asunto_avance != null">
                                    <hr>
                                    <p class="center">Ultimo Avance</p>
                                    <div class="row">
                                        <!-- begin col-12 -->
                                        <div class="col-12 ui-sortable">
                                            <!-- begin panel -->
                                            <div class="panel panel-inverse panel-ultimo-avance">
                                                <div class="panel-heading-3">
                                                    <div class="panel-heading-btn">
                                                        <p class="fecha-ultimo-avance">[[proyecto.fecha_creacion_avance | DateForHumans]]</p>
                                                    </div>
                                                    <h4 class="panel-title"><img width="40" alt="" src="{{ url('img/user.png') }}"> [[proyecto.nombre_usuario]]</h4>
                                                </div>
                                                <div class="panel-body">
                                                    <div ng-bind-html="proyecto.descripcion_avance"></div> 
                                                </div>
                                                <div class="panel-heading-3">
                                                    <h4 class="panel-title">Asunto: [[proyecto.asunto_avance]]</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div><!-- content -->
	
</div>
@endsection
