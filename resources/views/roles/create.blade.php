@extends('base-admin')

@section('js')
	<script src="{{ asset('/js/controllers/helper.js') }}"></script>
@endsection

@section('content')


<div id="page-container" class="fade page-sidebar-fixed page-header-fixed"  >
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')

    @include('modals/ayuda')
	
	<div id="content" class="content ng-scope" ng-controller="SubmitController">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/roles/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" >
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>
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
	                    <div class="panel-heading">
	                        <div class="panel-heading-btn">
	                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand" data-original-title="" title=""><i class="fa fa-expand"></i></a>
	                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload" data-original-title="" title=""><i class="fa fa-repeat"></i></a>
	                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse" data-original-title="" title=""><i class="fa fa-minus"></i></a>
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
                                   <input type="text" class="form-control" ng-model="model.descripcion_tipo_rol" name="descripcion_tipo_rol" ng-required="true" oninvalid="setCustomValidity(' ')">
									<div class="error campo-requerido" ng-show="formulario.descripcion_tipo_rol.$invalid && (formulario.descripcion_tipo_rol.$touched || submitted)">
                                        <small class="error" ng-show="formulario.descripcion_tipo_rol.$error.required">
                                            * Campo requerido.
                                        </small>
                                	</div>
                                </div>
                            </div>

                            <div class="btn-ayuda">
                                <a href="#ayuda" class="btn btn-sm btn-info" data-toggle="modal">
                                    <i class="fa fa-question"></i>
                                </a>
                            </div>
                            
							<center>
                            @if($rol)
								<button class="btn btn-success m-r-5 m-b-5" type="button" ng-click="submit(formulario.$valid)">
									Actualizar
								</button>
							@else
								<button class="btn btn-success m-r-5 m-b-5" type="button" ng-click="submit(formulario.$valid)">
									Registrar
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