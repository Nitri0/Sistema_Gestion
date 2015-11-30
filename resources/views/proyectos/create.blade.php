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

                        <form class="form-horizontal" action="{{ url('proyectos/') }}" method="POST">	

	                        <div class="well">	
								
								<div class="form-group">
	                                <label class="col-md-4 control-label">Cliente</label>
	                                <div class="col-md-5">
	                                    <select class="form-control js-example-data-array" ng-model="proyecto.id_cliente" name="id_cliente">
	                                        <option value="">Seleccione un cliente</option>
	                                        @foreach($clientes as $cliente)
												<option value="{{$cliente->id_cliente}}">
													{{ $cliente->nombre_cliente }}
												</option>
											@endforeach
	                                    </select>
	                                </div>
	                            </div>

	                            <div class="form-group">
	                                <label class="col-md-4 control-label">Grupo de etapas (sprints/pasos/etapas)</label>
	                                <div class="col-md-5">
	                                    <select class="form-control js-example-data-array" ng-model="proyecto.id_grupo_etapas" name="id_grupo_etapas" required>
	                                        <option value="">Seleccione un grupo</option>
	                                        @foreach($grupo_etapas as $key)
												<option value="{{$key->id_grupo_etapas}}">
													{{ $key->nombre_grupo_etapas }}
												</option>
											@endforeach
	                                    </select>
	                                </div>
	                            </div>

	                            <div class="form-group">
	                                <label class="col-md-4 control-label">Nombre del proyecto</label>
	                                <div class="col-md-5">
	                                   <input type="text" class="form-control" name="nombre_proyecto">
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

								<input type="hidden" class="form-control" name="cantidad" ng-value="cantidad">
								
								<br>
								<div class="row">
									<div class="col-md-6" ng-repeat="persona in personas track by $index">
										<div class="well">
											<div class="form-group">
				                                <label class="col-md-4 control-label">Integrante [[$index+1]]</label>
				                                <div class="col-md-8">
				                                    <select class="form-control js-example-data-array" name="id_usuario[[$index]]">
				                                        <option value="">Seleccione un Usuario</option>
				                                        @foreach($usuarios as $usuario)
															<option value="{{$usuario->id_usuario}}">
																{{ $usuario->getFullName()}}
															</option>
														@endforeach
				                                    </select>
				                                </div>
				                            </div>
				                            <div class="form-group">
				                                <label class="col-md-4 control-label">Rol que cumplirá</label>
				                                <div class="col-md-8">
				                                    <select class="form-control js-example-data-array" name="id_rol[[$index]]">
				                                        <option value="">Seleccione un Rol</option>
				                                        @foreach($roles as $rol)
															<option value="{{$rol->id_tipo}}">
																{{ $rol->nombre_tipo }} 
															</option>
														@endforeach
				                                    </select>
				                                </div>
				                            </div>
											
											<center>
												<a class="btn btn-primary m-r-5 m-b-5" href="{{ url('/roles') }}">Agregar un rol <i class="fa fa-plus"></i></a>
											</center>				
										
										</div>
									</div>
								</div>
								
							</div>

							<center>
								<button class="btn btn-success m-r-5 m-b-5" type="submit">
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