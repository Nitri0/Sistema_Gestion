@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="ProyectoController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
        
        <h1 class="page-header"><i class="fa fa-laptop"></i> Crear Proyecto </h1>
        
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-12 ui-sortable">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand" data-original-title="" title=""><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload" data-original-title="" title=""><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse" data-original-title="" title=""><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">Proyectos</h4>
                    </div>

                    <div class="panel-body">

						@include('alerts.mensaje_success')
						@include('alerts.mensaje_error')

						<blockquote class="f-s-14">
                           <p>File Upload widget with multiple file selection, drag&amp;drop support, progress bars, validation and preview images, audio and video for jQuery.<br>
                            Supports cross-domain, chunked and resumable file uploads and client-side image resizing.<br>
                            Works with any server-side platform (PHP, Python, Ruby on Rails, Java, Node.js, Go etc.) that supports standard HTML form file uploads.</p>
                        </blockquote>
						<div ng-init=" urlAction='{{ url('proyectos/') }}'"></div>
                        <form class="form-horizontal" name="formulario" id="formulario" action="[[urlAction]]" method="POST">	

	                        <div class="well" >	
								
								<div class="form-group">
	                                <label class="col-md-4 control-label">Tipo de Proyecto</label>
	                                <div class="col-md-5">
	                                    <select class="form-control js-example-data-array" ng-model="proyecto.id_tipo_proyecto" name="id_tipo_proyecto" ng-required="true" oninvalid="setCustomValidity(' ')">
	                                        <option value="">Seleccione un tipo de proyecto</option>
	                                        @foreach($tipo_proyectos as $tipo_proyecto)
												<option class="option" value="{{$tipo_proyecto->id_tipo_proyecto}}">
													{{ $tipo_proyecto->nombre_tipo_proyecto }}
												</option>
											@endforeach
	                                    </select>
										<div class="error campo-requerido" ng-show="formulario.id_tipo_proyecto.$invalid && (formulario.id_tipo_proyecto.$touched || submitted)">
	                                        <small class="error" ng-show="formulario.id_tipo_proyecto.$error.required">
	                                            * Campo requerido.
	                                        </small>
                                    	</div>	                                    
	                                </div>
	                            </div>

								<div class="form-group">
	                                <label class="col-md-4 control-label">Cliente</label>
	                                <div class="col-md-5">
	                                    <select class="form-control js-example-data-array" ng-model="proyecto.id_cliente" name="id_cliente" ng-required="true" oninvalid="setCustomValidity(' ')">
	                                        <option value="">Seleccione un cliente</option>
	                                        @foreach($clientes as $cliente)
												<option value="{{$cliente->id_cliente}}">
													{{ $cliente->nombre_cliente }}
												</option>
											@endforeach
	                                    </select>
										<div class="error campo-requerido" ng-show="formulario.id_cliente.$invalid && (formulario.id_cliente.$touched || submitted)">
	                                        <small class="error" ng-show="formulario.id_cliente.$error.required">
	                                            * Campo requerido.
	                                        </small>
                                    	</div>
	                                </div>
	                            </div>

	                            <div class="form-group">
	                                <label class="col-md-4 control-label">Grupo de etapas (sprints/pasos/etapas)</label>
	                                <div class="col-md-5">
	                                    <select class="form-control js-example-data-array" ng-model="proyecto.id_grupo_etapas" name="id_grupo_etapas" ng-required="true" oninvalid="setCustomValidity(' ')">
	                                        <option value="">Seleccione un grupo</option>
	                                        @foreach($grupo_etapas as $key)
												<option value="{{$key->id_grupo_etapas}}">
													{{ $key->nombre_grupo_etapas }}
												</option>
											@endforeach
	                                    </select>
										<div class="error campo-requerido" ng-show="formulario.id_grupo_etapas.$invalid && (formulario.id_grupo_etapas.$touched || submitted)">
	                                        <small class="error" ng-show="formulario.id_grupo_etapas.$error.required">
	                                            * Campo requerido.
	                                        </small>
                                    	</div>	                                    
	                                </div>
	                            </div>

	                            <div class="form-group">
	                                <label class="col-md-4 control-label">Nombre del proyecto</label>
	                                <div class="col-md-5">
	                                   <input type="text" text-only class="form-control" name="nombre_proyecto" ng-model="proyecto.nombre_proyecto" ng-required="true" oninvalid="setCustomValidity(' ')">
										<div class="error campo-requerido" ng-show="formulario.nombre_proyecto.$invalid && (formulario.nombre_proyecto.$touched || submitted)">
	                                        <small class="error" ng-show="formulario.nombre_proyecto.$error.required">
	                                            * Campo requerido.
	                                        </small>
                                    	</div>
	                                </div>
	                            </div>

	                        </div>
							
							<div class="well">
								<center><h5 class="m-t-0">Grupo de trabajo</h5></center>

								<center>
									<button type="button" class="btn btn-success m-r-5 m-b-5" ng-click="agregar_integrantes()"> 
										Agregar integrante <i class="fa fa-plus"></i>
									</button>
									<button type="button" class="btn btn-danger m-r-5 m-b-5" ng-show="cantidad>=1" ng-click="eliminar_integrantes()"> 
										Eliminar integrante <i class="fa fa-trash-o"></i>
									</button>
								</center>
								<div class="error" ng-show="cantidad==0 && submitted">
									<br>
                                    <center>
	                                    <small class="error" ng-show="cantidad==0" >
		                                        * Debe agregar por lo menos un integrante
	                                    </small>
                                    </center>
                            	</div>
								<input type="hidden" class="form-control"  name="cantidad" ng-model="cantidad" ng-value="cantidad" ng-hidden="true" ng-required="cantidad==0">
								
								<br>
								<div class="row">
									<div class="col-md-6" ng-repeat="persona in personas track by $index">
										<div class="well">
											<div class="form-group">
				                                <label class="col-md-4 control-label">Integrante [[$index+1]]</label>
				                                <div class="col-md-8">
				                                    <select class="form-control js-example-data-array" name="id_usuario[[$index]]" ng-model="persona.usuario" ng-required="true" oninvalid="setCustomValidity(' ')">
				                                        <option value="">Seleccione un Usuario</option>
				                                        @foreach($usuarios as $usuario)
															<option value="{{$usuario->id_usuario}}">
																{{ $usuario->fullName()}}
															</option>
														@endforeach
				                                    </select>
													<div class="error campo-requerido" ng-show="formulario.id_usuario[[$index]].$invalid && (formulario.id_usuario[[$index]].$touched || submitted)">
				                                        <small class="error" ng-show="formulario.id_usuario[[$index]].$error.required">
				                                            * Campo requerido.
				                                        </small>
			                                    	</div>				                                    
				                                </div>
				                            </div>
				                            <div class="form-group">
				                                <label class="col-md-4 control-label">Rol que cumplirá</label>
				                                <div class="col-md-8">
				                                    <select class="form-control js-example-data-array" name="id_rol[[$index]]" ng-model="persona.rol" ng-required="true" oninvalid="setCustomValidity(' ')">
				                                        <option value="">Seleccione un Rol</option>
				                                        @foreach($roles as $rol)
															<option value="{{$rol->id_tipo_rol}}">
																{{ $rol->nombre_tipo_rol }}
															</option>
														@endforeach
				                                    </select>
													<div class="error campo-requerido" ng-show="formulario.id_rol[[$index]].$invalid && (formulario.id_rol[[$index]].$touched || submitted)">
				                                        <small class="error" ng-show="formulario.id_rol[[$index]].$error.required">
				                                            * Campo requerido.
				                                        </small>
			                                    	</div>						                                    
				                                </div>
				                            </div>
														
										
										</div>
									</div>
								</div>
								
							</div>

							<center>
								<button class="btn btn-success m-r-5 m-b-5" type="button" ng-click="submit(formulario.$valid)">
									Registrar <i class="fa fa-pencil-square-o"></i>
								</button>
							</center>
								
						</form>

					</div><!-- boby -->
                </div>
            </div>
        </div>

    </div><!-- content -->
	
</div>
@endsection
