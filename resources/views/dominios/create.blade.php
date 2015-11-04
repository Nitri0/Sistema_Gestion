@extends('layouts.base')

@section('content')
	<div class="container" ng-controller="DominioController">
	
		@if($dominio)
			<h2>Editar Dominio</h2>
			<div ng-init="dominio={{$dominio}}"></div>
			
			<form action="{{ url('dominios/'.$dominio->id_dominio) }}" method="POST" novalidate>
			<input type="hidden" name="_method" value="PUT">
		@else
			<h2>Crear Dominio</h2>
			<form action="{{ url('dominios/') }}" method="POST" novalidate>
		@endif

			<br><br>

			<div class="from-group">
				<label for="">Proyecto</label>
				<select class="form-control" name="id_proyecto" required>
					<option class="option" value="">Seleccione un proyecto</option>
					@foreach($proyectos as $key)
						<option class="option" value="{{$key->id_proyecto}}"
						@if($proyecto && $proyecto->id_proyecto==$key->id_proyecto) 
							selected 
						@endif >
							{{$key->nombre_proyecto}}</option>
					@endforeach
				</select>
			</div>	
			<br>			
			<div class="from-group">
				<label for="">Empresa proveedora</label>
				<select class="form-control" name="id_empresa_proveedora" @if($dominio) disabled @endif>
					<option class="option" value="">Seleccione una empresa proveedora</option>
					@foreach($empresas_proveedoras as $key)
						<option class="option" value="{{$key->id_empresa_proveedora}}"
						@if($dominio && $dominio->id_empresa_proveedora==$key->id_empresa_proveedora) 
							selected 
						@endif >
							{{$key->nombres_empresa_proveedora}}</option>
					@endforeach
		
				</select>
				<button >
					<a href="{{ url('/empresas_proveedoras/create') }}">Agregar una empresa proveedora</a>
				</button>
			</div>

			<br>
			<div class="from-group">
				<label for="">Nombre Dominio</label>
				<input type="text" class="form-control" ng-model="dominio.nombre_dominio" name="nombre_dominio">
			</div>	
			<br>

			<div class="from-group">
				<label for="">Fecha de creacion de dominio</label>
				<input type="date" class="form-control" ng-value="dominio.fecha_dominio" name="fecha_dominio">
			</div>	

			<button type="submit">
				@if($dominio)
					Actualizar
				@else
					Registrar
				@endif
			</button>
		</form>
	</div>
@stop