@extends('layouts.base')

@section('content')
	<div class="container" ng-controller="ClienteController">

		@if($cliente)
			<h2>Editar Tipos de Proyectos</h2>
			<div ng-init="tipo_proyecto={{ $tipo_proyecto }}"></div>
			<form action="{{ url('tipo-proyectos/'.$tipo_proyecto->id_tipo_proyecto) }}" method="POST">
			<input type="hidden" name="_method" value="PUT">
		@else
			<h2>Crear Tipos de Proyectos</h2>
			<form action="{{ url('tipo-proyectos/') }}" method="POST">		
		@endif

			<br><br>
			<div class="from-group">
				<label for="">Nombre de cliente</label>
				<input type="text" class="form-control" ng-model="tipo_proyecto.nombre_tipo_proyecto" name="nombre_tipo_proyecto">
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