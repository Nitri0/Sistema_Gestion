@extends('layouts.base')

@section('content')
	<div class="container" ng-controller="GrupoEtapasController">

		<h2>Cear Etapas</h2>
		<form action="{{ url('tipo_proyectos/') }}" method="POST">		

			<br><br>
			<div class="from-group">
				<label for="">Identificador de proyectos</label>
				<input type="text" class="form-control" ng-model="tipo_proyecto.nombre_tipo_proyecto" name="nombre_tipo_proyecto">
			</div>
			<br>
			<br>
					

			<button type="submit">
				Registrar
			</button>
		</form>
	</div>
@stop