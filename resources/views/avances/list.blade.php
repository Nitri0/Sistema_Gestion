@extends('layouts.base')


@section('content')
	<div class="container">

		@include('alerts.mensaje_success')
		@include('alerts.mensaje_error')
				
		<div class="row">
			<div class="col-md-8"> <h2>Lista de avances</h2></div>
			<div class="col-md-4">
				<a class="btn btn-sm btn-success" href="{{ url( '/mis-proyectos/avances/'.$id_proyecto.'/create' ) }}"> Agregar</a>
			</div>

		</div>
		<br>
		<br>

		<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>Asunto</th>
		        <th>Fecha de creación</th>
		        <th >Operaciones</th>
		      </tr>
		    </thead>
		    <tbody>
		    	@foreach($avances as $avance)
			    	<tr>
						<td>{{$avance->asunto_avance }}</td>
						<td>{{$avance->fecha_avance}}</td>
			        	<td >
			        		<a class="btn btn-sm btn-info" href="{{ url( '/avances/'.$avance->id_avance ) }}"> Detalle</a>
			        	</td>
			        </tr>
				@endforeach
		    </tbody>
		</table>

		<div align="center">{!! $avances->render() !!}</div>
	</div>
	
@stop