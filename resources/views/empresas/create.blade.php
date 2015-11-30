@extends('base-admin')

	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
    
@section('content')
	<div class="container" ng-controller="EmpresaController">

		@if($empresa)
			<h2>Editar Empresa</h2>
			<div ng-init="model={{ $empresa }}"></div>
			<form action="{{ url('admin_empresas/'.$empresa->id_empresa) }}" method="POST">
			<input type="hidden" name="_method" value="PUT">
		@else
			<h2>Crear Empresa</h2>
			<form action="{{ url('admin_empresas/') }}" method="POST">		
		@endif

			<br><br>
			<div class="from-group">
				<label for="">Nombre de empresa</label>
				<input type="text" class="form-control" ng-model="model.nombre_empresa" name="nombre_empresa">
			</div>
			<br>
			<div class="from-group">
				<label for="">Rif de empresa</label>
				<input type="text" class="form-control" ng-model="model.rif_empresa" name="rif_empresa">
			</div>	
			<br>
			<div class="from-group">
				<label for="">Correo de administrador</label>
				<input type="text" class="form-control" ng-model="model.email_cliente" name="email_cliente">
			</div>			
			<br>
			<div class="from-group">
				<label for="">telefono de administrador</label>
				<input type="text" class="form-control" ng-model="model.telefono_empresa" name="telefono_empresa">
			</div>
			<br>
			<div class="from-group">
				<label for="">Direccion</label>
				<input type="textarea" class="form-control" ng-model="model.direccion_empresa" name="direccion_empresa">
			</div>
			<br>
			<div class="from-group">
				<label for="">Datos de autenticacion</label>
			</div>
			<br>
			<div class="from-group">
				<label for="">Correo de usuario</label>
				<input type="textarea" class="form-control" ng-model="model.correo_usuario" name="correo_usuario">
			</div>
			<br>
			<div class="from-group">
				<label for="">Correo de usuario</label>
				<input type="textarea" class="form-control" ng-model="model.password" name="password">
			</div>

			<button type="submit">
				@if($empresa)
					Actualizar
				@else
					Registrar
				@endif
			</button>
		</form>
	</div>
@endsection