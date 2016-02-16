@extends('base-admin')

@section('js')
	<script src="{{ asset('/js/controllers/helper.js') }}"></script>
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
			<div ng-init="setSelectAll({{$permisos_user}})"></div>
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
										<input type="email" ng-remote-validate="{{url('/admin_usuarios/validUser/')}}"
										 class="form-control" name="correo_usuario" ng-model='usuario.correo_usuario' ng-required="true" oninvalid="setCustomValidity(' ')">
	                                	<div class="error campo-requerido" ng-show="formulario.correo_usuario.$invalid && (formulario.correo_usuario.$touched || submitted)">
		                                    <small class="error" ng-show="formulario.correo_usuario.$error.required">
		                                        * Campo requerido.
		                                    </small>
		                                    <small class="error" ng-show="formulario.correo_usuario.$error.email">
		                                    	* Correo inválido correo@ejemplo.com
		                                    </small>
		                                    <small class="error" ng-show="formulario.correo_usuario.$error.ngRemoteValidate">
		                                        * Correo ya registrado, utilice otro.
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
				        				<switch class="blue" name="{{$metodos[0]['nombre_metodo']}}"
			        							ng-model="selects.{{$metodos[0]['nombre_metodo']}}" ng-change="selectAll('{{$metodos[0]['nombre_metodo']}}', selects.{{$metodos[0]['nombre_metodo']}})"></switch>
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
														<switch class="blue" name="{{'clases['.$metodo['nombre_metodo'].'.'.$metodo['metodo_raw'].']'}}"
														 ng-model="permisos_user['{{$metodo['nombre_metodo']}}.{{$metodo['metodo_raw']}}']"></switch>
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