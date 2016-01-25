@extends('base-admin')

@section('js')
	<script src="{{ asset('/js/controllers/helper.js') }}"></script>
	<script src="{{ asset('/js/controllers/empresa_proveedora.js') }}"></script>
@endsection

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="ProveedorController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')

    @include('modals/ayuda')
	
	<div id="content" class="content ng-scope" ng-controller="SubmitController">
        
        <div ng-init="urlRedirect='{{ url('empresas_proveedoras/') }}'"></div>

        @if($empresa_proveedora)
        
        <h1 class="page-header">Editar Empresa Proveedora </h1>
        <div ng-init="empresa_proveedora={{ $empresa_proveedora }}"></div>
        <div ng-init="urlAction='{{ url('empresas_proveedoras/'.$empresa_proveedora->id_empresa_proveedora) }}'"></div>
        <form class="form-horizontal" action="{{ url('empresas_proveedoras/'.$empresa_proveedora->id_empresa_proveedora) }}" method="POST" name="formulario" id="formulario">
        <input type="hidden" name="_method" value="PUT">
        @else
   		
   		<div ng-init="urlAction='{{ url('empresas_proveedoras/') }}'"></div>
   		<h1 class="page-header">Crear Empresa Proveedora </h1>
   		<form class="form-horizontal" action="{{ url('empresas_proveedoras/') }}" method="POST" name="formulario" id="formulario">	
       	
       	@endif

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
	                        <h4 class="panel-title">Empresa Proveedora</h4>
	                    </div>

	                    <div class="panel-body">

		                    <div class="form-group">
	                            <label class="col-md-4 control-label">Nombres de empresa proveedora</label>
	                            <div class="col-md-5">
	                                <input type="text" text-num-only class="form-control" ng-model="empresa_proveedora.nombres_empresa_proveedora" name="nombres_empresa_proveedora" ng-required="true" oninvalid="setCustomValidity(' ')">
	                            	<div class="error campo-requerido" ng-show="formulario.nombres_empresa_proveedora.$invalid && (formulario.nombres_empresa_proveedora.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.nombres_empresa_proveedora.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                            	</div>	
	                            </div>
	                        </div>	

	                        <div class="form-group">
	                            <label class="col-md-4 control-label">Teléfono de empresa proveedora</label>
	                            <div class="col-md-5">
	                                <input type="text" telef placeholder="+582128610000" class="form-control" ng-model="empresa_proveedora.telefono_empresa_proveedora" name="telefono_empresa_proveedora" ng-required="true" oninvalid="setCustomValidity(' ')">
	                            	<div class="error campo-requerido" ng-show="formulario.telefono_empresa_proveedora.$invalid && (formulario.telefono_empresa_proveedora.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.telefono_empresa_proveedora.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                            	</div>	
	                            </div>
	                        </div>	

							<br>

							<div class="btn-ayuda">
								<a href="#ayuda" class="btn btn-sm btn-info" data-toggle="modal">
									<i class="fa fa-question"></i>
								</a>
							</div>

							<center>
							@if($empresa_proveedora)
								<button ng-click="submit(formulario.$valid)" class="btn btn-success m-r-5 m-b-5" type="button"> 
									Actualizar <span ng-show="snipper===true" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>
								</button>
							@else
								<button ng-click="submit(formulario.$valid)" class="btn btn-success m-r-5 m-b-5" type="button"> 
									Registrar <span ng-show="snipper===true" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>
								</button>
							@endif
							</center>
				

						</div><!-- boby -->
	                </div>
	            </div>
	        </div>
		</form>
    </div><!-- content -->
	
</div>
@endsection
