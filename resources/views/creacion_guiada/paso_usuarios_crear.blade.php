@extends('base-admin')

@section('js')

	<script src="{{ asset('/js/controllers/helper.js') }}"></script>

	<script src="{{ asset('/thema/admin/html/assets/plugins/switchery/switchery.min.js') }}"></script>
	<script src="{{ asset('/thema/admin/html/assets/js/form-slider-switcher.demo.min.js') }}"></script>

	<script>
		$(document).ready(function() {
			FormSliderSwitcher.init();
		});
	</script>

@endsection

@section('css')
	<link href="{{ asset('/thema/admin/html/assets/plugins/switchery/switchery.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="AdminUsuariosController">
	
	@include('layouts/navbar-admin')

	@include('alerts.mensaje_success')
	@include('alerts.mensaje_error')
	
	<div id="content" class="content content-asistente ng-scope" ng-controller="SubmitController">

		<form class="form-horizontal" action="{{ url('admin_usuarios/') }}" method="POST" name="formulario" id="formulario">
		 
			<div ng-init="urlRedirect='{{ url('asistente/paso3/list') }}'"></div>
        
			<h1 class="page-header"><i class="fa fa-users"></i> Crear Credenciales </h1>

			<div ng-init="urlAction='{{ url('admin_usuarios/') }}'"></div>

			

				@include('alerts.mensaje_success')
				@include('alerts.mensaje_error')	

				<input type="hidden" name="_token" value="{{ csrf_token() }}">

		        <div class="row">

		            <div class="col-md-4 ui-sortable">
		                <div class="panel panel-inverse">
		                    <div class="panel-heading-2">
		                        <h4 class="panel-title"> Usuario</h4>
		                    </div>
		                    <div class="panel-body">	
		                    	
								<div class="form-group">
	                                <label class="col-md-4 control-label">Correo Electronico</label>
	                                <div class="col-md-8">
										<input type="email" class="form-control" name="correo_usuario" ng-model='usuario.correo_usuario' ng-required="true" oninvalid="setCustomValidity(' ')">
	                                	<div class="error campo-requerido" ng-show="formulario.correo_usuario.$invalid && (formulario.correo_usuario.$touched || submitted)">
		                                    <small class="error" ng-show="formulario.correo_usuario.$error.required">
		                                        * Campo requerido.
		                                    </small>
		                                    <small class="error" ng-show="formulario.correo_usuario.$error.email">
		                                    	* Correo inválido correo@ejemplo.com
		                                    </small>
		                            	</div>
	                                </div>
                            	</div>
                            	<div class="form-group">
	                                <label class="col-md-4 control-label">Contraseña</label>
	                                <div class="col-md-8">
										<input type="text" class="form-control" name="password" ng-model='usuario.password' ng-required="true" oninvalid="setCustomValidity(' ')">
										<div class="error campo-requerido" ng-show="formulario.password.$invalid && (formulario.password.$touched || submitted)">
		                                    <small class="error" ng-show="formulario.password.$error.required">
		                                        * Campo requerido.
		                                    </small>
		                            	</div>
	                                </div>
                            	</div>

		                    </div><!-- boby -->
		                </div>
		            </div>
		            <div class="col-md-8 ui-sortable">
		                <!-- begin panel -->
		                <div class="panel panel-inverse">
		                    <div class="panel-heading-2">
		                        <h4 class="panel-title"> Perfil de usuario</h4>
		                    </div>
		                    <div class="panel-body">	
								<div class="form-group">
	                                <label class="col-md-2 control-label">Nombre</label>
	                                <div class="col-md-8">
										<input type="text" text-only class="form-control" ng-model="perfil.nombre_perfil" name="nombre_perfil" ng-required="true" oninvalid="setCustomValidity(' ')">
	                                	<div class="error campo-requerido" ng-show="formulario.nombre_perfil.$invalid && (formulario.nombre_perfil.$touched || submitted)">
		                                    <small class="error" ng-show="formulario.nombre_perfil.$error.required">
		                                        * Campo requerido.
		                                    </small>
		                            	</div>
	                                </div>
                            	</div>
                            	<div class="form-group">
	                                <label class="col-md-2 control-label">Apellido</label>
	                                <div class="col-md-8">
										<input type="text" text-only class="form-control" ng-model="perfil.apellido_perfil" name="apellido_perfil" ng-required="true" oninvalid="setCustomValidity(' ')">
	                                	<div class="error campo-requerido" ng-show="formulario.apellido_perfil.$invalid && (formulario.apellido_perfil.$touched || submitted)">
		                                    <small class="error" ng-show="formulario.apellido_perfil.$error.required">
		                                        * Campo requerido.
		                                    </small>
		                            	</div>
	                                </div>
                            	</div>
                            	<div class="form-group">
	                                <label class="col-md-2 control-label">Cédula</label>
	                                <div class="col-md-8">
										<input type="text" numeric-only class="form-control" ng-model="perfil.cedula_perfil" name="cedula_perfil" ng-required="true" oninvalid="setCustomValidity(' ')">
	                                	<div class="error campo-requerido" ng-show="formulario.cedula_perfil.$invalid && (formulario.cedula_perfil.$touched || submitted)">
		                                    <small class="error" ng-show="formulario.cedula_perfil.$error.required">
		                                        * Campo requerido.
		                                    </small>
		                            	</div>
	                                </div>
                            	</div>
                            	<div class="form-group">
	                                <label class="col-md-2 control-label">Sexo</label>
	                                <div class="col-md-8">
										<select class="form-control js-example-data-array" name="sexo_perfil" ng-model='perfil.sexo_perfil' ng-required="true" oninvalid="setCustomValidity(' ')">
											<option class="option" value="">Seleccione un genero</option>
											<option class="option" value="M" 
 													@if($perfil && $perfil->sexo_perfil == 'Masculino')
														Selected 
													@endif
													 >Masculino</option>
											<option class="option" value="F"
													@if($perfil && $perfil->sexo_perfil == 'Femenino')
														Selected
													@endif >Femenino</option>
											
										</select> 
										<div class="error campo-requerido" ng-show="formulario.sexo_perfil.$invalid && (formulario.sexo_perfil.$touched || submitted)">
		                                    <small class="error" ng-show="formulario.sexo_perfil.$error.required">
		                                        * Campo requerido.
		                                    </small>
		                            	</div>		                            	
	                                </div>
                            	</div>
                            	<div class="form-group">
	                                <label class="col-md-2 control-label">Fecha de nacimiento</label>
	                                <div class="col-md-8">
										<input type="text" id="daterangepicker" class="form-control" ng-model="perfil.telefono_perfil" name="telefono_perfil" ng-required="true" oninvalid="setCustomValidity(' ')">
	                                	<div class="error campo-requerido" ng-show="formulario.telefono_perfil.$invalid && (formulario.telefono_perfil.$touched || submitted)">
		                                    <small class="error" ng-show="formulario.telefono_perfil.$error.required">
		                                        * Campo requerido.
		                                    </small>
		                            	</div>
	                                </div>
                            	</div>
                            	<div class="form-group">
	                                <label class="col-md-2 control-label">Dirección</label>
	                                <div class="col-md-8">
										<textarea rows="5" class="form-control" ng-model="perfil.direccion_perfil" name="direccion_perfil" ng-required="true" oninvalid="setCustomValidity(' ')"></textarea>
	                                	<div class="error campo-requerido" ng-show="formulario.direccion_perfil.$invalid && (formulario.direccion_perfil.$touched || submitted)">
		                                    <small class="error" ng-show="formulario.direccion_perfil.$error.required">
		                                        * Campo requerido.
		                                    </small>
		                            	</div>
	                                </div>
                            	</div>
                            	<div class="form-group">
	                                <label class="col-md-2 control-label">Portal Web</label>
	                                <div class="col-md-8">
										<input type="url" class="form-control" ng-model="perfil.portal_web_perfil" name="portal_web_perfil" >
	                                	<div class="error campo-requerido" ng-show="formulario.portal_web_perfil.$invalid && (formulario.portal_web_perfil.$touched || submitted)">
		                                    <small class="error" ng-show="formulario.portal_web_perfil.$error.required">
		                                        * Campo requerido.
		                                    </small>
		                                    <small class="error" ng-show="formulario.portal_web_perfil.$error.url">
		                                    	* URL inválido http://ejemplo.com
		                                    </small>
		                            	</div>
	                                </div>
                            	</div>
		                    </div><!-- boby -->
		                </div>
		            </div>
		        
		        </div>

		        <div class="row">
					
					<h1 class="page-header"><center><i class="fa fa-unlock-alt"></i><small> Permisos </small></center></h1>

					@foreach($permisos as $nombre_clase=>$metodos)

		            <div class="col-md-6 ui-sortable">
		                <!-- begin panel -->
		                <div class="panel panel-inverse">
		                    <div class="panel-heading-2">
		                    	<div class="panel-heading-btn">                               
	                            </div>
		                        <h4 class="panel-title" style="text-transform: capitalize;"> {{$nombre_clase}}</h4>
		                    </div>
		                    <div class="panel-body">
								<table class="table table-bordered table-condensed m-b-0">
									<tbody>
										@foreach($metodos as $metodo)
										
										<tr>
											<td>
												{{$metodo['metodo_process']}} - {{$metodo['metodo_descripcion']}}
											</td>
											<td>
												[[permisos_user.{{$nombre_clase}}.{{$metodo['metodo_raw']}} ]]
												<input type="checkbox" data-render="switchery" data-theme="blue" name="{{'clases['.$nombre_clase.'.'.$metodo['metodo_raw'].']'}}"
												 ng-model="permisos_user['{{$nombre_clase}}.{{$metodo['metodo_raw']}}']">
											</td>
									
										</tr>
										@endforeach
									</tbody>
                    			</table>
		                    </div><!-- boby -->
		                </div>
		            </div>
		            @endforeach
		        
		        </div>
				
			<!-- Navbar fixed bottom -->
			<div class="navbar navbar-default navbar-fixed-bottom" role="navigation">
			  	<div class="container">
			    	<div class="navbar-header">
			      		<a class="navbar-brand" href="#">Paso 3 Usuarios</a>
			    	</div>
			    	<div class="navbar-collapse">
			      		<!-- Right nav -->
			      		<ul class="nav-siguiente navbar-right">
							<button type="button" ng-click="submit(formulario.$valid)" class="btn btn-success">
								Registrar <span ng-show="snipper===true" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>				
							</button>
			      		</ul>
			    	</div><!--/.nav-collapse -->
			  	</div><!--/.container -->
			</div>

		</form>
        	
	</div>
</div>