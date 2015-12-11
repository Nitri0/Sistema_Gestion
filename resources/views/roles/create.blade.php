@extends('base-admin')

@section('content')


<div id="page-container" class="fade page-sidebar-fixed page-header-fixed"  ng-controller="ClienteController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/roles/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" >
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>
		@if($rol)
	        <h1 class="page-header"><i class="fa fa-laptop"></i> Editar Rol </h1>
	        
	        <div ng-init="model={{ $rol }}"></div>
			<form class="form-horizontal" action="{{ url('roles/'.$rol->id_tipo_rol) }}" method="POST" name="formulario" id="formulario" ng-submit="submit(formulario.$valid)" >
			<input type="hidden" name="_method" value="PUT">
		
		@else
			<h1 class="page-header"><i class="fa fa-laptop"></i> Crear Rol </h1>
			<form class="form-horizontal" action="{{ url('roles/') }}" method="POST" name="formulario" id="formulario" ng-submit="submit(formulario.$valid)">
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

	                    	<blockquote class="f-s-14">
	                           <p>File Upload widget with multiple file selection, drag&amp;drop support, progress bars, validation and preview images, audio and video for jQuery.<br>
	                            Supports cross-domain, chunked and resumable file uploads and client-side image resizing.<br>
	                            Works with any server-side platform (PHP, Python, Ruby on Rails, Java, Node.js, Go etc.) that supports standard HTML form file uploads.</p>
	                        </blockquote>

							<div class="well">

		                    	<div class="form-group">
	                                <label class="col-md-4 control-label">Nombre</label>
	                                <div class="col-md-5">
	                                   <input type="text" class="form-control" ng-model="model.nombre_tipo_rol" name="nombre_tipo_rol" ng-required="true" oninvalid="setCustomValidity(' ')">
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

							</div>

							<center>
                            @if($rol)
								<button type="submit" class="btn btn-danger m-r-5 m-b-5" ng-click="submitted='true'">
									Actualizar <i class="fa fa-undo"></i>
								</button>
							@else
								<button type="submit" class="btn btn-info m-r-5 m-b-5" ng-click="submitted='true'">
									Registrar <i class="fa fa-pencil-square-o"></i>
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