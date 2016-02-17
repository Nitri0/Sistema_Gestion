@extends('base-admin')

@section('js')
	<script src="{{ asset('/bower_components/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="ActividadController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope" >

		<div ng-init="urlRedirect='{{ url('actividades/') }}'"></div>
		@if($actividades)
        
        <h1 class="page-header">Editar actividad</h1>
        <div ng-init="actividad={{$actividades}}"></div>

        <div ng-init="urlAction='{{ url('actividades/'.$actividades->id_actividad) }}'"></div>
		<form class="form-horizontal" action="{{ url('/actividades/'.$actividades->id_actividad) }}" method="POST" name="formulario" id="formulario" >

		<input type="hidden" name="_method" value="PUT">
        
        @else
		<div ng-init="urlAction='{{ url('actividades/') }}'"></div>
		<h1 class="page-header">Crear actividad</h1>
        <form class="form-horizontal" action="{{ url('/actividades/') }}" method="POST" name="formulario" id="formulario">
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
	                        <h4 class="panel-title">actividad</h4>
	                    </div>

	                    <div class="panel-body">

	                    	<div class="well">

			                    <div class="form-group">
		                            <label class="col-md-4 control-label">Nombre actividad </label>
		                            <div class="col-md-5">
										<input type="text" text-num-only class="form-control" ng-model="actividad.nombre_actividad" name="nombre_actividad" ng-required="true" oninvalid="setCustomValidity(' ')">

										<div class="error campo-requerido" ng-show="formulario.nombre_actividad.$invalid && (formulario.nombre_actividad.$touched || submitted)">
		                                    <small class="error" ng-show="formulario.nombre_actividad.$error.required">
		                                        * Campo requerido.
		                                    </small>
		                            	</div>	
		                            </div>
		                        </div>

		                        <div class="form-group">
		                            <label class="col-md-4 control-label">Descripcion </label>
		                            <div class="col-md-5">
										<textarea rows="5" class="form-control" ng-model="actividad.descripcion_actividad" name="descripcion_actividad" ng-required="true" oninvalid="setCustomValidity(' ')">
										</textarea>

										<div class="error campo-requerido" ng-show="formulario.descripcion_actividad.$invalid && (formulario.descripcion_actividad.$touched || submitted)">
		                                    <small class="error" ng-show="formulario.descripcion_actividad.$error.required">
		                                        * Campo requerido.
		                                    </small>
		                            	</div>		
		                            </div>
		                        </div>
		                        <div class="form-group">
		                            <label class="col-md-4 control-label">fecha estamada de fin</label>
		                            <div class="col-md-5">
										<input type="date" text-num-only class="form-control" ng-model="actividad.fecha_aproximada_entrega_actividad" name="fecha_aproximada_entrega_actividad">

										<div class="error campo-requerido" ng-show="formulario.descripcion_actividad.$invalid && (formulario.descripcion_actividad.$touched || submitted)">
		                                    <small class="error" ng-show="formulario.descripcion_actividad.$error.required">
		                                        * Campo requerido.
		                                    </small>
		                            	</div>		
		                            </div>
		                        </div>-->

		                        <!--<div class="form-group">
		                        	<div class="col-md-2">Data con formato html</div>
		                            <div class="col-md-8">
										<textarea rows="20" class="form-control" ng-model="actividad.raw_data_actividad" name="raw_data_actividad">
										</textarea>
		                            </div>
		                        </div>

		                    </div>
								
						</div><!-- boby -->
	                </div>
	            </div>
           

	        </div>

	        <center>
				@if($actividades)
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
	
</div>
@endsection