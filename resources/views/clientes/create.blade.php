@extends('base-admin')

@section('js')
	<script src="{{ asset('/js/controllers/helper.js') }}"></script>
	<script src="{{ asset('/js/controllers/cliente.js') }}"></script>
@endsection

@section('content')


<div id="page-container" class="fade page-sidebar-fixed page-header-fixed"  ng-controller="ClienteController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')

    @include('alerts.mensaje_success')
	@include('alerts.mensaje_error')
	
	<div id="content" class="content ng-scope" ng-controller="SubmitController">
        
        <div ng-init="urlRedirect='{{ url('clientes/') }}'"></div>
		@if($cliente)
        <h1 class="page-header"> Editar Cliente </h1>
        <div ng-init="cliente={{ $cliente }}"></div>
        <div ng-init="urlAction='{{ url('clientes/'.$cliente->id_cliente) }}'"></div>
		<form class="form-horizontal" action="{{ url('clientes/'.$cliente->id_cliente) }}" method="POST" name="formulario" id="formulario">
		<input type="hidden" name="_method" value="PUT">
		
		@else
		<div ng-init="urlAction='{{ url('clientes/') }}'"></div>
		<h1 class="page-header"> Crear Cliente </h1>
		<form class="form-horizontal" action="{{ url('clientes/') }}" method="POST" name="formulario" id="formulario">
		@endif

	        <div class="row">
	            <!-- begin col-12 -->
	            <div class="col-12 ui-sortable">
	                <!-- begin panel -->
	                <div class="panel panel-inverse">
	                    <div class="panel-heading-2">
	                        <div class="panel-heading-btn">
	                            <!--<a href="#cliente-ayuda" class="btn btn-ayuda" data-toggle="modal"><i class="fa fa-question"></i></a>-->
	                        </div>
	                        <h4 class="panel-title">Clientes</h4>
	                    </div>

	                    <div class="panel-body">

	                    	<br>

	                    	<div class="form-group">
                                <label class="col-md-4 control-label">Nombre de cliente</label>
                                <div class="col-md-5">
                                   <input type="text" text-only class="form-control" ng-model="cliente.nombre_cliente" name="nombre_cliente" ng-required="true" oninvalid="setCustomValidity(' ')">
									<div class="error campo-requerido" ng-show="formulario.nombre_cliente.$invalid && (formulario.nombre_cliente.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.nombre_cliente.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                            	</div>	                                   
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Persona de contacto</label>
                                <div class="col-md-5">
                                   <input type="text" text-only class="form-control" ng-model="cliente.persona_contacto_cliente" name="persona_contacto_cliente" ng-required="true" oninvalid="setCustomValidity(' ')">
									<div class="error campo-requerido" ng-show="formulario.persona_contacto_cliente.$invalid && (formulario.persona_contacto_cliente.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.persona_contacto_cliente.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                            	</div>	                                   
                                </div>
                            </div>

	                        <div class="form-group">
	                            <label class="col-md-4 control-label">Identificador de cliente (rif, cedula, etc)</label>
	                            <div class="col-md-5">
	                            	<input type="text" ng-remote-validate="{{url('/clientes/valididentificador')}}" ng-pattern="/^[A-Z]*[0-9]*$/" ng-required="true" class="form-control" ng-model="cliente.ci_rif_cliente" name="ci_rif_cliente" >
	                            	<div class="error campo-requerido" ng-show="formulario.ci_rif_cliente.$invalid && (formulario.ci_rif_cliente.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.ci_rif_cliente.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                                    <small class="error" ng-show="formulario.ci_rif_cliente.$error.pattern">
	                                        * Formato de identificador inválido. Solo debe introducir mayúsculas y números. Ejemplo: J123456789.
	                                    </small>	                                    
	                                    <small class="error" ng-show="formulario.ci_rif_cliente.$error.ngRemoteValidate">
	                                        * Identificador en uso.
	                                    </small>		                                    
	                            	</div>
	                            </div>
	                        </div>
		                        
                            <div class="form-group">
                                <label class="col-md-4 control-label">Correo</label>
                                <div class="col-md-5">
                                   	<input type="email" class="form-control" ng-model="cliente.email_cliente" name="email_cliente" ng-required="true" oninvalid="setCustomValidity(' ')">
									<div class="error campo-requerido" ng-show="formulario.email_cliente.$invalid && (formulario.email_cliente.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.email_cliente.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                                    <small class="error" ng-show="formulario.email_cliente.$error.email">
	                                    	* Correo inválido correo@ejemplo.com
	                                    </small>
	                            	</div>	                                   
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Teléfono 1</label>
                                <div class="col-md-5">
                                   	<input type="text" telef placeholder="+582128610000" class="form-control" ng-model="cliente.telefono_cliente" name="telefono_cliente" ng-required="true" oninvalid="setCustomValidity(' ')">
									<div class="error campo-requerido" ng-show="formulario.telefono_cliente.$invalid && (formulario.telefono_cliente.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.telefono_cliente.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                            	</div>	                                   
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Teléfono 2</label>
                                <div class="col-md-5">
                                   	<input type="text" telef placeholder="+582128612233" class="form-control" ng-model="cliente.telefono_2_cliente" name="telefono_2_cliente">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Dirección</label>
                                <div class="col-md-5">
                                   <textarea rows="5" class="form-control" ng-model="cliente.direccion_cliente" name="direccion_cliente" ng-required="true" oninvalid="setCustomValidity(' ')"></textarea>
									<div class="error campo-requerido" ng-show="formulario.direccion_cliente.$invalid && (formulario.direccion_cliente.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.direccion_cliente.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                            	</div>	                                   
                                </div>
                            </div>

                            <br>
				           
							<center>
                            @if($cliente)
								<button class="btn btn-success m-r-5 m-b-5" type="button" ng-click="submit(formulario.$valid)">
									Actualizar <span ng-show="snipper===true" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>
								</button>
							@else
								<button class="btn btn-success m-r-5 m-b-5" type="button" ng-click="submit(formulario.$valid)">
									Registrar <span ng-show="snipper===true" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>
								</button>
							@endif
							</center>
			
						</div><!-- boby -->
	                </div>
	            </div>
	        </div>

        </form>
	
	@include('modals/ayudas/clientes')

    </div><!-- content -->
	
</div>

@endsection