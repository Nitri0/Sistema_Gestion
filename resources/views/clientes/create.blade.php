@extends('layouts.base')

@section('content')
	<div class="container" ng-controller="ClienteController">

		@if($cliente)
			<h2>Editar Cliente</h2>
			<div ng-init="cliente={{ $cliente }}"></div>
			<form action="{{ url('clientes/'.$cliente->id_cliente) }}" method="POST">
			<input type="hidden" name="_method" value="PUT">
		@else
			<h2>Crear Cliente</h2>
			<form action="{{ url('clientes/') }}" method="POST">		
		@endif

			<br><br>
			<div class="from-group">
				<label for="">Nombre de cliente</label>
				<input type="text" class="form-control" ng-model="cliente.nombre_cliente" name="nombre_cliente">
			</div>
			<br>
			<div class="from-group">
				<label for="">Persona de contacto</label>
				<input type="text" class="form-control" ng-model="cliente.persona_contacto_cliente" name="persona_contacto_cliente">
			</div>	
			<br>
			<div class="from-group">
				<label for="">Rif</label>
				<input type="text" class="form-control" ng-model="cliente.ci_rif_cliente" name="ci_rif_cliente">
			</div>	
			<br>
			<div class="from-group">
				<label for="">Correo</label>
				<input type="text" class="form-control" ng-model="cliente.email_cliente" name="email_cliente">
			</div>			
			<br>
			<div class="from-group">
				<label for="">Telefono 1</label>
				<input type="text" class="form-control" ng-model="cliente.telefono_cliente" name="telefono_cliente">
			</div>
			<br>
			<div class="from-group">
				<label for="">Telefono 2</label>
				<input type="text" class="form-control" ng-model="cliente.telefono_2_cliente" name="telefono_2_cliente">
			</div>	
			<br>
			<div class="from-group">
				<label for="">Direccion</label>
				<input type="textarea" class="form-control" ng-model="cliente.direccion_cliente" name="direccion_cliente">
			</div>
			<br>
			<button type="submit">
				@if($cliente)
					Actualizar
				@else
					Registrar
				@endif
			</button>
		</form>
	</div>
@stop