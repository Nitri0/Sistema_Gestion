@extends('layouts.base')

@section('content')
	<div class="container" ng-controller="DominioController">				
		@include('alerts.mensaje_success')
		@include('alerts.mensaje_error')
		
		<div class="row">
			<div ng-init="usuarios={{$usuarios}}"></div>
			<div ng-init="url='{{url()}}'"></div>

			<div class="col-md-8"><h2>Lista de Dominios</h2></div>
			<div class="col-md-4">
				<a class="btn btn-sm btn-success" href="{{ url( '/admin_usuarios/create' ) }}">Agregar</a>
			</div>

		</div>
		<br>
		<label for="">Buscador</label>
		<input type="text" ng-model="opciones.buscador">
		<br>
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
		        	<td >
		        		<div class="row">
		        		<a class="btn btn-sm btn-info" ng-href="{{ url( '/admin_usuarios/[[usuario.id_usuario]]/edit' ) }}">Editar</a>
						<form action="[[url+'/admin_usuarios/'+usuario.id_dominio]]" method="post">
							<input type="hidden" name="_method" value="delete">
							<button type="submit" class="btn btn-sm btn-danger">Deshabilitar</a>
						</form>
						</div>
		        	</td>
		        </tr>
		    </tbody>
		</table>
	</div>
	
@stop