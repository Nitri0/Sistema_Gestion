@extends('layouts.base')

@section('content')
	<div class="container" ng-controller="AvanceController">

		@if($avance)
			<h2>Editar Cliente</h2>
			<div ng-init="cliente={{ $avance }}"></div>
			<form action="{{ url('avances/'.$avance->id_avance) }}" method="POST">
			<input type="hidden" name="_method" value="PUT">
		@else
			<h2>Crear avance</h2>
			<form action="{{ url('avances/') }}" method="POST">		
		@endif

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
				@if($avance)
					Actualizar
				@else
					Registrar
				@endif
			</button>
		</form>
	</div>
@stop