@extends('layouts.base')


@section('content')
	<div class="container">

		@if(Session::has('mensaje'))
			<div class="alert alert-success">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  	{{Session::get('mensaje')}}
			</div>
		@endif
		
		@if(Session::has('mensaje-error'))
			<div class="alert alert-success">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  	{{Session::get('mensaje-error')}}
			</div>
		@endif
				
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
		        <th>Fecha de creación</th>
		        <th >Operaciones</th>
		      </tr>
		    </thead>
		    <tbody>
		    	@foreach($proyectos as $proyecto)
			    	<tr>
						<td>{{$proyecto->nombre_proyecto}}</td>
						<td>{{$proyecto->fecha_creacion_proyecto}}</td>
			        	<td >
			        		<a class="btn btn-sm btn-info" href="{{ url( '/avances/'.$avance->id_avance ) }}"> Detalle</a>
			        	</td>
			        </tr>
				@endforeach
		    </tbody>
		</table>

		<div align="center">{!! $proyectos->render() !!}</div>
	</div>
	
@stop