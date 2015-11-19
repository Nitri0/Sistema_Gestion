@extends('base-admin')

@section('content')


<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="ProyectoController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url('mis-publicidades/agregar-publicidad')}}" class="btn btn-white btn-sm p-l-20 p-r-20">
                        <i class="fa fa-plus-square"></i>
                    </a>
                </div>
                <div class="btn-group">
                    <a href="{{ url('mis-publicidades/listar')}}" class="btn btn-white btn-sm p-l-20 p-r-20">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                </div>
            </div>
        </ol>

        <h1 class="page-header"><i class="fa fa-laptop"></i> Mis Proyecto </h1>
        
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
                        <h4 class="panel-title">Todas las Publicidad</h4>
                    </div>

                    <div class="panel-body">
						@include('alerts.mensaje_success')
						@include('alerts.mensaje_error')
								
						<div ng-init = "proyectos = {{$proyectos}}"></div>
						
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
						        	<a href="#" ng-click="changeSort('tipo_nombre')">Rol</a>
						        </th>		        
						        <th>
						        	<a href="#" ng-click="changeSort('nombre_etapa')">Estatus</a>
						        </th>



						        <th>Operaciones</th>
						      </tr>
						    </thead>
						    <tbody>

						    	<tr ng-repeat="proyecto in proyectos| filter:opciones.buscador | orderBy:sort:reverse  track by $index">
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
									<td>[[proyecto.nombre_tipo]]</td>
									<td>[[proyecto.nombre_etapa]]</td>
						        	<td >
						        		<div class="row">
							        		<a class="btn btn-sm btn-info col-sm-6" href="{{ url( '/mis-proyectos/[[proyecto.id_proyecto]]' ) }}">Detalle</a>
							        		<a class="btn btn-sm btn-success col-sm-6" href="{{ url( '/mis-proyectos/avances/[[proyecto.id_proyecto]]/create' ) }}">Crear avance</a>
						        		</div>
						        	</td>
							        </tr>

						    </tbody>
						</table>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- content -->
	
</div>

@endsection