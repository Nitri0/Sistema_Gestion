@extends('base-admin')

@section('js')
    <script src="{{ asset('/js/controllers/grupo_etapas.js') }}"></script>
@endsection

@section('content')

<div id="page-container" class="fade page-header-fixed" ng-controller="GrupoEtapasController">
	
	@include('layouts/navbar-admin')

	@include('alerts.mensaje_success')
	@include('alerts.mensaje_error')

	<form class="form-horizontal" id="formulario" name="formulario" action="{{ url('tipo_proyectos/') }}" method="POST">

		<div id="content" class="content content-asistente ng-scope">
		
			<div class="row">
            	<!-- begin col-12 -->
            	<div class="col-12 ui-sortable">
                	<!-- begin panel -->
                		<div class="panel panel-inverse">
		                    <div class="panel-heading-2">
		                        <div class="panel-heading-btn">
		                        	<a href="#ayuda" class="btn btn-ayuda" data-toggle="modal"><i class="fa fa-question"></i></a>
		                        </div>
		                        <h4 class="panel-title">Tipo de proyectos</h4>
		                    </div>

                    	<div class="panel-body">
							<div ng-init="urlRedirect='{{ url('asistente/paso2/list/') }}'"></div>
							<div ng-init="urlAction='{{ url('tipo_proyectos/') }}'"></div>
							<div class="form-group">
                                <label class="col-md-4 control-label">Tipo de Proyecto</label>
                                <div class="col-md-5">
                                    <input type="text" text-num-only class="form-control" ng-model="GrpEtapas.nombre_grupo_etapas" name="nombre_grupo_etapas" ng-required="true" oninvalid="setCustomValidity(' ')">
									<div class="error campo-requerido" ng-show="formulario.nombre_grupo_etapas.$invalid && (formulario.nombre_grupo_etapas.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.nombre_grupo_etapas.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                            	</div>		                            		                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Descripción</label>
                                <div class="col-md-5">
                                    <textarea rows="5" class="form-control" ng-model="GrpEtapas.descripcion_grupo_etapas" name="descripcion_grupo_etapas" ng-required="true" oninvalid="setCustomValidity(' ')"></textarea>
									<div class="error campo-requerido" ng-show="formulario.descripcion_grupo_etapas.$invalid && (formulario.descripcion_grupo_etapas.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.descripcion_grupo_etapas.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                            	</div>		                            		                                    
                                </div>
                            </div>
						</div><!-- boby -->
		            </div>
		        </div>

				
	            <div class="col-12 ui-sortable">
		            <!-- begin panel -->
		            <div class="panel panel-inverse">
		                <div class="panel-heading-2">
		                    <div class="panel-heading-btn">
		                    	<button type="button" class="btn btn-danger btn-eliminar btn-list-custon" ng-show="cantidad_etapas>=1" ng-click="eliminar_etapa()"  data-toggle="tooltip" data-title="Eliminar ultima etapa"> 
									<i class="fa fa-trash-o"></i>
								</button>
		                    	<button type="button" class="btn btn-success btn-agregar btn-list-custon" ng-click="agregar_etapa()"  data-toggle="tooltip" data-title="Agregar nueva etapa">
		                    		<i class="fa fa-plus"></i>
		                    	</button>
		                    </div>
		                    <h4 class="panel-title">Agregar nueva etapa</h4>
		                </div>
		            </div>
		        </div>

		        <div class="error" ng-show="cantidad_etapas==0 && submitted">
					<br>
                    <center>
                        <small class="error" ng-show="cantidad_etapas==0" >
                                * Debe agregar por lo menos una etapa
                        </small>
                    </center>
            	</div>

	            <input type="hidden" class="form-control" name="cantidad_etapas" ng-model="cantidad_etapas" ng-value="cantidad_etapas" ng-hidden="true" ng-required="cantidad_etapas==0">
	        	
				<div class="col-md-6 ui-sortable" ng-repeat="etapa in etapas track by $index">
					<!-- begin panel -->
		            <div class="panel panel-inverse">
		                <div class="panel-heading-2">
		                    <div class="panel-heading-btn">

		                    </div>
		                    <h4 class="panel-title">Etapa [[$index+1]]</h4>
		                </div>
		                <div class="panel-body">
							<div class="form-group">
                                <label class="col-md-4 control-label">Nombre de etapa</label>
                                <div class="col-md-8">
									<input type="text" text-num-only class="form-control" ng-model="GrpEtapas.nombre_etapa_[[$index]]" name="nombre_etapa_[[$index]]" ng-required="true" oninvalid="setCustomValidity(' ')">
									<div class="error campo-requerido" ng-show="formulario.nombre_etapa_[[$index]].$invalid && (formulario.nombre_etapa_[[$index]].$touched || submitted)">
	                                    <small class="error" ng-show="formulario.nombre_etapa_[[$index]].$error.required">
	                                        * Campo requerido.
	                                    </small>
	                            	</div>	
                                </div>
                            </div>
		                </div>
		            </div>
		        </div>

		    </div>
			
			@include('modals/ayuda')
			@include('modals/confirmar_registar')

			<!-- Navbar fixed bottom -->
			<div class="navbar navbar-default navbar-fixed-bottom" role="navigation">
			  	<div class="container">
			    	<div class="navbar-header">
			      		<a class="navbar-brand" href="#">Paso 2/5 Tipo Proyecto</a>
			    	</div>
			    	<div class="navbar-collapse collapse">
			      		<!-- Right nav -->
			      		<ul class="nav-siguiente navbar-right">
			        		<li>
			        			<button type="button" ng-click="mostrar_modal(formulario.$valid)" class="btn btn-success m-r-5 m-b-5">
									Registrar <span ng-show="snipper===true" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>
								</button>
			        		</li>
			      		</ul>
			    	</div><!--/.nav-collapse -->
			  	</div><!--/.container -->
			</div>

		</div>

	</form>

</div>