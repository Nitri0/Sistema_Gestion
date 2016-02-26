@extends('base-admin')

@section('js')
	<script src="{{ asset('/bower_components/ckeditor/ckeditor.js') }}"></script>
	<script src="{{ asset('/js/controllers/plantilla.js') }}"></script>
@endsection

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="PlantillasController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope" >

		<div ng-init="urlRedirect='{{ url('plantillas/') }}'"></div>
		@if($plantillas)
        
        <h1 class="page-header">Editar plantilla</h1>
        <div ng-init="plantilla={{$plantillas}}"></div>

        <div ng-init="urlAction='{{ url('plantillas/'.$plantillas->id_plantilla) }}'"></div>
		<form class="form-horizontal" action="{{ url('/plantillas/'.$plantillas->id_plantilla) }}" method="POST" name="formulario" id="formulario" >

		<input type="hidden" name="_method" value="PUT">
        
        @else
		<div ng-init="urlAction='{{ url('plantillas/') }}'"></div>
		<h1 class="page-header">Crear plantilla</h1>
        <form class="form-horizontal" action="{{ url('/plantillas/') }}" method="POST" name="formulario" id="formulario">
        @endif
        
	        <div class="row">
	            <!-- begin col-12 -->
	            <div class="col-12 ui-sortable">
	                <!-- begin panel -->
	                <div class="panel panel-inverse">
	                    <div class="panel-heading-2">
	                        <div class="panel-heading-btn">
	                        	<!--<a href="#plantilla-ayuda" class="btn btn-ayuda" data-toggle="modal"><i class="fa fa-question"></i></a>-->
	                        </div>
	                        <h4 class="panel-title">Plantillas</h4>
	                    </div>

	                    <div class="panel-body">

		                    <div class="form-group">
	                            <label class="col-md-4 control-label">Nombre Plantilla </label>
	                            <div class="col-md-5">
									<input type="text" text-num-only class="form-control" ng-model="plantilla.nombre_plantilla" name="nombre_plantilla" ng-required="true" oninvalid="setCustomValidity(' ')">

									<div class="error campo-requerido" ng-show="formulario.nombre_plantilla.$invalid && (formulario.nombre_plantilla.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.nombre_plantilla.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                            	</div>	
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <label class="col-md-4 control-label">Descripcion </label>
	                            <div class="col-md-5">
									<textarea rows="5" class="form-control" ng-model="plantilla.descripcion_plantilla" name="descripcion_plantilla" ng-required="true" oninvalid="setCustomValidity(' ')">
									</textarea>

									<div class="error campo-requerido" ng-show="formulario.descripcion_plantilla.$invalid && (formulario.descripcion_plantilla.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.descripcion_plantilla.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                            	</div>		
	                            </div>
	                        </div>

	                        <!--<div class="form-group">
	                        	<div class="col-md-2">Data con formato html</div>
	                            <div class="col-md-8">
									<textarea rows="20" class="form-control" ng-model="plantilla.raw_data_plantilla" name="raw_data_plantilla">
									</textarea>
	                            </div>
	                        </div>-->

						</div><!-- boby -->
	                </div>
	            </div>

	            <center><a href="#modal-etiquetas" class="btn btn-sm btn-success" data-toggle="modal"><i class="fa fa-file-code-o"></i> Etiquetas de plantilla</a></center>
	            @include('modals/modal-etiquetas')
	            <br>

	            <div class="col-md-12">
                    <div class="panel panel-inverse" data-sortable-id="form-wysiwyg-1">
                        <div class="panel-heading-2">
                            <div class="panel-heading-btn">
                            	
                            </div>
                            <h4 class="panel-title">Data del Correo</h4>
                        </div>
                        
                        <div class="panel-body panel-form">

							<textarea class="ckeditor" ck-editor id="editor1" rows="30" ng-model="plantilla.raw_data_plantilla" name="raw_data_plantilla" ng-required="true" oninvalid="setCustomValidity(' ')">
							</textarea>	

                        </div>
                    	<div class="error campo-requerido" ng-show="formulario.raw_data_plantilla.$invalid && (formulario.raw_data_plantilla.$touched || submitted)">
                            <small class="error" ng-show="formulario.raw_data_plantilla.$error.required">
                                * Campo requerido.
                            </small>
                    	</div>	
                    </div>
                </div>

	        </div>

	        <center>
				@if($plantillas)
				<button type="button" ng-click="submit(formulario.$valid)" class="btn btn-success m-r-5 m-b-5">
					Actualizar <span ng-show="snipper===true" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>
				</button>
				@else
				<button type="button" ng-click="submit(formulario.$valid)" class="btn btn-success m-r-5 m-b-5">
					Registrar <span ng-show="snipper===true" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>
				</button>
				@endif
			</center>
        </form>

    </div><!-- content -->

    @include('modals/ayudas/plantilla')
	
</div>
@endsection