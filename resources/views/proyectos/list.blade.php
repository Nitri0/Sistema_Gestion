@extends('layouts.base')


@section('content')
	<div class="container" ng-controller = "ProyectoController">

		@include('alerts.mensaje_success')
		@include('alerts.mensaje_error')
		
		<div class="row">
			<div class="col-md-8"> <h2>Lista de proyectos</h2></div>
			<div class="col-md-4">
				<a class="btn btn-sm btn-success" href="{{ url( '/proyectos/create' ) }}"> Agregar</a>
			</div>

		</div>
		<br>
		<label for="">Buscador</label>
		<input type="text" ng-model="opciones.buscador">
		<br>
		<div ng-init = "proyectos = {{$proyectos}}"></div>
		<div align="center" >
			<a href="#" ng-click="opciones.orden= inverse(opciones.orden)">invertir orden</a>
		</div>
		<br>
		<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>
		        	<a href="#" ng-click="opciones.orden=$index">#</a>
		        </th>		      	
		        <th>
		        	<a href="#" ng-click="opciones.orden='nombre_proyecto'">Proyecto</a>
		        </th>
		        <th>
		        	<a href="#" ng-click="opciones.orden='nombre_cliente'">Cliente</a>
		        </th>
		        <th>
		        	<a href="#" ng-click="opciones.orden='nombre_dominio'">Dominio</a>
		        </th>
		        <th>
		        	<a href="#" ng-click="opciones.orden='fecha_creacion_avance'">Ultimo avance</a>
		        </th>
		        <th>
		        	<a href="#" ng-click="opciones.orden='nombre_etapa'">Estatus</a>
		        </th>
		        <th >Operaciones</th>
		      </tr>
		    </thead>
		    <tbody>
		    	<tr ng-repeat="proyecto in proyectos| filter:opciones.buscador|orderBy:opciones.orden  track by $index">
					<td>[[$index+1]]</td>
					<td>[[proyecto.nombre_proyecto]]</td>
					<td >
						<a href="{{url('/clientes/[[proyecto.id_cliente]]')}}">
							[[proyecto.nombre_cliente | noAsignado]]
						</a>
					</td>
					<td>
						<a href="{{url('/dominios/[[proyecto.id_dominio]]')}}">
							[[proyecto.nombre_dominio | noAsignado ]]
						</a>
					</td>
					<td>[[proyecto.fecha_creacion_avance | DateForHumans]]</td>
					<td>[[proyecto.nombre_etapa]]</td>
		        	<td >
		        		<a class="btn btn-sm btn-info" ng-href="{{ url( '/proyectos/[[proyecto.id_proyecto]]' ) }}"> Detalle</a>
		        	</td>
		        </tr>

		    </tbody>
		</table>


	</div>
	
@stop