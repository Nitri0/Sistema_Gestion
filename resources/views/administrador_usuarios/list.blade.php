@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="DominioController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/admin_usuarios/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Agregar Usuario">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>
        

        <h1 class="page-header"><i class="fa fa-users"></i> Todos los Usuarios </h1>
        
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
                        <h4 class="panel-title">Usuarios</h4>
                    </div>

                    <div class="panel-body">
	
						@include('alerts.mensaje_success')
						@include('alerts.mensaje_error')
		
						<div ng-init="usuarios={{$usuarios}}"></div>
						<div ng-init="url='{{url()}}'"></div>

						<table class="table table-hover">
						    <thead>
						      <tr>
						        <th>
						        	<a href="#" ng-click="changeSort('index')">#</a>
						        </th>		      	
						        <th>
						        	<a href="#" ng-click="changeSort('nombre_dominio')">Correo Usuario</a>
						        </th>	        
						        <th >Operaciones</th>
						      </tr>
						    </thead>
						    <tbody>
						    	<tr ng-repeat="usuario in usuarios| filter:opciones.buscador | orderBy:sort:reverse  track by $index">
									<td>[[$index]]</td>
									<td>[[usuario.correo_usuario ]]</td>
						        	<td>
						        		<form action="[[url+'/admin_usuarios/'+usuario.id_dominio]]" method="post">
							        		<a class="btn btn-sm btn-info" ng-href="{{ url( '/admin_usuarios/[[usuario.id_usuario]]/edit' ) }}" data-toggle="tooltip" data-title="Editar"><i class="fa fa-pencil-square-o"></i></a>
											<input type="hidden" name="_method" value="delete">
											<button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-title="Deshabilitar"><i class="fa fa-ban"></i></a>									
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