@extends('layouts.base')


@section('content')
	<div class="container">

		@include('alerts.mensaje_error')
		@include('alerts.mensaje_success')

		<div class="row">
			<div class="col-md-8"> <h2>Lista de grupos de etapas</h2></div>
			<div class="col-md-4">
				<a class="btn btn-sm btn-success" href="{{ url( '/grupo_etapas/create' ) }}"> Agregar</a>
			</div>

		</div>
		<br>
		<br>

		<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>Nombre de grupo</th>
		        <th>Descripcion</th>
		        <th>Cantidad de etapas</th>
		        <th>Operaciones</th>
		      </tr>
		    </thead>
		    <tbody>
		    	@foreach($grupo_etapas as $etapa)
			    	<tr>
						<td>{{$etapa->nombre_grupo_etapas}}</td>
			        	<td>{{$etapa->descripcion_grupo_etapas}}</td>
						<td>{{$etapa->cantidad_etapas}}</td>
			        	<td >
			        		<a class="btn btn-sm btn-info" href="{{ url( '/grupo_etapas/'.$etapa->id_grupo_etapas ) }}"> Detalle</a>
			        	</td>
			        </tr>
				@endforeach
		    </tbody>
		</table>

		<div align="center">{!! $grupo_etapas->render() !!}</div>
	</div>
	
@stop