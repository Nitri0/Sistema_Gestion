@extends('base-admin')

@section('js')
	<script src="{{ asset('/js/controllers/helper.js') }}"></script>
@endsection

@section('content')


<div id="page-container" class="fade page-sidebar-fixed page-header-fixed"  >
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope" ng-controller="SubmitController">
        
		<div ng-init="urlRedirect='{{ url('roles/') }}'"></div>
		@if($rol)
	        <h1 class="page-header">Editar Rol </h1>
	        
	        <div ng-init="model={{ $rol }}"></div>
	        <div ng-init="urlAction='{{ url('roles/'.$rol->id_tipo_rol) }}'"></div>
			<form class="form-horizontal" action="{{ url('roles/'.$rol->id_tipo_rol) }}" method="POST" name="formulario" id="formulario" ng-submit="submit(formulario.$valid)" >
			<input type="hidden" name="_method" value="PUT">
		
		@else
			<div ng-init="urlAction='{{ url('roles/') }}'"></div>
			<h1 class="page-header">Crear Rol </h1>
			<form class="form-horizontal" action="{{ url('roles/') }}" method="POST" name="formulario" id="formulario" >
		@endif

	        <div class="row">
	            <!-- begin col-12 -->
	            <div class="col-12 ui-sortable">
	                <!-- begin panel -->
	                <div class="panel panel-inverse">
	                    <div class="panel-heading-2">
	                        <div class="panel-heading-btn">
	                        	<a href="#ayuda" class="btn btn-ayuda" data-toggle="modal"><i class="fa fa-question"></i></a>
	                        </div>
	                        <h4 class="panel-title">Roles</h4>
	                    </div>

	                    <div class="panel-body">

	                    	<div class="form-group">
                                <label class="col-md-4 control-label">Nombre</label>
                                <div class="col-md-5">
                                   <input type="text" text-only class="form-control" ng-model="model.nombre_tipo_rol" name="nombre_tipo_rol" ng-required="true" oninvalid="setCustomValidity(' ')">
                                    <div class="error campo-requerido" ng-show="formulario.nombre_tipo_rol.$invalid && (formulario.nombre_tipo_rol.$touched || submitted)">
                                        <small class="error" ng-show="formulario.nombre_tipo_rol.$error.required">
                                            * Campo requerido.
                                        </small>
                                    </div>	                                   
                                </div>
                            </div>

	                    	<div class="form-group">
                                <label class="col-md-4 control-label">Descripcion</label>
                                <div class="col-md-5">
                                   <textarea rows="5" class="form-control" ng-model="model.descripcion_tipo_rol" name="descripcion_tipo_rol" ng-required="true" oninvalid="setCustomValidity(' ')"></textarea>
									<div class="error campo-requerido" ng-show="formulario.descripcion_tipo_rol.$invalid && (formulario.descripcion_tipo_rol.$touched || submitted)">
                                        <small class="error" ng-show="formulario.descripcion_tipo_rol.$error.required">
                                            * Campo requerido.
                                        </small>
                                	</div>
                                </div>
                            </div>
                            
							<center>
                            @if($rol)
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

    </div><!-- content -->
	
    @include('modals/ayuda')

</div>

@endsection