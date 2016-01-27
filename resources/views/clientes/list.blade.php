@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/clientes/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Crear Cliente">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>

        <h1 class="page-header">Lista de Clientes </h1>
        
        <div ng-init="models={{$clientes}}"></div>
		<div ng-init="url='{{url()}}'"></div>
		
        <div class="row">
            <div class="col-12">
                <div class="panel-group" id="accordion">
                	<div class="row text-list">
                		<div class="col-sm-3"> 
                			<div class="row">
                				<div class="col-sm-3"># </div>
                				<div class="col-sm-9">
                        			Nombre
                        		</div>
                			</div>
                		</div>
                		<div class="col-sm-3">
							CI / RIF
                		</div>
                		<div class="col-sm-3">
							Email
                		</div>
                		<div class="col-sm-3">
							Telefono
                		</div>
                	</div>

                	<br>
                    
                    <div class="panel panel-inverse overflow-hidden custon-list" ng-repeat="model in models| filter:opciones.buscador | orderBy:sort:reverse  track by $index">
                        <div class="panel-heading">
                            <h3 class="panel-title list-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#[[$index+1]]">
                                    <i class="fa fa-plus pull-right"></i> 
                                </a>	
                            </h3>
                            <div class="box-button-list">
		        				<a class="btn btn-list" ng-href="{{ url( '/clientes/[[model.id_cliente]]/edit' ) }}" data-toggle="tooltip" data-title="Editar"><i class="fa fa-pencil-square-o"></i></a>
		        			</div>
                            <h3 class="panel-title list-title">
                            	<div class="row">
                            		<div class="col-sm-3"> 
                            			<div class="row">
                            				<div class="col-sm-3"> [[$index+1]] </div>
                            				<div class="col-sm-9">
		                            			[[model.nombre_cliente]]
		                            		</div>
                            			</div>
                            		</div>

                            		<div class="col-sm-3">
										[[model.ci_rif_cliente]]
                            		</div>

                            		<div class="col-sm-3">
										[[model.email_cliente]]
                            		</div>

                            		<div class="col-sm-2">
										[[model.telefono_cliente]]
                            		</div>

                            	</div>                           	 
                            </h3>
                        </div>
                        <div id="[[$index+1]]" class="panel-collapse collapse">
                            <div class="panel-body">
                            	<p>Contacto: [[model.persona_contacto_cliente]]</p>
                            	<p>Dirección: [[model.direccion_cliente]]</p>
                            	<p>Telefono 2: [[model.telefono_2_cliente]]</p>
                            	<p>Proyectos:</p>
                                <ul ng-repeat="proyecto in model.nombre_proyecto">
                                    <li>
                                        <a href="[[url + '/proyectos/' + proyecto.id_proyecto]]">[[proyecto.nombre_proyecto]]</a>
                                    </li>
                                </ul>
                            	<form action="[[url+'/clientes/'+model.id_cliente]]" method="post">
					        		<input type="hidden" name="_method" value="delete">
									<button type="submit" class="btn btn-sm btn-danger pull-right" data-toggle="tooltip" data-title="Eliminar"><i class="fa fa-trash"></i></button>
								</form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div><!-- content -->
	
</div>

@endsection