@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="EmpresaController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
        
        @if($empresa)
        <h1 class="page-header"><i class="fa fa-laptop"></i> Editar Empresa </h1>
        
        <div ng-init="model={{$empresa}}"></div>
		<div ng-init="usuario={{$usuario}}"></div>
			
		<form class="form-horizontal" action="{{ url('admin_empresas/'.$empresa->id_empresa) }}" method="POST">
		<input type="hidden" name="_method" value="PUT">
        
        @else
        <h1 class="page-header"><i class="fa fa-laptop"></i>Crear Empresa </h1>
		<form class="form-horizontal" action="{{ url('admin_empresas/') }}" method="POST">	

		@endif
        
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

	                    	<br>

	                    	<div class="form-group">
	                            <label class="col-md-4 control-label">Nombre de empresa</label>
	                            <div class="col-md-5">
	                            	<input type="text" class="form-control" ng-model="model.nombre_empresa" name="nombre_empresa">
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <label class="col-md-4 control-label">Rif de empresa</label>
	                            <div class="col-md-5">
	                            	<input type="text" class="form-control" ng-model="model.rif_empresa" name="rif_empresa">
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <label class="col-md-4 control-label">Correo de administrador</label>
	                            <div class="col-md-5">
	                            	<input type="text" class="form-control" ng-model="model.correo_empresa" name="correo_empresa">
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <label class="col-md-4 control-label">Telefono de administrador</label>
	                            <div class="col-md-5">
	                            	<input type="text" class="form-control" ng-model="model.telefono_empresa" name="telefono_empresa">
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <label class="col-md-4 control-label">Dirección</label>
	                            <div class="col-md-5">
	                            	<input type="textarea" class="form-control" ng-model="model.direccion_empresa" name="direccion_empresa">
	                            </div>
	                        </div>

							<div class="from-group">
								<center><label class="control-label">Datos de autenticación</label></center>
							</div>
							<br>

							<div class="form-group">
	                            <label class="col-md-4 control-label">Correo de usuario</label>
	                            <div class="col-md-5">
	                            	<input type="textarea" class="form-control" ng-model="usuario.correo_usuario" name="correo_usuario">
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <label class="col-md-4 control-label">Contraseña</label>
	                            <div class="col-md-5">
	                            	<input type="textarea" class="form-control" ng-model="usuario.password" name="password">
	                            </div>
	                        </div>

							<br>
							<center>
								@if($empresa)
								<button type="submit" class="btn btn-danger m-r-5 m-b-5">Actualizar <i class="fa fa-refresh"></i></button>
								@else
								<button type="submit" class="btn btn-success m-r-5 m-b-5">Registrar <i class="fa fa-pencil-square-o"></i></button>
								@endif
							</center>
							
			
		
						</div><!-- boby -->
	                </div>
	            </div>
	        </div>
		</form>
    </div><!-- content -->
	
</div>
@endsection
