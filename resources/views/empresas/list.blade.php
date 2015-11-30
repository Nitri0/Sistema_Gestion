@extends('base-admin')


	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
    

@section('content')
	<div class="container">

		@include('alerts.mensaje_success')
		@include('alerts.mensaje_error')
				
		<div class="row">
			<div class="col-md-8"> <h2>Lista de empresas</h2></div>
			<div class="col-md-4">
				<a class="btn btn-sm btn-success" href="{{ url( '/admin_empresas/create' ) }}"> Agregar</a>
			</div>

		</div>
		<br>
		<br>

		<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>Nombre</th>
		        <th>RIF</th>
		        <th>Email</th>
		        <th >Operaciones</th>
		      </tr>
		    </thead>
		    <tbody>
		    	@foreach($empresas as $model)
			    	<tr>
						<td>{{$model->nombre_empresa}}</td>
						<td>{{$model->rif_empresa}}</td>
			        	<td>{{$model->email_empresa}}</td>
			        	<td >
			        		<a class="btn btn-sm btn-info" href="{{ url( '/admin_empresas/'.$empresa->id_empresa ) }}"> Detalle</a>
			        		<a class="btn btn-sm btn-info" href="{{ url( '/admin_empresas/'.$empresa->id_empresa.'/edit' ) }}"> Editar </a>	
			        	</td>
			        </tr>
				@endforeach
		    </tbody>
		</table>

		<div align="center">{!! $empresas->render() !!}</div>
	</div>
	
@stop