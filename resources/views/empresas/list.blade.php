@extends('layouts.base')


    

@section('content')
	<div class="container">

		@include('alerts.mensaje_success')
		@include('alerts.mensaje_error')

		<div class="row">
			<div ng-init="models={{$empresas}}"></div>
			<div class="col-md-8"> <h2>Lista de empresas</h2></div>
			<div class="col-md-4">
				<a class="btn btn-sm btn-success" href="{{ url( '/admin_empresas/create' ) }}"> Agregar</a>
			</div>

		</div>
		<br>
		<br>

		<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>
		        	<a href="#" ng-click="changeSort('index')">#</a>
		        </th>		      	
		        <th>
		        	<a href="#" ng-click="changeSort('nombre_empresa')">Nombre Empresa</a>
		        </th>
		        <th>
		        	<a href="#" ng-click="changeSort('rif_empresa')">Rif </a>
		        </th>
		        <th>
		        	<a href="#" ng-click="changeSort('email_empresa')">Email</a>
		        </th>

		        <th >Operaciones</th>
		      </tr>

		    </thead>
		    
		    <tbody>
		    	<tr ng-repeat="model in models| filter:opciones.buscador | orderBy:sort:reverse  track by $index">
					<td>[[$index+1]]</td>
					<td>[[model.nombre_empresa ]]</td>
					<td>[[model.rif_empresa  ]]</td>
					<td>[[model.correo_empresa ]]</td>
		        	<td width="150px">
						<a class="btn btn-sm btn-info" href="{{ url( '/admin_empresas/[[model.id_empresa]]' ) }}"> Detalle</a>
		        		<a class="btn btn-sm btn-info" href="{{ url( '/admin_empresas/[[model.id_empresa]]/edit' ) }}"> Editar </a>	
		        	</td>
		        </tr>
		    </tbody>
		</table>
	</div>
	
@stop