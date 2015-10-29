@extends('layouts.base')

@section('content')
	<div class="container" ng-controller="GrupoEtapasController">

		<h2>Cear Etapas</h2>
		<form action="{{ url('grupo_etapas/') }}" method="POST">		

			<br><br>
			<div class="from-group">
				<label for="">Identificador de grupo de etapas</label>
				<input type="text" class="form-control" ng-model="GrpEtapas.nombre_grupo_etapas" name="nombre_grupo_etapas">
			</div>
			<br>
			<div class="from-group">
				<label for="">Descripcion del grupo de etapas</label>
				<input type="text" class="form-control" ng-model="GrpEtapas.descripcion_grupo_etapas" name="descripcion_grupo_etapas">
			</div>
			<br>			
			<br>
			<button type="button" ng-click="agregar_etapa()"> Agregar nueva etapa</button>
			<button type="button" ng-show="cantidad>=1" ng-click="eliminar_etapa()"> Eliminar ultima etapa</button>
			<br>
			<input type="hidden" class="form-control" name="cantidad_etapas" ng-value="cantidad">
			<div ng-repeat="etapa in etapas track by $index">

				<div class="from-group">
					<label for="">Etapa [[$index+1]]</label>
					<div class="from-group">
						<label for="">Nombre de etapa</label>
						<input type="text" class="form-control" ng-model="GrpEtapas.nombre_etapa_[[$index]]" name="nombre_etapa_[[$index]]">
					</div>

					<div class="from-group">
						<label for="">Tiempo estimado en esta estapa (dias)</label>
						<input type="text" class="form-control" ng-model="GrpEtapas.tiempo_etapa_[[$index]]" name="tiempo_etapa_[[$index]]">
					</div>					
				</div>	
				<br>

			</div>			

			<button type="submit">
				Registrar
			</button>
		</form>
	</div>
@stop