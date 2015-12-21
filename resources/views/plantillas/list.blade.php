@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/plantillas/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Crear Pantilla">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>
        

        <h1 class="page-header"><i class="fa fa-file-code-o"></i> Lista de Plantillass </h1>
        
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
                        <h4 class="panel-title">Plantillas</h4>
                    </div>

                    <div class="panel-body">

						@include('alerts.mensaje_error')
						@include('alerts.mensaje_success')

						<table class="table table-hover">
						    <thead>
						      <tr>
						        <th>Nombre de plantilla</th>
						        <th>Descripcion</th>
						        <th>Fecha de creacion</th>
						        <th>Operaciones</th>
						      </tr>
						    </thead>
						    <tbody>
						    	@foreach($plantillas as $key)
							    	<tr>
										<td>{{$key->nombre_plantilla}}</td>
							        	<td>{{$key->descripcion_plantilla}}</td>
										<td>{{$key->fecha_creacion_plantilla}}</td>
							        	<td >
							        		<a class="btn btn-sm btn-success" href="{{ url( '/plantillas/'.$key->id_plantilla.'/edit' ) }}" data-toggle="tooltip" data-title="Editar"><i class="fa fa-pencil-square-o"></i></a>
							        		<a class="btn btn-sm btn-danger" href="{{ url( '/plantillas/'.$key->id_plantilla.'/destroy' ) }}" data-toggle="tooltip" data-title="Eliminar"><i class="fa fa-trash"></i></a>
							        		<a class="btn btn-sm btn-white" target="_blank" href="{{ url( '/plantillas/preview/'.$key->id_plantilla ) }}" data-toggle="tooltip" data-title="Preview"><i class="fa fa-eye"></i></a>
							        	</td>
							        </tr>
								@endforeach
						    </tbody>
						</table>

						<div align="center">{!! $plantillas->render() !!}</div>
	
					</div><!-- boby -->
                </div>
            </div>
        </div>

    </div><!-- content -->
	
</div>
@endsection