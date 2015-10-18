@extends('layouts.base')

@section('content')
	<div class="container" ng-controller="ProveedorController">

		@if($empresa_proveedora)
			<h2>Editar Empresa Proveedora</h2>
			<div ng-init="cliente={{ $empresa_proveedora }}"></div>
			<form action="{{ url('empresas_proveedoras/'.$empresa_proveedora->id_cliente) }}" method="PUT">
		@else
			<h2>Crear Empresa Proveedora</h2>
			<form action="{{ url('empresas_proveedoras/') }}" method="POST">		
		@endif

			<br><br>
			<div class="from-group">
				<label for="">Nombres de empresa proveedora</label>
				<input type="text" class="form-control" ng-model="empresa_proveedora.nombres_empresa_proveedora" name="nombres_empresa_proveedora">
			</div>
			<br>
			<div class="from-group">
				<label for="">telefono de empresa proveedora</label>
				<input type="text" class="form-control" ng-model="empresa_proveedora.telefono_empresa_proveedora" name="telefono_empresa_proveedora">
			</div>	

			<br>
			<button type="submit">
				@if($empresa_proveedora)
					Actualizar
				@else
					Registrar
				@endif
	
			</button>
		</form>
	</div>
@stop