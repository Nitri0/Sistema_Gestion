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
			<div class="col-md-8"><h2>Lista de Dominios</h2></div>
			<div class="col-md-4">
				<a class="btn btn-sm btn-success" href="{{ url( '/dominios/create' ) }}">Agregar</a>
				<a class="btn btn-sm btn-success" href="{{ url( '/dominios/updateData' ) }}">Actualizar</a>
			</div>

		</div>
		<br>


		<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>Nombre Dominio</th>
		        <th>Proyecto asignado</th>
		        <th>Proveedor</th>
		        <th>Cliente</th>
		        <th>Fecha creación</th>
		        <th>Espacio usado</th>
		        <th >Operaciones</th>
		      </tr>
		    </thead>
		    <tbody>
		    	@foreach($dominios as $dominio)
			    	<tr>
						<td>{{$dominio->nombre_dominio}}</td>
						<td>{{$dominio->getNombreProyecto()}}</td>
						<td>{{$dominio->empresaProveedora()}}</td>
						<td>{{$dominio->getNombreCliente()}}</td>
						<td>{{$dominio->fecha_dominio}}</td>
						<td>{{$dominio->espacio_usado_dominio}}</td>
			        	<td >
			        		<div class="row">
			        		<a class="btn btn-sm btn-info" href="{{ url( '/dominios/'.$dominio->id_dominio.'/edit' ) }}">Editar</a>
			        		<a class="btn btn-sm btn-info" href="{{ url( '/dominios/'.$dominio->id_dominio) }}">Gestionar</a>
							<form action="/dominios/{{$dominio->id_dominio}}" method="post">
								<input type="hidden" name="_method" value="delete">
								<button type="submit" class="btn btn-sm btn-danger" >Eliminar</a>
							</form>
							</div>
			        	</td>
			        </tr>
				@endforeach
		    </tbody>
		</table>
		{!! $dominios->render() !!}
	</div>
	
@stop