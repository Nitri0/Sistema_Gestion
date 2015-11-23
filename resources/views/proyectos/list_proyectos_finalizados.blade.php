@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="ProyectoController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">        

        <h1 class="page-header"><i class="fa fa-laptop"></i> Poryectos Finalizados </h1>
        
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-12 ui-sortable">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand" data-original-title="" title=""><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload" data-original-title="" title=""><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse" data-original-title="" title=""><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">Finalizados</h4>
                    </div>

                    <div class="panel-body">

						@include('alerts.mensaje_success')
						@include('alerts.mensaje_error')

						<div ng-init="proyectos = {{$proyectos}}"></div>
						
						<table class="table table-hover">
						    <thead>
						      <tr>
						        <th>
						        	<a href="#" ng-click="changeSort('index')">#</a>
						        </th>		      	
						        <th>
						        	<a href="#" ng-click="changeSort('nombre_proyecto')">Proyecto</a>
						        </th>
						        <th>
						        	<a href="#" ng-click="changeSort('nombre_cliente')">Cliente</a>
						        </th>
						        <th>
						        	<a href="#" ng-click="changeSort('nombre_dominio')">Dominio</a>
						        </th>
						        <th>
						        	<a href="#" ng-click="changeSort('fecha_creacion_avance')">Ultimo avance</a>
						        </th>
						        <th>
						        	<a href="#" ng-click="changeSort('nombre_etapa')">Estatus</a>
						        </th>
						        <th >Operaciones</th>
						      </tr>
						    </thead>
						    <tbody>
						    	<tr ng-repeat="proyecto in proyectos | filter:opciones.buscador | orderBy:sort:reverse  track by $index">
									<td>[[$index+1]]</td>
									<td>[[proyecto.nombre_proyecto]]</td>
									<td >
										<a href="{{url('/clientes/[[proyecto.id_cliente]]')}}">
											[[proyecto.nombre_cliente | noAsignado]]
										</a>
									</td>
									<td>
										<a href="{{url('/dominios/[[proyecto.id_dominio]]')}}">
											[[proyecto.nombre_dominio | noAsignado ]]
										</a>
									</td>
									<td>[[proyecto.fecha_creacion_avance | DateForHumans]]</td>
									<td>[[proyecto.nombre_etapa]]</td>
						        	<td >
						        		<form action="[['/proyectos/reabrir/' + proyecto.id_proyecto]]" method="post">
							        		<div class="row">
								        		<div class="box-button">
									        		<a class="btn btn-sm btn-info btn-custon" ng-href="{{ url( '/proyectos/[[proyecto.id_proyecto]]' ) }}" data-toggle="tooltip" data-title="Detalle"><i class="fa fa-list"></i></a>
													<button type="submit" class="btn btn-sm btn-success btn-custon" data-toggle="tooltip" data-title="Habilitar Proyecto"><i class="fa fa-external-link"></i></button>
												</div>
											</div>	
										</form>	        		
						        	</td>
						        </tr>

						    </tbody>
						</table>

					</div><!-- boby -->
                </div>
            </div>
        </div>

    </div><!-- content -->
	
</div>
@endsection