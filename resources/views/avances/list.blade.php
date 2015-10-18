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
			<div class="col-md-8"> <h2>Lista de avances</h2></div>
			<div class="col-md-4">
				<a class="btn btn-sm btn-success" href="{{ url( '/avances/create' ) }}"> Agregar</a>
			</div>

		</div>
		<br>
		<br>

		<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>Cliente</th>
		        <th>Fecha de creación</th>
		        <th >Operaciones</th>
		      </tr>
		    </thead>
		    <tbody>
		    	@foreach($avances as $avance)
			    	<tr>
						<td>{{$avance->nombre_cliente()}}</td>
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