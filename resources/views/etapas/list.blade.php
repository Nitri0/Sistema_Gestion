@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')

    @include('alerts.mensaje_error')
    @include('alerts.mensaje_success')
	
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

        <h1 class="page-header"><i class="fa fa-database"></i> Lista de grupos de etapas</h1>
        
		<div ng-init="grupoetapas={{$grupo_etapas}}"></div>
		<div ng-init="url='{{url()}}'"></div>

        <div class="row">
            <div class="col-12">
                <div class="panel-group" id="accordion">
                	<div class="row text-list">
                		<div class="col-sm-5"> 
                			<div class="row">
                				<div class="col-sm-3"># </div>
                				<div class="col-sm-9">
                        			Nombre de grupo
                        		</div>
                			</div>
                		</div>
                		<div class="col-sm-3">
							Cantidad de etapas
                		</div>
                	</div>

                	<br>
                    
                    <div class="panel panel-inverse overflow-hidden custon-list" ng-repeat="etapa in grupoetapas| filter:opciones.buscador | orderBy:sort:reverse  track by $index">
                        <div class="panel-heading">
                            <h3 class="panel-title list-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#[[$index+1]]">
                                    <i class="fa fa-plus pull-right"></i> 
                                </a>	
                            </h3>
                            <div class="box-button-list">
		        				<a class="btn btn-sm btn-info btn-cirule" ng-href="{{ url( '/grupo_etapas/[[etapa.id_grupo_etapas]]' ) }}" data-toggle="tooltip" data-title="Editar"><i class="fa fa-pencil-square-o"></i></a>
		        			</div>
                            <h3 class="panel-title list-title">
                            	<div class="row">
                            		<div class="col-sm-5"> 
                            			<div class="row">
                            				<div class="col-sm-3"> [[$index+1]] </div>
                            				<div class="col-sm-9">
		                            			[[etapa.nombre_grupo_etapas]]
		                            		</div>
                            			</div>
                            		</div>

                            		<div class="col-sm-3">
										[[etapa.cantidad_etapas]]
                            		</div>
                            	</div>                           	 
                            </h3>
                        </div>
                        <div id="[[$index+1]]" class="panel-collapse collapse">
                            <div class="panel-body">
                            	<p>Descripción: [[etapa.descripcion_grupo_etapas]]</p>
                            	
                            	<a class="btn btn-sm btn-danger pull-right" href="{{ url( '/grupo_etapas/[[etapa.id_grupo_etapas]]/destroy' ) }}" data-toggle="tooltip" data-title="Eliminar"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div><!-- content -->
	
</div>

@endsection