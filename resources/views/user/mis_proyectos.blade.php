@extends('layouts.base')


@section('content')
	<div class="container">

		@include('alerts.mensaje_success')
		@include('alerts.mensaje_error')
				
		<div class="row">
			<div class="col-md-8"> <h2>Lista de mis proyectos</h2></div>
		</div>
		<br>
		<div ng-init = "proyectos = {{$proyectos}}"></div>
		
		<label for="">Buscador</label>
		<input type="text" ng-model="opciones.buscador">		
		<br>
		<div align="center" >
			<a href="#" ng-click="opciones.orden= inverse(opciones.orden)">invertir orden</a>
		</div>
		<table class="table table-hover">
		    <thead>
		      <tr>


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
		        	<a href="#" ng-click="opciones.orden='fecha_creacion_avance'">Rol</a>
		        </th>		        
		        <th>
		        	<a href="#" ng-click="opciones.orden='nombre_etapa'">Estatus</a>
		        </th>
		        <th>Operaciones</th>
		      </tr>
		    </thead>
		    <tbody>

		    	<tr ng-repeat="proyecto in proyectos| filter:opciones.buscador|orderBy:opciones.orden">
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
					<td>[[proyecto.nombre_tipo]]</td>
					<td>[[proyecto.nombre_etapa]]</td>
		        	<td >
		        		<div class="row">
			        		<a class="btn btn-sm btn-info col-sm-6" href="{{ url( '/mis-proyectos/[[proyecto.id_proyecto]]' ) }}">Detalle</a>
			        		<a class="btn btn-sm btn-success col-sm-6" href="{{ url( '/mis-proyectos/avances/[[proyecto.id_proyecto]]/create' ) }}">Crear avance</a>
		        		</div>
		        	</td>
			        </tr>

		    </tbody>
		</table>

	</div>
	
@stop