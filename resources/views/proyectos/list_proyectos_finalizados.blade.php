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

        <h1 class="page-header">Poryectos Finalizados </h1>

        <div ng-init="proyectos = {{$proyectos}}"></div>
		<div ng-init="url='{{url()}}'"></div>
		
        <div class="row">
            <div class="col-12">
                <div class="panel-group" id="accordion">
                	<div class="row text-list">
                		<div class="col-sm-3"> 
                			<div class="row">
                				<div class="col-sm-3"><a href="#" ng-click="changeSort('index')">#</a> </div>
                				<div class="col-sm-9">
                        			<a href="#" ng-click="changeSort('nombre_proyecto')">Proyecto</a>
                        		</div>
                			</div>
                		</div>
                		<div class="col-sm-3">
							<a href="#" ng-click="changeSort('nombre_dominio')">Dominio</a>
                		</div>
                		<div class="col-sm-3">
							<a href="#" ng-click="changeSort('fecha_creacion_avance')">Ultimo avance</a>
                		</div>
                		<div class="col-sm-3">
							<a href="#" ng-click="changeSort('nombre_etapa')">Estatus</a>
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
		        				<a class="btn btn-sm btn-info btn-cirule" ng-href="{{ url( '/proyectos/[[proyecto.id_proyecto]]' ) }}" data-toggle="tooltip" data-title="Detalle"><i class="fa fa-list"></i></a>
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

                            		<div class="col-sm-3">
										<a href="[[proyecto.nombre_dominio]]">
											[[proyecto.nombre_dominio | noAsignado ]]
										</a>
                            		</div>

                            		<div class="col-sm-3">
										[[proyecto.fecha_creacion_avance | DateForHumans]]
                            		</div>

                            		<div class="col-sm-2">
										[[proyecto.nombre_etapa]]
                            		</div>

                            	</div>                           	 
                            </h3>
                        </div>
                        <div id="[[$index+1]]" class="panel-collapse collapse">
                            <div class="panel-body">
                            	<p>Cliente: [[proyecto.nombre_cliente]]</p>
                            	<p>Fecha de creación: [[proyecto.fecha_creacion_proyecto]]</p>
                            	<p>Tipo de Proyecto: [[proyecto.nombre_tipo_proyecto]]</p>
                            	
                            	<form action="[['/proyectos/reabrir/' + proyecto.id_proyecto]]" method="post">
					        		<div class="row">
						        		<div class="box-button">
											<button type="submit" class="btn btn-sm btn-success btn-custon pull-right" data-toggle="tooltip" data-title="Habilitar Proyecto"><i class="fa fa-unlock"></i></button>
										</div>
									</div>	
								</form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div><!-- content -->
	
</div>
@endsection