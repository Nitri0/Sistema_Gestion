@extends('layouts.base')

@section('content')
	<div class="container">

		<h2>Crear Rol de trabajadores</h2>
			<form action="{{ url('roles') }}" method="POST">

			<br><br>
			<div class="from-group">
				<label for="">Nombre de rol</label>
				<input type="text" class="form-control" ng-model="rol.nombre_rol" name="nombre_tipo">
			</div>
			<br>
			<button type="submit">
				Registrar
			</button>
		</form>
	</div>
@stop