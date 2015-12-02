@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="ProyectoController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/empresas_proveedoras/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Agregar Empresas Proveedoras">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>
        

        <h1 class="page-header"><i class="fa fa-laptop"></i> Empresas Proveedoras </h1>
        
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
                        <h4 class="panel-title">Proveedores</h4>
                    </div>

                    <div class="panel-body">
		
						@include('alerts.mensaje_success')
						@include('alerts.mensaje_error')

						<table class="table table-hover">
						    <thead>
						      <tr>
						        <th>Nombre Proveedor</th>
						        <th>Telefono</th>
						        <th >Operaciones</th>
						      </tr>
						    </thead>
						    <tbody>
						    	@foreach($empresas_proveedoras as $empresa_proveedora)
							    	<tr>
										<td>{{$empresa_proveedora->nombres_empresa_proveedora}}</td>
										<td>{{$empresa_proveedora->telefono_empresa_proveedora}}</td>
							        	<td>
											<a class="btn btn-sm btn-info" href="{{ url( '/empresas_proveedoras/'.$empresa_proveedora->id_empresa_proveedora ) }}" data-toggle="tooltip" data-title="Detalle"><i class="fa fa-bars"></i></a>		        		
							        		<a class="btn btn-sm btn-success" href="{{ url( '/empresas_proveedoras/'.$empresa_proveedora->id_empresa_proveedora.'/edit' ) }}" data-toggle="tooltip" data-title="Editar"><i class="fa fa-pencil-square-o"></i></a>
							        	</td>
							        </tr>
								@endforeach
						    </tbody>
						</table>

						{!! $empresas_proveedoras->render() !!}
	
					</div><!-- boby -->
                </div>
            </div>
        </div>

    </div><!-- content -->
	
</div>
@endsection
