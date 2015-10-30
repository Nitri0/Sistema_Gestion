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
		

			<h2>Crear proyecto web</h2>
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
				<label for="">Dominio</label>
				<select class="form-control" ng-model="proyecto.id_dominio" name="id_dominio" required>
					<option class="option" value="">Seleccione un dominio</option>
					@foreach($dominios as $key)
						<option class="option" value="{{$key->id_dominio}}">
							{{ $key->nombre_dominio }}
						</option>
					@endforeach
				</select>
			</div>	
			<br>
			<div class="from-group">
				<label for="">Grupo de etapas (sprints/pasos/etapas)</label>
				<select class="form-control" ng-model="proyecto.id_grupo_etapas" name="id_grupo_etapas" required>
					<option class="option" value="">Seleccione un grupo</option>
					@foreach($grupo_etapas as $key)
						<option class="option" value="{{$key->id_grupo_etapas}}">
							{{ $key->nombre_grupo_etapas }}
						</option>
					@endforeach
				</select>
			</div>	
			<br>			
			<div class="from-group">
				<label for="">Nombre del proyecto</label>
				<input type="text" class="form-control" name="nombre_proyecto">
			</div>
			<br>
			Grupo de trabajo
			<br>

			<button type="button" ng-click="agregar_integrantes()"> Agregar integrante</button>
			<button type="button" ng-show="cantidad>=1" ng-click="eliminar_integrantes()"> Eliminar integrante</button>
			<input type="hidden" class="form-control" name="cantidad" ng-value="cantidad">
			<div ng-repeat="persona in personas track by $index" >
				<div class="from-group">
					<label for="">Integrante [[$index+1]]</label>
					<select class="form-control" name="id_usuario[[$index]]">
						<option class="option" value="">Seleccione un Usuario</option>
						@foreach($usuarios as $usuario)
							<option class="option" value="{{$usuario->id_usuario}}">
								{{ $usuario->getFullName()}}
							</option>
						@endforeach
					</select>
					<label for="">Rol que cumplirá</label>
					<select class="form-control" name="id_rol[[$index]]">
						<option class="option" value="">Seleccione un Rol</option>
						@foreach($roles as $rol)
							<option class="option" value="{{$rol->id_tipo}}">
								{{ $rol->nombre_tipo }} 
							</option>
						@endforeach
					</select>
					<button >
						<a href="{{ url('/roles') }}">Agregar un rol</a>
					</button>					
				</div>	
			</div>
			<br>
			<br>
			<br>
			<button type="submit">
				Registrar
			</button>
		</form>
	</div>
@stop