@extends('layouts.base')


@section('content')
	<div class="container">

		@include('alerts.mensaje_success')
		@include('alerts.mensaje_error')
				
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
		        <th>Contacto</th>
		        <th>Proyecto(s) Asociado(s)</th>
		        <th >Operaciones</th>
		      </tr>
		    </thead>
		    <tbody>
		    	@foreach($clientes as $cliente)
			    	<tr>
						<td>{{$cliente->nombre_cliente}}</td>
						<td>{{$cliente->ci_rif_cliente}}</td>
			        	<td>{{$cliente->email_cliente}}</td>
			        	<td>{{$cliente->persona_contacto_cliente}}</td>
			        	<td>
			        			{{$cliente->getProyecto()}}
			        	</td>
			        	<td >
			        		<a class="btn btn-sm btn-info" href="{{ url( '/clientes/'.$cliente->id_cliente ) }}"> Detalle</a>
			        		<a class="btn btn-sm btn-info" href="{{ url( '/clientes/'.$cliente->id_cliente.'/edit' ) }}"> Editar </a>
								<form action="/clientes/{{$cliente->id_cliente}}" method="post">
									<input type="hidden" name="_method" value="delete">
									<button type="submit" class="btn btn-sm btn-danger" >Eliminar</button>
								</form>		        		
			        	</td>
			        </tr>
				@endforeach
		    </tbody>
		</table>

		<div align="center">{!! $clientes->render() !!}</div>
	</div>
	
@stop