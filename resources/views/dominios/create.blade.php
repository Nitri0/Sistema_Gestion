@extends('layouts.base')

@section('content')
	<div class="container" ng-controller="DominioController">

		@if($dominio)
			<h2>Editar Dominio</h2>
			<div ng-init="dominio={{ $dominio }}"></div>
			<form action="{{ url('dominios/'.$dominio->id_cliente) }}" method="PUT" novalidate>
		@else
			<h2>Crear Dominio</h2>
			<form action="{{ url('dominios/') }}" method="POST" novalidate>
		@endif

			<br><br>
			<div class="from-group">
				<label for="">Cliente</label>
				<select class="form-control" name="id_cliente"   ng-model="dominio.id_cliente">
					<option class="option" value="">Seleccione un cliente</option>
					@foreach($clientes as $cliente)
						<option class="option" value="{{$cliente->id_cliente}}">
							{{ $cliente->nombre_cliente }}
						</option>;
					@endforeach
				</select>
				<button >
					<a href="{{ url('/clientes/create') }}">Agregar un cliente</a>
				</button>
			</div>			
			<br>

			<div class="from-group">
				<label for="">Empresa proveedora</label>
				<select class="form-control" name="id_empresa_proveedora" ng-model="dominio.id_empresa_provedora">
					<option class="option" value="">Seleccione una empresa proveedora</option>
					@foreach($empresas_proveedoras as $proveedor)
						<option class="option" value="{{$proveedor->id_empresa_proveedora}}">
							{{ $proveedor->nombres_empresa_proveedora }}
						</option>;
					@endforeach
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
				<input type="date" class="form-control" ng-model="dominio.fecha_dominio" name="fecha_dominio">
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