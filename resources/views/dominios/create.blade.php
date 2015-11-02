@extends('layouts.base')

@section('content')
	<div class="container" ng-controller="DominioController">
	
		@if($dominio)
			<h2>Editar Dominio</h2>
			<div ng-init="dominio={{$dominio}}"></div>
			<div ng-init="empresas_proveedoras={{ $empresas_proveedoras }}"></div>
			

			[[dominio]]
			<form ng-action="{{ url('dominios/[[dominio.id_dominio]]') }}" method="Post" novalidate>
			<input type="hidden" name="_method" value="PUT">
		@else
			<h2>Crear Dominio</h2>
			<form action="{{ url('dominios/') }}" method="POST" novalidate>
		@endif

			<br><br>
			<div class="from-group">
				<label for="">Empresa proveedora</label>
				<select class="form-control" name="id_empresa_proveedora" 
					ng-options="item as item.nombres_empresa_proveedora for item in empresas_proveedoras track by item.id_empresa_proveedora"
					ng-model="dominio.id_empresa_proveedora">
					<option class="option" value="">Seleccione una empresa proveedora</option>
		
				</select>
				<button >
					<a href="{{ url('/empresas_proveedoras/create') }}">Agregar una empresa proveedora</a>
				</button>
			</div>

			<br>
			<div class="from-group">
				<label for="">Nombre Dominio</label>
				<input type="text" class="form-control" ng-model="dominio.nombre_dominio" name="nombre_dominio">
			</div>	
			<br>

			<div class="from-group">
				<label for="">Fecha de creacion de dominio</label>
				<input type="date" class="form-control" ng-value="dominio.fecha_dominio" name="fecha_dominio">
			</div>	

			<button type="submit">
				@if($dominio)
					Actualizar
				@else
					Registrar
				@endif
			</button>
		</form>
	</div>
@stop