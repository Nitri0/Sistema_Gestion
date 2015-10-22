@extends('layouts.base')

@section('content')
	<div class="container" ng-controller="AvanceController">

			<h2>Crear avance</h2>
			<form action="{{ url('avances/') }}" method="POST">		
			<br><br>
			<div class="from-group">
				<label for="">Proyecto</label>
				<select class="form-control" ng-model="avance.id_cliente" name="id_cliente">
					<option class="option" value="">Seleccione un Proyecto</option>
					@foreach($proyectos as $proyecto)
						<option class="option" value="{{$proyecto->id_proyecto}}">
							{{ $proyecto->nombre_proyecto }}
						</option>;
					@endforeach
				</select>
				<button >
					<a href="{{ url('/clientes/create') }}">Agregar un cliente</a>
				</button>
			</div>			
			<br>			
			<div class="from-group">
				<label for="">Notificacion</label>
				<input type="text" class="form-control" ng-model="avance.notificacion_avance" name="notificacion_avance">
			</div>
			<br>
			<div class="from-group">
				<label for="">Descripcion</label>
				<input type="text" class="form-control" ng-model="avance.descripcion_avance" name="descripcion_avance">
			</div>	
			<br>
			
			<button type="submit">
					Registrar
			</button>
		</form>
	</div>
@stop