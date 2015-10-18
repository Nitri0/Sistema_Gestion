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
			<div class="col-md-8"> <h2>Lista de clientes</h2></div>
			<div class="col-md-4">
				<a class="btn btn-sm btn-success" href="{{ url( '/clientes/create' ) }}"> Agregar</a>
			</div>

		</div>
		<br>
		<br>

		<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>Nombre</th>
		        <th>CI / RIF</th>
		        <th>Email</th>
		        <th >Operaciones</th>
		      </tr>
		    </thead>
		    <tbody>
		    	@foreach($clientes as $cliente)
			    	<tr>
						<td>{{$cliente->nombre_cliente}}</td>
						<td>{{$cliente->ci_rif_cliente}}</td>
			        	<td>{{$cliente->email_cliente}}</td>
			        	<td >
			        		<a class="btn btn-sm btn-info" href="{{ url( '/clientes/'.$cliente->id_cliente ) }}"> Detalle</a>
			        		<a class="btn btn-sm btn-info" href="{{ url( '/clientes/'.$cliente->id_cliente.'/edit' ) }}"> Editar </a>
			        	</td>
			        </tr>
				@endforeach
		    </tbody>
		</table>

		<div align="center">{!! $clientes->render() !!}</div>
	</div>
	
@stop