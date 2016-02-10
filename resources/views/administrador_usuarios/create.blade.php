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

        <div ng-init="urlRedirect='{{ url('admin_usuarios/') }}'"></div>
        
		@if($usuario)
	        <h1 class="page-header"> Editar Usuario </h1>

	        <div ng-init="usuario={{$usuario}}"></div>
			<div ng-init="perfil={{$perfil}}"></div>
			<div ng-init="permisos_user={{$permisos_user}}"></div>
			<div ng-init="urlAction='{{ url('admin_usuarios/'.$usuario->id_usuario) }}'"></div>

			<form class="form-horizontal" action="{{ url('admin_usuarios/'.$usuario->id_usuario) }}" method="POST"  name="formulario" id="formulario">
				<input type="hidden" name="_method" value="PUT">
		@else
			<h1 class="page-header"><i class="fa fa-users"></i> Crear Usuario </h1>

			<div ng-init="urlAction='{{ url('admin_usuarios/') }}'"></div>

			<form class="form-horizontal" action="{{ url('admin_usuarios/') }}" method="POST" name="formulario" id="formulario">

		@endif


				@include('alerts.mensaje_success')
				@include('alerts.mensaje_error')	

				<input type="hidden" name="_token" value="{{ csrf_token() }}">

		        <div class="row">
					@if(!$usuario)
		            <div class="col-md-12 ui-sortable">
		                <!-- begin panel -->
		                <div class="panel panel-inverse">
		                    <div class="panel-heading-2">
		                        <h4 class="panel-title">Credenciales de usuario</h4>
		                    </div>
		                    <div class="panel-body">	
		                    	
								<div class="form-group">
	                                <label class="col-md-4 control-label">Correo electrónico</label>
	                                <div class="col-md-5">
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
	                                <div class="col-md-5">
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
		            @endif
		        
		        </div>

				<div class="row">

					<h1 class="page-header"><center><i class="fa fa-unlock-alt"></i><small> Permisos </small></center></h1>

				    <div class="col-md-12">
				        <div class="panel-group" id="accordion">
				        @foreach($permisos as $nombre_clase=>$metodos)
				            <div class="panel panel-inverse overflow-hidden custon-list">
				                <div class="panel-heading-2">
				                    <h3 class="panel-title list-title">
				                        <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#{{$metodos[0]['nombre_metodo']}}">
				                            <i class="fa fa-plus pull-right"></i> 
				                        </a>	
				                    </h3>
				                    <div class="box-button-list">
				        				<input type="checkbox" data-theme="default" name="{{$metodos[0]['nombre_metodo']}}"
			        							ng-model="{{$metodos[0]['nombre_metodo']}}" ng-click="selectAll({{$metodos[0]['nombre_metodo']}},'{{$metodos[0]['nombre_metodo']}}')">
				        			</div>
				                    <h3 class="panel-title list-title">
				                    	<div class="row">
				                    		<div class="col-sm-8"> 
				                    			<div class="row">
				                    				<div class="col-sm-9 text-ellipsis">
				                            			{{$nombre_clase}}
				                            		</div>
				                    			</div>
				                    		</div>
				                    	</div>                           	 
				                    </h3>
				                </div>
				                <div id="{{$metodos[0]['nombre_metodo']}}" class="panel-collapse collapse">
				                    <div class="panel-body">
										<table class="table table-bordered table-condensed m-b-0">
											<tbody>
												@foreach($metodos as $metodo)
												
												<tr>
													<td>
														{{$metodo['metodo_process']}} - {{$metodo['metodo_descripcion']}}
													</td>
													<td width="30">
														[[permisos_user.{{$metodo['nombre_metodo']}}.{{$metodo['metodo_raw']}} ]]
														<input type="checkbox" data-render="switchery" data-theme="blue" name="{{'clases['.$metodo['nombre_metodo'].'.'.$metodo['metodo_raw'].']'}}"
														 ng-model="permisos_user['{{$metodo['nombre_metodo']}}.{{$metodo['metodo_raw']}}']">
													</td>
											
												</tr>
												@endforeach
											</tbody>
		                    			</table>
				                    </div>
				                </div>
				            </div>
				        @endforeach
				        </div>
					</div>
		       	</div>
				
				<br>
				<center>
				@if($usuario)
			        <button type="button" ng-click="submit(formulario.$valid)" class="btn btn-success">
						Actualizar <span ng-show="snipper===true" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>					
					</button>
				@else
					<button type="button" ng-click="submit(formulario.$valid)" class="btn btn-success">
						Registrar <span ng-show="snipper===true" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>				
					</button>
				@endif	
				</center>
				<br>

        	</form>

    </div><!-- content -->
	
</div>
@endsection