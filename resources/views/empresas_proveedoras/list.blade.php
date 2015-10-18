@extends('layouts.base')

@section('content')
	<div class="container">
		@if(Session::has('mensaje'))
			<div class="alert alert-success">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  	strong{{Session::get('mensaje')}}
			</div>
		@endif
		
		@if(Session::has('mensaje-error'))
			<div class="alert alert-success">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  	{{Session::get('mensaje-error')}}
			</div>
		@endif

		<div class="row">
			<div class="col-md-8">
				<h2>Lista de Empresas Proveedoras</h2>
			</div>
			<div class="col-md-4">
				<a class="btn btn-sm btn-success" href="{{ url( '/empresas_proveedoras/create' ) }}">Agregar</a>
			</div>

		</div>
		<br>


		<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>Nombre Proveedor</th>
		        <th>Telefono</th>
		        <th >Operaciones</th>
		      </tr>
		    </thead>
		    <tbody>
		    	@foreach($empresas_proveedoras as $empresa_proveedora)
			    	<tr>
						<td>{{$empresa_proveedora->nombres_empresa_proveedora}}</td>
						<td>{{$empresa_proveedora->telefono_empresa_proveedora}}</td>
			        	<td >
							<a class="btn btn-sm btn-info" href="{{ url( '/empresas_proveedoras/'.$empresa_proveedora->id_empresa_proveedora ) }}"> Detalle</a>		        		
			        		<a class="btn btn-sm btn-info" href="{{ url( '/empresas_proveedoras/'.$empresa_proveedora->id_empresa_proveedora.'/edit' ) }}"> Editar</a>
			        	</td>
			        </tr>
				@endforeach
		    </tbody>
		</table>

		{!! $empresas_proveedoras->render() !!}
	</div>
	
@stop