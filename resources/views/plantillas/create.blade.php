@extends('layouts.base')

@section('content')
	<div class="container" ng-controller="PlantillasController">

		<h2>Crear plantilla</h2>
			@if($plantillas)
				<div ng-init="plantilla={{$plantillas}}"></div>
				<form action="{{ url('/plantillas/'.$plantillas->id_plantilla) }}" method="POST">		
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
			data del cliente: <br>
			$cliente->nombre_cliente  $cliente->email_cliente   $cliente->persona_contacto_cliente   $cliente->telefono_cliente    $cliente->direccion_cliente <br>	<br>	
			data del proyecto: <br>
			$proyecto->nombre_proyecto <br><br>	
			para colocar la data es necesario usar doble {{}} y dentro colocar la variable que se desea imprimir<br>
			{{ $cliente->nombre_cliente } } <br>

			<srong>no olvidar colocar la etiqueta { { $data}} en el lugar donde estará la data que se llenará automaticamente al crear un avance</srong><br><br><br>
			<button type="submit">
					Registrar
			</button>
		</form>
	</div>
@stop