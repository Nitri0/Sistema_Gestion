@extends('layouts.base')

@section('content')
	<div class="container" ng-controller="AvanceController">
			
			<h2>Crear avance</h2>
			<form action="{{ url('/mis-proyectos/avances/'.$id_proyecto.'/create') }}" method="POST">		
			<br><br>
			<div class="from-group">
				<label for="">Proyecto: </label><br>
				<label for="">{{$proyecto->nombre_proyecto}} </label>
				<input type="hidden" class="form-control" name="id_proyecto" ng-value='{{$proyecto->id_proyecto}}'>
			</div>			
			<br>
			<div class="from-group">
				<label for="">Etapa/Sprint/Paso: </label><br>
				<label for="">{{$proyecto->getEstatus()}}</label>
				<input type="hidden" class="form-control" name="id_etapa" ng-value='{{$proyecto->getIdEtapa()}}'>
			</div>			
			<br>
			<div class="from-group">
				<label for="">¿Avance de cierre de etapa?</label><br>

				<input type="radio" name="check_cierre_etapa" value="1">si
				<input type="radio" name="check_cierre_etapa" value="0" checked="checked">no
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
				<a class="btn btn-sm btn-success" ng-if="id_plantilla" target="_blank" href="{{ url( '/plantillas/preview/'.$proyecto->id_proyecto.'/[[id_plantilla]]/' ) }}"> preview</a>
			</div>				
			<br>	


			<div class="from-group">
				<label for="">Descripcion</label>
				<textarea rows="10" cols="50" class="form-control" ng-model="avance.descripcion_avance" name="descripcion_avance">
				</textarea>
			</div>	
				<a class="btn btn-sm btn-success" ng-if="id_plantilla" target="_blank" href="{{ url( '/plantillas/preview-full/[[avance.id_proyecto]]/[[id_plantilla]]/' ) }}"> preview</a>			
			<br>
			
			<button type="submit">
					Registrar
			</button>
		</form>
	</div>
@stop