@extends('layouts.base')

@section('content')
	<div class="container" ng-controller="PlantillasController">

		<h2>Crear plantilla</h2>
			@if($plantillas)
				<div ng-init="plantilla={{$plantillas}}"></div>
				<form action="{{ url('/plantillas/'.$plantillas->id_plantilla) }}" method="POST">
				<input type="hidden" name="_method" value="PUT">	
			@else
				<form action="{{ url('/plantillas/') }}" method="POST">		
			@endif
			<br><br>
		
			<div class="from-group">
				<label for="">Nombre Plantilla </label>
				<input type="text" class="form-control" ng-model="plantilla.nombre_plantilla" name="nombre_plantilla">
			</div>
			<br>
			<div class="from-group">
				<label for="">Descripcion</label>
				<textarea rows="5" class="form-control" ng-model="plantilla.descripcion_plantilla" name="descripcion_plantilla">
				</textarea>
			</div>	
			<br>
			<div class="from-group">
				<label for="">Data con formato html</label><br>
				<textarea rows="10" class="form-control" ng-model="plantilla.raw_data_plantilla" name="raw_data_plantilla">
				</textarea>
			</div>	
			<br>	
			Etiquetas de data del cliente: <br><br>
			$cliente->nombre_cliente <br>
			$cliente->email_cliente <br>
			$cliente->persona_contacto_cliente <br>
			$cliente->telefono_cliente <br>
			$cliente->telefono_2_cliente <br>
			$cliente->direccion_cliente <br>	
			<br>	<br>
			Etiquetas de data del proyecto: <br><br>
			$proyecto->nombre_proyecto <br>
			<br>	<br>
			<strong>Para colocar la data es necesario usar doble {{}} y dentro colocar la variable que se desea imprimir<br>
			ejemplo: {{ $cliente->nombre_cliente } } (sin espacios) </strong><br><br>

			<strong>P.D: no olvidar colocar la etiqueta { !! $data !! } (sin espacios) en el lugar donde estará la data que se llenará automaticamente al crear un avance</strong><br><br><br>
			<button type="submit">
					Registrar
			</button>
		</form>
	</div>
@stop