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

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="ProyectoController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
        
        <!--<ol class="breadcrumb pull-right">
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
        </ol>-->

        <h1 class="page-header"><i class="fa fa-laptop"></i> Mis Proyectos </h1>
        
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
                        <h4 class="panel-title">Mis Proyectos</h4>
                    </div>

                    <div class="panel-body">
						@include('alerts.mensaje_success')
						@include('alerts.mensaje_error')
								
						<div ng-init = "proyectos = {{$proyectos}}"></div>
                    	
                    	<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Proyecto</th>
                                    <th>Cliente</th>
                                    <th>Dominio</th>
                                    <th>Ultimo avance</th>
                                    <th>Rol</th>
                                    <th>Estatus</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="odd gradeX" ng-repeat="proyecto in proyectos| filter:opciones.buscador | orderBy:sort:reverse  track by $index">
                                    <td>[[$index+1]]</td>
                                    <td>[[proyecto.nombre_proyecto]]</td>
                                    <td>
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
                                    <td>
                                    	<div class="row">
						        			<div class="box-button">
								        		<a class="btn btn-sm btn-info btn-custon" href="{{ url( '/mis-proyectos/[[proyecto.id_proyecto]]' ) }}" data-toggle="tooltip" data-title="Detalle"><i class="fa fa-list"></i></a>
								        		<a class="btn btn-sm btn-success btn-custon" href="{{ url( '/mis-proyectos/avances/[[proyecto.id_proyecto]]/create' ) }}" data-toggle="tooltip" data-title="Crear Avance"><i class="fa fa-line-chart"></i></a>
						        			</div>
						        		</div>
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