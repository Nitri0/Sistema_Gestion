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
        

        <h1 class="page-header">Lista de Empresas </h1>
        
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
                        <h4 class="panel-title">Empresas</h4>
                    </div>

                    <div class="panel-body">

                    	<div ng-init="models={{$empresas}}"></div>

						@include('alerts.mensaje_success')
						@include('alerts.mensaje_error')

						<table class="table table-hover">
						    <thead>
						      <tr>
						        <th>
						        	<a href="#" ng-click="changeSort('index')">#</a>
						        </th>		      	
						        <th>
						        	<a href="#" ng-click="changeSort('nombre_empresa')">Nombre Empresa</a>
						        </th>
						        <th>
						        	<a href="#" ng-click="changeSort('rif_empresa')">Rif </a>
						        </th>
						        <th>
						        	<a href="#" ng-click="changeSort('email_empresa')">Email</a>
						        </th>
						   		<th>
						        	<a href="#" ng-click="changeSort('habilitado_empresa')">Status</a>
						        </th>

						        <th >Operaciones</th>
						      </tr>

						    </thead>
						    
						    <tbody>
						    	<tr ng-repeat="model in models| filter:opciones.buscador | orderBy:sort:reverse  track by $index">
									<td>[[$index+1]]</td>
									<td>[[model.nombre_empresa ]]</td>
									<td>[[model.rif_empresa  ]]</td>
									<td>[[model.correo_empresa ]]</td>
									<td>[[model.habilitado_empresa ]]</td>
						        	<td width="180px">
										<a class="btn btn-sm btn-info" href="{{ url( '/admin_empresas/[[model.id_empresa]]' ) }}" data-toggle="tooltip" data-title="Detalle"><i class="fa fa-list"></i></a>
						        		<a class="btn btn-sm btn-success" href="{{ url( '/admin_empresas/[[model.id_empresa]]/edit' ) }}" data-toggle="tooltip" data-title="Editar"><i class="fa fa-pencil-square-o"></i></a>	
						        		<a class="btn btn-sm btn-info" ng-href="{{ url( '/admin_empresas/[[model.id_empresa]]/habilitar') }}" data-toggle="tooltip" data-title="Habilitar"><i class="fa fa-trash"></i></i></a>
						        		<a class="btn btn-sm btn-danger" ng-href="{{ url( '/admin_empresas/[[model.id_empresa]]/destroy') }}" data-toggle="tooltip" data-title="Deshabilitar"><i class="fa fa-trash"></i></i></a>
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
