@extends('layouts.base')


@section('content')
	<div class="container">

		@include('alerts.mensaje_error')
		@include('alerts.mensaje_success')

		<div class="row">
			<div class="col-md-8"> <h2>Lista de Plantillas</h2></div>
			<div class="col-md-4">
				<a class="btn btn-sm btn-success" href="{{ url( '/plantillas/create' ) }}"> Agregar</a>
			</div>

		</div>
		<br>
		<br>

		<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>Nombre de plantilla</th>
		        <th>Descripcion</th>
		        <th>Fecha de creacion</th>
		        <th>Operaciones</th>
		      </tr>
		    </thead>
		    <tbody>
		    	@foreach($plantillas as $key)
			    	<tr>
						<td>{{$key->nombre_plantilla}}</td>
			        	<td>{{$key->descripcion_plantilla}}</td>
						<td>{{$key->fecha_creacion_plantilla}}</td>
			        	<td >
			        		<a class="btn btn-sm btn-info" href="{{ url( '/plantillas/'.$key->id_plantilla.'/edit' ) }}"> Editar</a>
			        		<a class="btn btn-sm btn-info" target="_blank" href="{{ url( '/plantillas/preview/'.$key->id_plantilla ) }}"> Preview</a>
			        	</td>
			        </tr>
				@endforeach
		    </tbody>
		</table>

		<div align="center">{!! $plantillas->render() !!}</div>
	</div>
	
@stop