@extends('layouts.base')

@section('content')
	<div class="container" ng-controller="ProyectoController">

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
		

			<h2>Crear proyecto</h2>
			<form action="{{ url('proyectos/') }}" method="POST">		

			<br><br>
			<div class="from-group">
				<label for="">Cliente</label>
				<select class="form-control" ng-model="proyecto.id_cliente" name="id_cliente">
					<option class="option" value="">Seleccione un cliente</option>
					@foreach($clientes as $cliente)
						<option class="option" value="{{$cliente->id_cliente}}">
							{{ $cliente->nombre_cliente }}
						</option>
					@endforeach
				</select>
				<button >
					<a href="{{ url('/clientes/create') }}">Agregar un cliente</a>
				</button>
			</div>			
			<br>
			<div class="from-group">
				<label for="">Cliente</label>
				<select class="form-control" ng-model="proyecto.id_dominio" name="id_dominio">
					<option class="option" value="">Seleccione un dominio</option>
					@foreach($dominios as $key)
						<option class="option" value="{{$key->id_dominio}}">
							{{ $key->nombre_dominio }}
						</option>
					@endforeach
				</select>
				<button >
					<a href="{{ url('/clientes/create') }}">Agregar un cliente</a>
				</button>
			</div>	
			<br>
			<div class="from-group">
				<label for="">Nombre del proyecto</label>
				<input type="text" class="form-control" name="nombre_proyecto">
			</div>
			<br>
			grupo de trabajo
			<br>
			<div class="from-group">
				<label for="">Persona</label>
				<select class="form-control" name="id_usuario">
					<option class="option" value="">Seleccione una persona</option>
						<option class="option" value="1">
							usuario 1
						</option>;

				</select>
				<label for="">rol que cumplirá</label>
				<select class="form-control" name="rol">
					<option class="option" value="">Seleccione un rol</option>
						<option class="option" value="1">
							rol 1
						</option>
				</select>
			</div>	

			<button type="submit">
					Registrar
			</button>
		</form>
	</div>
@stop