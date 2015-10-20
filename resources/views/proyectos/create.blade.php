@extends('layouts.base')

@section('content')
	<div class="container" ng-controller="ProyectoController">

			<h2>Crear proyecto</h2>
			<form action="{{ url('proyectos/') }}" method="POST">		

			<br><br>
			<div class="from-group">
				<label for="">Cliente</label>
				<select class="form-control" ng-model="avance.id_cliente" name="id_cliente">
					<option class="option" value="">Seleccione un cliente</option>
					@foreach($clientes as $cliente)
						<option class="option" value="{{$cliente->id_cliente}}">
							{{ $cliente->nombre_cliente }}
						</option>;
					@endforeach
				</select>
				<button >
					<a href="{{ url('/clientes/create') }}">Agregar un cliente</a>
				</button>
			</div>			
			<br>
			<div class="from-group">
				<label for="">Dominio</label>
				<select class="form-control" name="id_dominio">
					<option class="option" value="">Seleccione un dominio</option>
					@foreach($dominios as $dominio)
						<option class="option" value="{{$dominio->id_dominio}}">
							{{ $dominio->nombre_dominio }}
						</option>;
					@endforeach
				</select>
				<button >
					<a href="{{ url('/dominios/create') }}">Agregar un Dominio</a>
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
				<select class="form-control" name="id_dominio">
					<option class="option" value="">Seleccione una persona</option>
						<option class="option" value="1">
							usuario 1
						</option>;

				</select>
				<label for="">rol que cumplirá</label>
				<select class="form-control" name="id_dominio">
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