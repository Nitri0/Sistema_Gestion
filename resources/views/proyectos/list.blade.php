@extends('base-admin')

@section('css')
	
@endsection

@section('js')

@endsection

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="ProyectoController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')

    @include('alerts.mensaje_success')
	@include('alerts.mensaje_error')
	
	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/proyectos/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Agregar Proyecto">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>
        
        <h1 class="page-header"><i class="fa fa-laptop"></i> Todos los proyectos </h1>

		<div ng-init="proyectos={{$proyectos}}"></div>

        <div class="row">
            <div class="col-12">
                <div class="panel-group" id="accordion">
                	<div class="row text-list">
                		<div class="col-sm-3"> 
                			<div class="row">
                				<div class="col-sm-3"># </div>
                				<div class="col-sm-9">
                        			Cliente
                        		</div>
                			</div>
                		</div>
                		<div class="col-sm-3">
							Dominio
                		</div>
                		<div class="col-sm-3">
							Etapas
                		</div>
                		<div class="col-sm-3">
							Fecha
                		</div>
                	</div>

                	<br>
                    
                    <div class="panel panel-inverse overflow-hidden" ng-repeat="proyecto in proyectos | filter:opciones.buscador | orderBy:sort:reverse  track by $index">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#[[$index+1]]">
                                    <i class="fa fa-plus pull-right"></i> 
                                </a>	
                            </h3>
                            <div class="box-button-list">
		        				<a class="btn btn-sm btn-info btn-cirule" ng-href="{{ url( '/proyectos/[[proyecto.id_proyecto]]' ) }}" data-toggle="tooltip" data-title="Detalle"><i class="fa fa-list"></i></a>
		        			</div>
                            <h3 class="panel-title">
                            	<div class="row">
                            		<div class="col-sm-3"> 
                            			<div class="row">
                            				<div class="col-sm-3"># [[$index+1]] </div>
                            				<div class="col-sm-9">
	                            				<a href="{{url('/clientes/[[proyecto.id_cliente]]')}}">
		                            			[[proyecto.nombre_cliente | noAsignado]]
		                            			</a>
		                            		</div>
                            			</div>
                            		</div>

                            		<div class="col-sm-3">
										<a href="http://[[proyecto.nombre_dominio]]" target="_blank">
											[[proyecto.nombre_dominio | noAsignado ]]
										</a>
                            		</div>

                            		<div class="col-sm-3">
										[[proyecto.nombre_etapa]]
                            		</div>

                            		<div class="col-sm-1 center">
										[[proyecto.fecha_creacion_avance | DateForHumans]]
                            		</div>

                            	</div>                           	 
                            </h3>
                        </div>
                        <div id="[[$index+1]]" class="panel-collapse collapse">
                            <div class="panel-body">
                            	<h1>[[proyecto.nombre_proyecto]]</h1>
                            	<h1>[[proyecto.nombre_tipo_proyecto]]</h1>
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div><!-- content -->
	
</div>
@endsection
