@extends('layouts.base')

@section('content')
	<div class="container" ng-controller="PerfilController">

		<h2>Editar perfil</h2>

			<div ng-init="perfil={{ $perfil }}"></div>
			<form action="{{ url('perfil') }}" method="POST">


			<br><br>
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
			<br>
			<button type="submit">
				Actualizar
			</button>
		</form>
	</div>
@stop