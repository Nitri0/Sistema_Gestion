@extends('layouts.base')

@section('content')
	<div class="container">

		@include('alerts.mensaje_error')
		@include('alerts.mensaje_success')

		<div class="row">
			<div class="col-md-8"> <h2>Lista de grupos de etapas</h2></div>
			<div class="col-md-4">
				<a class="btn btn-sm btn-success" href="{{ url( '/tipo_proyectos/create' ) }}"> Agregar</a>
			</div>

		</div>
		<br>
		<br>

		<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>Nombre Tipo Proyecto</th>
		      </tr>
		    </thead>
		    <tbody>
		    	@foreach($tipo_proyectos as $tipo_proyecto)
			    	<tr>
						<td>{{$tipo_proyecto->nombre_tipo_proyecto}}</td>
			        </tr>
				@endforeach
		    </tbody>
		</table>

		<div align="center">{!! $tipo_proyectos->render() !!}</div>
	</div>
	
@stop