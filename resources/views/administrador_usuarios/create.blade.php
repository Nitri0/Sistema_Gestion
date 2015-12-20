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

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope" ng-controller="SubmitController">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/admin_usuarios/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Agregar Usuario">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>

        <div ng-init="urlRedirect='{{ url('admin_usuarios/') }}'"></div>
        
		@if($usuario)
	        <h1 class="page-header"><i class="fa fa-users"></i> Editar Credenciales </h1>

	        <div ng-init="usuario={{$usuario}}"></div>
			<div ng-init="perfil={{$perfil}}"></div>
			<div ng-init="permisos_user={{$permisos_user}}"></div>
			
			<div ng-init="print(permisos_user)"></div>
			<div ng-init="urlAction='{{ url('admin_usuarios/'.$usuario->id_usuario) }}'"></div>

			<form class="form-horizontal" action="{{ url('admin_usuarios/'.$usuario->id_usuario) }}" method="POST"  name="formulario" id="formulario">
				<input type="hidden" name="_method" value="PUT">
		@else
			<h1 class="page-header"><i class="fa fa-users"></i> Crear Credenciales </h1>

			<div ng-init="urlAction='{{ url('admin_usuarios/') }}'"></div>

			<form class="form-horizontal" action="{{ url('admin_usuarios/') }}" method="POST" name="formulario" id="formulario">

		@endif


				@include('alerts.mensaje_success')
				@include('alerts.mensaje_error')	

				<input type="hidden" name="_token" value="{{ csrf_token() }}">

		        <div class="row">

		            <div class="col-md-4 ui-sortable">
		                <!-- begin panel -->
		                <div class="panel panel-inverse">
		                    <div class="panel-heading">
		                        <h4 class="panel-title"><i class="fa fa-user"></i> Usuario</h4>
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
                            	<div class="form-group">
	                                <label class="col-md-4 control-label">Tipo de Usuario</label>
	                                <div class="col-md-8">
										<select class="form-control js-example-data-array" name="id_permisologia" ng-model='usuario.id_permisologia' ng-required="true" oninvalid="setCustomValidity(' ')">
											@foreach($tipos_usuario as $nombre=>$tipo)
												<option class="option" value="{{$tipo}}" 
													@if($usuario && $tipo == $usuario->id_permisologia)
														Selected
													@endif

												>{{$nombre}}</option>
											@endforeach
										</select>
										<div class="error campo-requerido" ng-show="formulario.id_permisologia.$invalid && (formulario.id_permisologia.$touched || submitted)">
		                                    <small class="error" ng-show="formulario.id_permisologia.$error.required">
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
		                    <div class="panel-heading">
		                        <h4 class="panel-title"><i class="fa fa-user"></i> Perfil de usuario</h4>
		                    </div>
		                    <div class="panel-body">	
								<div class="form-group">
	                                <label class="col-md-2 control-label">Nombre</label>
	                                <div class="col-md-8">
										<input type="text" class="form-control" ng-model="perfil.nombre_perfil" name="nombre_perfil" ng-required="true" oninvalid="setCustomValidity(' ')">
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
										<input type="text" class="form-control" ng-model="perfil.apellido_perfil" name="apellido_perfil" ng-required="true" oninvalid="setCustomValidity(' ')">
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
										<input type="text" class="form-control" ng-model="perfil.sexo_perfil" name="sexo_perfil" ng-required="true" oninvalid="setCustomValidity(' ')">
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
										<input type="date" class="form-control" ng-value="perfil.telefono_perfil" name="telefono_perfil" ng-required="true" oninvalid="setCustomValidity(' ')">
	                                	<div class="error campo-requerido" ng-show="formulario.telefono_perfil.$invalid && (formulario.telefono_perfil.$touched || submitted)">
		                                    <small class="error" ng-show="formulario.telefono_perfil.$error.required">
		                                        * Campo requerido.
		                                    </small>
		                            	</div>
	                                </div>
                            	</div>
                            	<div class="form-group">
	                                <label class="col-md-2 control-label">Direccion</label>
	                                <div class="col-md-8">
										<input type="text" class="form-control" ng-model="perfil.direccion_perfil" name="direccion_perfil" ng-required="true" oninvalid="setCustomValidity(' ')">
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
										<input type="url" class="form-control" ng-model="perfil.portal_web_perfil" name="portal_web_perfil" ng-required="true" oninvalid="setCustomValidity(' ')">
	                                	<div class="error campo-requerido" ng-show="formulario.portal_web_perfil.$invalid && (formulario.portal_web_perfil.$touched || submitted)">
		                                    <small class="error" ng-show="formulario.portal_web_perfil.$error.required">
		                                        * Campo requerido.
		                                    </small>
		                                    <small class="error" ng-show="formulario.portal_web_perfil.$error.url">
		                                    	* Correo inválido http://ejemplo.com
		                                    </small>
		                            	</div>
	                                </div>
                            	</div>
		                    </div><!-- boby -->
		                </div>
		            </div>
		        
		        </div>

		        <div class="row">
					
					<h1 class="page-header"><center><i class="fa fa-unlock-alt"></i><small> Permisos (solo aplican para socios)</small></center></h1>

					@foreach($permisos as $nombre_clase=>$metodos)

		            <div class="col-md-6 ui-sortable">
		                <!-- begin panel -->
		                <div class="panel panel-inverse">
		                    <div class="panel-heading">
		                    	<div class="panel-heading-btn">
	                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand" data-original-title="" title=""><i class="fa fa-expand"></i></a>
	                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse" data-original-title="" title=""><i class="fa fa-minus"></i></a>
	                            </div>
		                        <h4 class="panel-title" style="text-transform: capitalize;"><i class="fa fa-unlock-alt"></i> {{$nombre_clase}}</h4>
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
				
				<br>
				<center>
				@if($usuario)
			        <button type="button" ng-click="submit(formulario.$valid)" class="btn btn-primary">
						Editar <i class="fa fa-pencil-square-o"></i>						
					</button>
				@else
					<button type="button" ng-click="submit(formulario.$valid)" class="btn btn-success">
						Registrar <i class="fa fa-pencil-square-o"></i>						
					</button>
				@endif	
				</center>
				<br>

        	</form>

    </div><!-- content -->
	
</div>
@endsection