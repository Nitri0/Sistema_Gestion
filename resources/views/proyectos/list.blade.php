@extends('layouts.base')


@section('content')
	<div class="container">

		@include('alerts.mensaje_success')
		@include('alerts.mensaje_error')
				
		<div class="row">
			<div class="col-md-8"> <h2>Lista de proyectos</h2></div>
			<div class="col-md-4">
				<a class="btn btn-sm btn-success" href="{{ url( '/proyectos/create' ) }}"> Agregar</a>
			</div>

		</div>
		<br>
		<br>

		<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>Nombre Proyecto</th>
		        <th>Cliente Asociado</th>
		        <th>Fecha de creación</th>
		        <th>Estatus</th>
		        <th >Operaciones</th>
		      </tr>
		    </thead>
		    <tbody>
		    	@foreach($proyectos as $proyecto)
			    	<tr>
						<td>{{$proyecto->nombre_proyecto}}</td>
						<td>{{$proyecto->getCliente()->nombre_cliente}}</td>
						<td>{{$proyecto->fecha_creacion_proyecto}}</td>
						<td>{{$proyecto->getEstatus()}}</td>
			        	<td >
			        		<a class="btn btn-sm btn-info" href="{{ url( '/proyectos/'.$proyecto->id_proyecto ) }}"> Detalle</a>
			        	</td>
			        </tr>
				@endforeach
		    </tbody>
		</table>

		<div align="center">{!! $proyectos->render() !!}</div>
	</div>
	
@stop