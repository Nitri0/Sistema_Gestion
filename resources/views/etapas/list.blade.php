@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/grupo_etapas/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Agregar">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>

        <h1 class="page-header"><i class="fa fa-database"></i> Lista de grupos de etapas</h1>
        
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
                        <h4 class="panel-title">Grupos de Etapas</h4>
                    </div>

                    <div class="panel-body">

						@include('alerts.mensaje_error')
						@include('alerts.mensaje_success')

						<table class="table table-hover">
						    <thead>
						      <tr>
						        <th>Nombre de grupo</th>
						        <th>Descripcion</th>
						        <th>Cantidad de etapas</th>
						        <th>Operaciones</th>
						      </tr>
						    </thead>
						    <tbody>
						    	@foreach($grupo_etapas as $etapa)
							    	<tr>
										<td>{{$etapa->nombre_grupo_etapas}}</td>
							        	<td>{{$etapa->descripcion_grupo_etapas}}</td>
										<td>{{$etapa->cantidad_etapas}}</td>
							        	<td>
							        		<a class="btn btn-sm btn-info" href="{{ url( '/grupo_etapas/'.$etapa->id_grupo_etapas ) }}" data-toggle="tooltip" data-title="Detalle"><i class="fa fa-list"></i></a>
							        	</td>
							        </tr>
								@endforeach
						    </tbody>
						</table>

						<div align="center">{!! $grupo_etapas->render() !!}</div>

	
					</div><!-- boby -->
                </div>
            </div>
        </div>

    </div><!-- content -->
	
</div>

@endsection