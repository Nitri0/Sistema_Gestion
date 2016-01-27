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

        <h1 class="page-header">Editar perfil de empresa </h1>
        
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-12 ui-sortable">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading-2">
                        <div class="panel-heading-btn">
                        	
                        </div>
                        <h4 class="panel-title">Editar</h4>
                    </div>

                    <div class="panel-body">
                        <div ng-init="urlRedirect='{{ url('mis-proyectos/') }}'"></div>
                        <div ng-init="urlAction='{{ url('perfil-empresa') }}'"></div>
						<div ng-init="model={{ $empresa }}"></div>
						<form class="form-horizontal" action="{{ url('perfil-empresa') }}" name="formulario" id="formulario" method="POST">
								
	                    	<div class="form-group">
	                            <label class="col-md-4 control-label">Nombre de empresa</label>
	                            <div class="col-md-5">
	                            	<input type="text" text-num-only class="form-control" ng-model="model.nombre_empresa" name="nombre_empresa" ng-required="true" oninvalid="setCustomValidity(' ')">
									<div class="error campo-requerido" ng-show="formulario.nombre_empresa.$invalid && (formulario.nombre_empresa.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.nombre_empresa.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                            	</div>		                            	
	                            </div>                            
	                        </div>
	                        <div class="form-group">
	                            <label class="col-md-4 control-label">Identificador de empresa</label>
	                            <div class="col-md-5">
	                            	<input type="text" ng-remote-validate="{{url('/valididentificador')}}" ng-pattern="/^[A-Z]*[0-9]*$/"  ng-required="true" class="form-control" ng-model="model.rif_empresa" name="rif_empresa" >
	                            	<div class="error campo-requerido" ng-show="formulario.rif_empresa.$invalid && (formulario.rif_empresa.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.rif_empresa.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                                    <small class="error" ng-show="formulario.rif_empresa.$error.pattern">
	                                        * Formato de identificador inválido. Solo debe introducir mayusculas y números. Ejemplo: J123456789.
	                                    </small>
	                                    <small class="error" ng-show="formulario.rif_empresa.$error.ngRemoteValidate">
	                                        * Identificador ya esta siendo usado en el sistema, utilice otro o contacte a soporte técnico (contacto@keygestion.com.ve).
	                                    </small>		                                    
	                            	</div>
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <label class="col-md-4 control-label">Teléfono</label>
	                            <div class="col-md-5">
	                            	<input type="text" telef placeholder="+582128610000" class="form-control" ng-model="model.telefono_empresa" name="telefono_empresa" ng-required="true" oninvalid="setCustomValidity(' ')">
 									<div class="error campo-requerido" ng-show="formulario.telefono_empresa.$invalid && (formulario.telefono_empresa.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.telefono_empresa.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                            	</div>			                            	
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <label class="col-md-4 control-label">Dirección</label>
	                            <div class="col-md-5">
	                            	<textarea rows="5" class="form-control" ng-model="model.direccion_empresa" name="direccion_empresa" ng-required="true" oninvalid="setCustomValidity(' ')"></textarea>
									<div class="error campo-requerido" ng-show="formulario.direccion_empresa.$invalid && (formulario.direccion_empresa.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.direccion_empresa.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                            	</div>			                            	
	                            </div>
	                        </div>
							<br>
							<center>
								<button type="button" class="btn btn-success m-r-5 m-b-5" ng-click="submit(formulario.$valid)">
									Actualizar <span ng-show="snipper===true" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>
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