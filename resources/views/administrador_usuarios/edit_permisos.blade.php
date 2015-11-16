@extends('layouts.base')

@section('content')
	<div class="container" ng-controller="AdminUsuariosController">
			
			<h2>Editar Permisos</h2>
			<form action="{{ url('/admin_usuarios/'.$id_usuario.'/permisos') }}" method="POST">		
			<br><br>
	
			<div class="from-group">
				<label for="">prueba </label>
				<input type="text" class="form-control" ng-model="" name="">
			</div>
			<br>
						
			<br>
			
			<button type="submit">
					Registrar
			</button>
		</form>
	</div>
@stop