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

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/clientes/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>

        <h1 class="page-header"><i class="fa fa-laptop"></i> Lista de Clientes </h1>
        
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
                        <h4 class="panel-title">Clientes</h4>
                    </div>

                    <div class="panel-body">

						@include('alerts.mensaje_success')
						@include('alerts.mensaje_error')


						<div ng-init="models={{$clientes}}"></div>
						<div ng-init="url='{{url()}}'"></div>


						<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
						    <thead>
						      <tr>
						        <th>
						        	<a href="#" ng-click="changeSort('index')">#</a>
						        </th>		      	
						        <th>
						        	<a href="#" ng-click="changeSort('nombre_cliente')">Nombre</a>
						        </th>
						        <th>
						        	<a href="#" ng-click="changeSort('ci_rif_cliente')">CI / RIF</a>
						        </th>
						        <th>
						        	<a href="#" ng-click="changeSort('email_cliente')">Email</a>
						        </th>
						        <th>
						        	<a href="#" ng-click="changeSort('persona_contacto_cliente')">Contacto</a>
						        </th>
						        <th>
						        	<a href="#" ng-click="changeSort('nombre_proyecto')">Proyecto Asociado</a>
						        </th>
					        	<th>
						        	<a href="#" ng-click="changeSort('espacio_usado_dominio')">Operaciones</a>
						        </th>		        
						        <th >Operaciones</th>
						      </tr>

						    </thead>
						    <tbody>
						    	<tr class="odd gradeX" ng-repeat="model in models| filter:opciones.buscador | orderBy:sort:reverse  track by $index">
									<td>[[$index]]</td>
									<td>[[model.nombre_cliente ]]</td>
									<td>[[model.ci_rif_cliente ]]</td>
									<td>[[model.email_cliente  ]]</td>
									<td>[[model.persona_contacto_cliente ]]</td>
									<td>[[model.nombre_proyecto | noAsignado]]</td>
						        	<td>
						        		<form action="[[url+'/clientes/'+model.id_cliente]]" method="post">
							        		<a class="btn btn-sm btn-info" ng-href="{{ url( '/clientes/[[model.id_cliente]]/edit' ) }}" data-toggle="tooltip" data-title="Editar"><i class="fa fa-pencil-square-o"></i></a>
							        		<a class="btn btn-sm btn-inverse" ng-href="{{ url( '/clientes/[[model.id_cliente]]') }}" data-toggle="tooltip" data-title="Gestionar"><i class="fa fa-cogs"></i></a>
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