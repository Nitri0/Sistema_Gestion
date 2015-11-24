@extends('base-admin')

@section('content')


<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="DominioController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/dominios/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Agregar Dominio">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
                <div class="btn-group">
                    <a href="{{ url( '/dominios/updateData' ) }}" class="btn btn-danger btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Actualizar">
                        <i class="fa fa-repeat"></i>
                    </a>
                </div>
            </div>
        </ol>

        <h1 class="page-header"><i class="fa fa-link"></i> Lista de Dominios</h1>
        
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
                        <h4 class="panel-title">Dominios</h4>
                    </div>

                    <div class="panel-body">
			
						@include('alerts.mensaje_success')
						@include('alerts.mensaje_error')
						

						<div ng-init="dominios={{$dominios}}"></div>
						<div ng-init="url='{{url()}}'"></div>

						<table class="table table-hover">
						    <thead>
						      <tr>
						        <th>
						        	<a href="#" ng-click="changeSort('index')">#</a>
						        </th>		      	
						        <th>
						        	<a href="#" ng-click="changeSort('nombre_dominio')">Dominio</a>
						        </th>
						        <th>
						        	<a href="#" ng-click="changeSort('nombre_proyecto')">Proyecto</a>
						        </th>
						        <th>
						        	<a href="#" ng-click="changeSort('nombres_empresa_proveedora')">Proveedor</a>
						        </th>
						        <th>
						        	<a href="#" ng-click="changeSort('nombre_cliente')">Cliente</a>
						        </th>
						        <th>
						        	<a href="#" ng-click="changeSort('fecha_dominio')">Fecha creacion</a>
						        </th>
					        	<th>
						        	<a href="#" ng-click="changeSort('espacio_usado_dominio')">Espacio usado</a>
						        </th>		        
						        <th >Operaciones</th>
						      </tr>

						    </thead>
						    <tbody>
						    	<tr ng-repeat="dominio in dominios| filter:opciones.buscador | orderBy:sort:reverse  track by $index">
									<td>[[$index]]</td>
									<td>[[dominio.nombre_dominio ]]</td>
									<td>[[dominio.nombre_proyecto | noAsignado ]]</td>
									<td>[[dominio.nombres_empresa_proveedora | noAsignado ]]</td>
									<td>[[dominio.nombre_cliente | noAsignado]]</td>
									<td>[[dominio.fecha_dominio | date:'d MMM yy']]</td>
									<td>
										[[dominio.espacio_usado_dominio | formatSize]]
										<span ng-bind-html="dominio.espacio_usado_dominio | compareSize:dominio.espacio_asignado_dominio" ></span>			
									</td>
						        	<td width="150px">
						        		<form action="[[url+'/dominios/'+dominio.id_dominio]]" method="post">
							        		<a class="btn btn-sm btn-info" ng-href="{{ url( '/dominios/[[dominio.id_dominio]]/edit' ) }}" data-toggle="tooltip" data-title="Editar"><i class="fa fa-pencil-square-o"></i></a>
							        		<a class="btn btn-sm btn-inverse" ng-href="{{ url( '/dominios/[[dominio.id_dominio]]') }}" data-toggle="tooltip" data-title="Gestionar"><i class="fa fa-cogs"></i></a>
											<input type="hidden" name="_method" value="delete">
											<button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-title="Eliminar"><i class="fa fa-trash"></i></button>
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