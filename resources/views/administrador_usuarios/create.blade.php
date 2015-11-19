@extends('layouts.base')

@section('content')
<div class="container-fluid" ng-controller="AdminUsuariosController">
	<div class="row">

		<div class="col-md-8 col-md-offset-2">
			@include('alerts.mensaje_success')
			@include('alerts.mensaje_error')			
			<div class="panel panel-default">


				@if($usuario)
					<div class="panel-heading">Editar Credenciales</div>
					<div ng-init="usuario={{$usuario}}"></div>
					<div ng-init="perfil={{$perfil}}"></div>
					<div ng-init="permisos_user={{$permisos_user}}"></div>
					<div ng-init="print(permisos_user)"></div>
					
						<form class="form-horizontal" action="{{ url('admin_usuarios/'.$usuario->id_usuario) }}" method="POST" novalidate>
							<input type="hidden" name="_method" value="PUT">
				@else
					<div class="panel-heading">Crear Credenciales</div>				
						<form class="form-horizontal" action="{{ url('admin_usuarios/') }}" method="POST" novalidate>

				@endif
					<div class="panel-body">								
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="correo_usuario" ng-model='usuario.correo_usuario'>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="password">
							</div>
						</div>						

						<div class="form-group">
							<label class="col-md-4 control-label">Tipo de Usuario</label>
							<div class="col-md-6">
								<select class="form-control"  name="id_permisologia">
									@foreach($tipos_usuario as $nombre=>$tipo)
										<option class="option" value="{{$tipo}}" 
											@if($usuario && $tipo == $usuario->id_permisologia)
												Selected
											@endif

										>{{$nombre}}</option>
									@endforeach
								</select>
							</div>
						</div>


					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Perfil de usuario</div>	
					<div class="panel-body">
						<div class="from-group">
							<label for="">Nombre</label>
							<input type="text" class="form-control" ng-model="perfil.nombre_perfil" name="nombre_perfil">
						</div>
						<br>
						<div class="from-group">
							<label for="">Apellido</label>
							<input type="text" class="form-control" ng-model="perfil.apellido_perfil" name="apellido_perfil">
						</div>	
						<br>
						<div class="from-group">
							<label for="">Cédula</label>
							<input type="text" class="form-control" ng-model="perfil.cedula_perfil" name="cedula_perfil">
						</div>	
						<br>
						<div class="from-group">
							<label for="">Sexo</label>
							<input type="text" class="form-control" ng-model="perfil.sexo_perfil" name="sexo_perfil">
						</div>			
						<br>
						<div class="from-group">
							<label for="">Fecha de nacimiento</label>
							<input type="date" class="form-control" ng-model="perfil.telefono_perfil" name="telefono_perfil">
						</div>
						<br>
						<div class="from-group">
							<label for="">Direccion</label>
							<input type="text" class="form-control" ng-model="perfil.direccion_perfil" name="direccion_perfil">
						</div>	
						<br>
						<div class="from-group">
							<label for="">Portal Web</label>
							<input type="textarea" class="form-control" ng-model="perfil.portal_web_perfil" name="portal_web_perfil">
						</div>

					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-heading">Permisos (solo aplican para socios)</div>	
					<div class="panel-body">
						@foreach($permisos as $nombre_clase=>$metodos)
							<label ><h4> {{$nombre_clase}}</h4></label >
								
								@foreach($metodos as $metodo)
									<div class="form-group content-row">
										<label class="col-md-4 col-md-offset-1 control-label">{{$metodo}}</label>
										<div class="col-md-6">
											[[permisos_user.{{$nombre_clase}}.{{$metodo}} ]]
											<input type="checkbox" class="form-control" name="{{'clases['.$nombre_clase.'.'.$metodo.']'}}"
													 ng-model="permisos_user['{{$nombre_clase}}.{{$metodo}}']">
										</div>
									</div>

								@endforeach
							<br><br>
						@endforeach
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									@if($usuario)
										Editar
									@else
										Register
									@endif									
								</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
