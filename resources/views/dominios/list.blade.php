@extends('layouts.base')

@section('content')
	<div class="container" ng-controller="DominioController">				
		@include('alerts.mensaje_success')
		@include('alerts.mensaje_error')
		
		<div class="row">
			<div ng-init="dominios={{$dominios}}"></div>
			<div ng-init="url='{{url()}}'"></div>

			<div class="col-md-8"><h2>Lista de Dominios</h2></div>
			<div class="col-md-4">
				<a class="btn btn-sm btn-success" href="{{ url( '/dominios/create' ) }}">Agregar</a>
				<a class="btn btn-sm btn-success" href="{{ url( '/dominios/updateData' ) }}">Actualizar</a>
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
		        	<a href="#" ng-click="changeSort('nombre_dominio')">Dominio</a>
		        </th>
		        <th>
		        	<a href="#" ng-click="changeSort('nombre_proyecto')">Proyecto</a>
		        </th>
		        <th>
		        	<a href="#" ng-click="changeSort('nombres_empresa_proveedora')">Proveedor</a>
		        </th>
		        <th>
		        	<a href="#" ng-click="changeSort('nombre_cliente')">Cliente</a>
		        </th>
		        <th>
		        	<a href="#" ng-click="changeSort('fecha_dominio')">Fecha creacion</a>
		        </th>
	        	<th>
		        	<a href="#" ng-click="changeSort('espacio_usado_dominio')">Espacio usado</a>
		        </th>		        
		        <th >Operaciones</th>
		      </tr>

		    </thead>
		    <tbody>
		    	<tr ng-repeat="dominio in dominios| filter:opciones.buscador | orderBy:sort:reverse  track by $index">
					<td>[[$index]]</td>
					<td>[[dominio.nombre_dominio ]]</td>
					<td>[[dominio.nombre_proyecto | noAsignado ]]</td>
					<td>[[dominio.nombres_empresa_proveedora | noAsignado ]]</td>
					<td>[[dominio.nombre_cliente | noAsignado]]</td>
					<td>[[dominio.fecha_dominio | date:'d MMM yy']]</td>
					<td>
						[[dominio.espacio_usado_dominio | formatSize]]
						<span ng-bind-html="dominio.espacio_usado_dominio | compareSize:dominio.espacio_asignado_dominio" ></span>			
					</td>
		        	<td >
		        		<div class="row">
		        		<a class="btn btn-sm btn-info" ng-href="{{ url( '/dominios/[[dominio.id_dominio]]/edit' ) }}">Editar</a>
		        		<a class="btn btn-sm btn-info" ng-href="{{ url( '/dominios/[[dominio.id_dominio]]') }}">Gestionar</a>
						<form action="[[url+'/dominios/'+dominio.id_dominio]]" method="post">
							<input type="hidden" name="_method" value="delete">
							<button type="submit" class="btn btn-sm btn-danger" >Eliminar</a>
						</form>
						</div>
		        	</td>
		        </tr>
		    </tbody>
		</table>
	</div>
	
@stop