@extends('layouts.base')

@section('content')
	<div class="container" ng-controller="AvanceController">
		<div ng-init = "avance.id_proyecto =  '{{$id_proyecto}}'"></div>
			
			<h2>Crear avance</h2>
			<form action="{{ url('/mis-proyectos/avances/'.$id_proyecto.'/create') }}" method="POST">		
			<br><br>
			<div class="from-group">
				<label for="">Proyecto </label>
				<select class="form-control" ng-model="avance.id_proyecto" name="id_proyecto" disabled>
					<option class="option" value="">Seleccione un Proyecto</option>
					@foreach($proyectos as $proyecto)
							<option class="option" value="{{$proyecto->id_proyecto}}">
								{{ $proyecto->nombre_proyecto }}
							</option>							
					@endforeach
				</select>
			</div>			
			<br>			
			<div class="from-group">
				<label for="">Asunto </label>
				<input type="text" class="form-control" ng-model="avance.notificacion_avance" name="asunto_avance">
			</div>
			<br>
			<div class="from-group">
				<label for="">Con copia al cliente</label><br>

				<input type="radio" name="check_copia_cliente_avance" ng-model="check" value="1">si
				<input type="radio" name="check_copia_cliente_avance" ng-model="check" value="0" checked="checked">no
			</div>	
			<br>	
			<div class="from-group" ng-if="check==1">
				<label for="">Plantillas </label>
				<select class="form-control" name="id_plantilla" ng-model="id_plantilla">
					<option class="option" value="">Seleccione una plantilla</option>
					@foreach($plantillas as $plantilla)
							<option class="option" value="{{$plantilla->id_plantilla}}">
								{{ $plantilla->nombre_plantilla }}
							</option>							
					@endforeach							
				</select>
				<a class="btn btn-sm btn-success" href="{{ url( '/plantillas' ) }}"> Agregar</a>				
				<a class="btn btn-sm btn-success" ng-if="id_plantilla" href="{{ url( '/plantillas/[[id_plantilla]]' ) }}"> editar</a>
				<a class="btn btn-sm btn-success" ng-if="id_plantilla" target="_blank" href="{{ url( '/plantillas/preview/[[avance.id_proyecto]]/[[id_plantilla]]/' ) }}"> preview</a>
			</div>				
			<br>	


			<div class="from-group">
				<label for="">Descripcion</label>
				<textarea rows="10" cols="50" class="form-control" ng-model="avance.descripcion_avance" name="descripcion_avance">
				</textarea>
			</div>	
			<br>
			
			<button type="submit">
					Registrar
			</button>
		</form>
	</div>
@stop