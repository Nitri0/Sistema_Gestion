@extends('base-admin')

@section('content')


<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="DominioController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
		
		@if($dominio)
        <h1 class="page-header"><i class="fa fa-link"></i> Editar Dominio </h1>
        
        <div ng-init="dominio={{$dominio}}"></div>
			
		<form class="form-horizontal" action="{{ url('dominios/'.$dominio->id_dominio) }}" method="POST" novalidate>
		<input type="hidden" name="_method" value="PUT">
		@else
		<h1 class="page-header"><i class="fa fa-link"></i> Crear Dominio </h1>
		<form class="form-horizontal" action="{{ url('dominios/') }}" method="POST" novalidate>
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
	                        <h4 class="panel-title">Dominio</h4>
	                    </div>

	                    <div class="panel-body">

	                    	<blockquote class="f-s-14">
	                           <p>File Upload widget with multiple file selection, drag&amp;drop support, progress bars, validation and preview images, audio and video for jQuery.<br>
	                            Supports cross-domain, chunked and resumable file uploads and client-side image resizing.<br>
	                            Works with any server-side platform (PHP, Python, Ruby on Rails, Java, Node.js, Go etc.) that supports standard HTML form file uploads.</p>
	                        </blockquote>

	                    	<div class="well">

								@if($proyecto)
									<label>Proyecto:</label>
									<label>{{$proyecto->nombre_proyecto}} - {{$proyecto->getCliente()->nombre_cliente}}</label>
								@else

		                    	<div class="form-group">
		                            <label class="col-md-4 control-label">Proyecto</label>
		                            <div class="col-md-5">
							            <select class="form-control js-example-data-array" name="id_proyecto" required>
											<option class="option" value="">Seleccione un proyecto</option>
											@foreach($proyectos as $key)
												<option class="option" value="{{$key->id_proyecto}}">
													{{$key->nombre_proyecto}} - {{$key->getCliente()->nombre_cliente}}</option>
											@endforeach
										</select>
		                            </div>
		                        </div>

		                        @endif

		                        <div class="form-group">
		                            <label class="col-md-4 control-label">Empresa proveedora</label>
		                            <div class="col-md-5">
		                                <select class="form-control js-example-data-array" name="id_empresa_proveedora">
											<option class="option" value="">Seleccione una empresa proveedora</option>
											@foreach($empresas_proveedoras as $key)
												<option class="option" value="{{$key->id_empresa_proveedora}}"
												@if($dominio && $dominio->id_empresa_proveedora==$key->id_empresa_proveedora) 
													selected 
												@endif >
													{{$key->nombres_empresa_proveedora}}</option>
											@endforeach
										</select>
		                            </div>
		                        </div>

		                        <div class="form-group">
		                            <label class="col-md-4 control-label">Nombre dominio</label>
		                            <div class="col-md-5">
		                                <input type="text" class="form-control" ng-model="dominio.nombre_dominio" name="nombre_dominio">
		                            </div>
		                        </div>

		                        <div class="form-group">
		                            <label class="col-md-4 control-label">Espacio de disco asignado</label>
		                            <div class="col-md-5">
		                             	<select class="form-control js-example-data-array" name="espacio_asignado_dominio" ng-model="dominio.espacio_asignado_dominio">
											<option class="option" value="">Seleccione un tamaño</option>
											@foreach($tamanos as $key=> $value)
												<option class="option" value="{{$key}}">{{$value}}</option>
											@endforeach
										</select>
		                            </div>
		                        </div>

		                        <div class="form-group">
		                            <label class="col-md-4 control-label">Fecha de creacion de dominio</label>
		                            <div class="col-md-5">
		                             	<input type="date" class="form-control" ng-value="dominio.fecha_dominio" name="fecha_dominio">
		                            </div>
		                        </div>
								
								<center>
									@if($dominio)
										<button type="submit" class="btn btn-danger m-r-5 m-b-5">
											Actualizar <i class="fa fa-undo"></i>
										</button>
									@else
										<button type="submit" class="btn btn-info m-r-5 m-b-5">
											Registrar <i class="fa fa-pencil-square-o"></i>
										</button>
									@endif
								</center>
							
							</div>
						</div><!-- boby -->
	                </div>
	            </div>
	        </div><!-- row -->
		
		</form>
    </div><!-- content -->
	
</div>

@endsection