@extends('base-admin')

@section('css')
	<link href="{{ asset('/thema/admin/html/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" />
	<link href="{{ asset('/thema/admin/html/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css') }}" rel="stylesheet" />
@endsection

@section('js')
	<script src="{{ asset('/thema/admin/html/assets/plugins/DataTables/media/js/jquery.dataTables.js') }}"></script>
	<script src="{{ asset('/thema/admin/html/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js') }}"></script>
	<script src="{{ asset('/thema/admin/html/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('/thema/admin/html/assets/js/table-manage-responsive.demo.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			TableManageResponsive.init();
		});
	</script>
@endsection

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="DominioController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
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

        <h1 class="page-header"><i class="fa fa-link"></i> Lista de Roles</h1>
        
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
                        <h4 class="panel-title">Roles</h4>
                    </div>

                    <div class="panel-body">
			
						@include('alerts.mensaje_success')
						@include('alerts.mensaje_error')
						
						<div ng-init="models={{$roles}}"></div>
						<div ng-init="url='{{url()}}'"></div>

						<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
						    <thead>
						      <tr>
						        <th>
						        	<a href="#" ng-click="changeSort('index')">#</a>
						        </th>		      	
						        <th>
						        	<a href="#" ng-click="changeSort('nombre_tipo_rol')">Nombre de rol</a>
						        </th>
	        
						        <th >Operaciones</th>
						      </tr>

						    </thead>
						    <tbody>
						    	<tr class="odd gradeX" ng-repeat="model in models| filter:opciones.buscador | orderBy:sort:reverse  track by $index">
									<td>[[$index+1]]</td>
									<td>[[model.nombre_tipo_rol ]]</td>
						        	<td>
						        		<a class="btn btn-sm btn-info" ng-href="{{ url( '/roles/[[model.id_tipo_rol]]/edit' ) }}" data-toggle="tooltip" data-title="Editar"><i class="fa fa-pencil-square-o"></i></a>
						        		<a class="btn btn-sm btn-inverse" ng-href="{{ url( '/roles/[[model.id_tipo_rol]]') }}" data-toggle="tooltip" data-title="Gestionar"><i class="fa fa-cogs"></i></a>
						        		<a class="btn btn-sm btn-danger" ng-href="{{ url( '/roles/[[model.id_tipo_rol]]/destroy') }}" data-toggle="tooltip" data-title="Eliminar"><i class="fa fa-trash"></i></i></a>
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