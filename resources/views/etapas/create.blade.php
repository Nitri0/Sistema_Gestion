@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="GrupoEtapasController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/grupo_etapas/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Agregar">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>

        <h1 class="page-header"><i class="fa fa-database"></i> Crear etapas</h1>
        
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
                        <h4 class="panel-title">Grupos de Etapas</h4>
                    </div>

                    <div class="panel-body">
						<div ng-init="urlRedirect='{{ url('grupo_etapas/') }}'"></div>
						<div ng-init="urlAction='{{ url('grupo_etapas/') }}'"></div>
						<form class="form-horizontal" id="formulario" name="formulario" action="{{ url('grupo_etapas/') }}" method="POST">
	 
							<div class="well">	
								
								<div class="form-group">
	                                <label class="col-md-4 control-label">Identificador de grupo de etapas</label>
	                                <div class="col-md-5">
	                                    <input type="text" text-only class="form-control" ng-model="GrpEtapas.nombre_grupo_etapas" name="nombre_grupo_etapas" ng-required="true" oninvalid="setCustomValidity(' ')">
										<div class="error campo-requerido" ng-show="formulario.nombre_grupo_etapas.$invalid && (formulario.nombre_grupo_etapas.$touched || submitted)">
		                                    <small class="error" ng-show="formulario.nombre_grupo_etapas.$error.required">
		                                        * Campo requerido.
		                                    </small>
		                            	</div>		                            		                                    
	                                </div>
	                            </div>

	                            <div class="form-group">
	                                <label class="col-md-4 control-label">Descripcion del grupo de etapas</label>
	                                <div class="col-md-5">
	                                    <input type="text" text-only class="form-control" ng-model="GrpEtapas.descripcion_grupo_etapas" name="descripcion_grupo_etapas" ng-required="true" oninvalid="setCustomValidity(' ')">
										<div class="error campo-requerido" ng-show="formulario.descripcion_grupo_etapas.$invalid && (formulario.descripcion_grupo_etapas.$touched || submitted)">
		                                    <small class="error" ng-show="formulario.descripcion_grupo_etapas.$error.required">
		                                        * Campo requerido.
		                                    </small>
		                            	</div>		                            		                                    
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

	                        <div class="well">

								<center>
									<br>
									<button class="btn btn-success m-r-5 m-b-5" type="button" ng-click="agregar_etapa()"> Agregar nueva etapa <i class="fa fa-plus"></i></button>
									<button class="btn btn-danger m-r-5 m-b-5" type="button" ng-show="cantidad_etapas>=1" ng-click="eliminar_etapa()"> Eliminar ultima etapa <i class="fa fa-trash"></i></button>
									<br>
								</center>
								<br>
			
								<input type="hidden" class="form-control" name="cantidad_etapas" ng-model="cantidad_etapas" ng-value="cantidad_etapas" ng-hidden="true" ng-required="cantidad_etapas==0">
								
								<div class="row">
									<div class="col-md-6" ng-repeat="etapa in etapas track by $index">
										<div class="well">
											
											<center><h5>Etapa [[$index+1]]</h5></center>

											<div class="form-group">
				                                <label class="col-md-4 control-label">Nombre de etapa</label>
				                                <div class="col-md-8">
													<input type="text" text-only class="form-control" ng-model="GrpEtapas.nombre_etapa_[[$index]]" name="nombre_etapa_[[$index]]" ng-required="true" oninvalid="setCustomValidity(' ')">
													<div class="error campo-requerido" ng-show="formulario.nombre_etapa_[[$index]].$invalid && (formulario.nombre_etapa_[[$index]].$touched || submitted)">
					                                    <small class="error" ng-show="formulario.nombre_etapa_[[$index]].$error.required">
					                                        * Campo requerido.
					                                    </small>
					                            	</div>	
				                                </div>
				                            </div>

				                            <div class="form-group">
				                                <label class="col-md-4 control-label">Tiempo estimado en esta estapa (dias)</label>
				                                <div class="col-md-8">
													<input type="text" numeric-only class="form-control" ng-model="GrpEtapas.tiempo_etapa_[[$index]]" name="tiempo_etapa_[[$index]]" ng-required="true" oninvalid="setCustomValidity(' ')">
													<div class="error campo-requerido" ng-show="formulario.tiempo_etapa_[[$index]].$invalid && (formulario.tiempo_etapa_[[$index]].$touched || submitted)">
					                                    <small class="error" ng-show="formulario.tiempo_etapa_[[$index]].$error.required">
					                                        * Campo requerido.
					                                    </small>
					                            	</div>														
				                                </div>
				                            </div>
											
										</div>
									</div>
								</div>			
							
							</div>
							
							<center>
								<button type="button" class="btn btn-success m-r-5 m-b-5" ng-click="submit(formulario.$valid)">
									Registrar <i class="fa fa-pencil-square-o"></i>
								</button>
							</center>
							
						</form>
	
					</div><!-- boby -->
                </div>
            </div>
        </div>

    </div><!-- content -->
	
</div>

@endsection