@extends('base-admin')

@section('js')
	<script src="{{ asset('/js/controllers/helper.js') }}"></script>
@endsection

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="PerfilController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope" ng-controller="SubmitController">
        
        <!--<ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url('mis-publicidades/agregar-publicidad')}}" class="btn btn-white btn-sm p-l-20 p-r-20">
                        <i class="fa fa-plus-square"></i>
                    </a>
                </div>
                <div class="btn-group">
                    <a href="{{ url('mis-publicidades/listar')}}" class="btn btn-white btn-sm p-l-20 p-r-20">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                </div>
            </div>
        </ol>-->

        <h1 class="page-header">Editar perfil </h1>
        
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
                        <h4 class="panel-title">Editar</h4>
                    </div>

                    <div class="panel-body">
                        <div ng-init="urlRedirect='{{ url('mis-proyectos/') }}'"></div>
						<div ng-init="perfil={{ $perfil }}"></div>
                        <div ng-init="urlAction='{{ url('perfil') }}'"></div>
						<form class="form-horizontal" action="{{ url('perfil') }}" name="formulario" id="formulario" method="POST">
								
							<div class="form-group">
                                <label class="col-md-4 control-label">Nombre</label>
                                <div class="col-md-5">
                                    <input type="text" text-only class="form-control" ng-model="perfil.nombre_perfil" name="nombre_perfil" ng-required="true" oninvalid="setCustomValidity(' ')">
                                	<div class="error campo-requerido" ng-show="formulario.nombre_perfil.$invalid && (formulario.nombre_perfil.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.nombre_perfil.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                            	</div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Apellido</label>
                                <div class="col-md-5">
                                    <input type="text" text-only class="form-control" ng-model="perfil.apellido_perfil" name="apellido_perfil" ng-required="true" oninvalid="setCustomValidity(' ')">
                                	<div class="error campo-requerido" ng-show="formulario.apellido_perfil.$invalid && (formulario.apellido_perfil.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.apellido_perfil.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                            	</div>	
                                </div>                           
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Identifición de usuario</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" ng-model="perfil.cedula_perfil" name="cedula_perfil" ng-required="true" oninvalid="setCustomValidity(' ')">
                                	<div class="error campo-requerido" ng-show="formulario.cedula_perfil.$invalid && (formulario.cedula_perfil.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.cedula_perfil.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                            	</div>
                                </div>	                                
                            </div>

                        	<div class="form-group">
                                <label class="col-md-4 control-label">Sexo</label>
                                <div class="col-md-5">
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
                                <label class="col-md-4 control-label">Fecha de nacimiento</label>
                                <div class="col-md-5">
                                	<input type="date" class="form-control" ng-value="perfil.fecha_nacimiento_perfil" name="fecha_nacimiento_perfil" ng-required="true" oninvalid="setCustomValidity(' ')">
	                                <div class="error campo-requerido" ng-show="formulario.fecha_nacimiento_perfil.$invalid && (formulario.fecha_nacimiento_perfil.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.fecha_nacimiento_perfil.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                            	</div>
                                </div>                              
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Dirección</label>
                                <div class="col-md-5">
                                    <input type="textarea" class="form-control" ng-model="perfil.direccion_perfil" name="direccion_perfil" ng-required="true" oninvalid="setCustomValidity(' ')">
                                	<div class="error campo-requerido" ng-show="formulario.direccion_perfil.$invalid && (formulario.direccion_perfil.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.direccion_perfil.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                            	</div>
                                </div>                                	                                
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Portal Web</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" ng-model="perfil.portal_web_perfil" name="portal_web_perfil">
                                </div>	                                
                            </div>
		
							<br>
							<center>
								<button type="button" class="btn btn-success m-r-5 m-b-5" ng-click="submit(formulario.$valid)">
									Actualizar <i class="fa fa-undo"></i>
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