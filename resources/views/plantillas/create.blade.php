@extends('base-admin')

@section('js')
	<script src="{{ asset('/bower_components/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope" ng-controller="PlantillasController">
		@if($plantillas)
        
        <h1 class="page-header"><i class="fa fa-file-code-o"></i> Editar plantilla</h1>
        <div ng-init="plantilla={{$plantillas}}"></div>
		<form class="form-horizontal" action="{{ url('/plantillas/'.$plantillas->id_plantilla) }}" method="POST">
		<input type="hidden" name="_method" value="PUT">
        
        @else
		
		<h1 class="page-header"><i class="fa fa-file-code-o"></i> Crear plantilla</h1>
        <form class="form-horizontal" action="{{ url('/plantillas/') }}" method="POST">

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
	                        <h4 class="panel-title">Plantillas</h4>
	                    </div>

	                    <div class="panel-body">

	                    	<div class="well">

			                    <div class="form-group">
		                            <label class="col-md-4 control-label">Nombre Plantilla </label>
		                            <div class="col-md-5">
										<input type="text" class="form-control" ng-model="plantilla.nombre_plantilla" name="nombre_plantilla">
		                            </div>
		                        </div>

		                        <div class="form-group">
		                            <label class="col-md-4 control-label">Descripcion </label>
		                            <div class="col-md-5">
										<textarea rows="5" class="form-control" ng-model="plantilla.descripcion_plantilla" name="descripcion_plantilla">
										</textarea>
		                            </div>
		                        </div>

		                        <!--<div class="form-group">
		                        	<div class="col-md-2">Data con formato html</div>
		                            <div class="col-md-8">
										<textarea rows="20" class="form-control" ng-model="plantilla.raw_data_plantilla" name="raw_data_plantilla">
										</textarea>
		                            </div>
		                        </div>-->

		                    </div>
								
						</div><!-- boby -->
	                </div>
	            </div>

	            <center><a href="#modal-etiquetas" class="btn btn-sm btn-success" data-toggle="modal"><i class="fa fa-file-code-o"></i> Etiquetas de plantilla</a></center>
	            @include('modals/modal-etiquetas')
	            <br>

	            <div class="col-md-12">
                    <div class="panel panel-inverse" data-sortable-id="form-wysiwyg-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                            <h4 class="panel-title">Data del Correo</h4>
                        </div>
                        <div class="panel-body panel-form">
							<textarea class="ckeditor" id="editor1" rows="30" ng-model="plantilla.raw_data_plantilla" name="raw_data_plantilla">
							
							</textarea>
                        </div>
                    </div>
                </div>

	        </div>

	        <center>
				@if($plantillas)
				<button type="submit" class="btn btn-danger m-r-5 m-b-5">Actualizar <i class="fa fa-refresh"></i></button>
				@else
				<button type="submit" class="btn btn-success m-r-5 m-b-5">Registrar <i class="fa fa-pencil-square-o"></i></button>
				@endif
			</center>
        </form>

    </div><!-- content -->
	
</div>
@endsection