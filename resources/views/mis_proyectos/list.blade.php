@extends('base-admin')

@section('js')
    <script src="{{ asset('/js/controllers/proyecto.js') }}"></script>
@endsection

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="ProyectoController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')

    @include('alerts.mensaje_success')
    @include('alerts.mensaje_error')

	<div id="content" class="content ng-scope">

        <h1 class="page-header">Mis Proyectos </h1>
        
        <div ng-init="proyectos={{$proyectos}}"></div>
        <div ng-init="url='{{url()}}'"></div>
        
        <div class="row">
            <div class="col-12">
                <div class="panel-group" id="accordion">
                    <div class="row text-list">
                        <div class="col-sm-3"> 
                            <div class="row">
                                <div class="col-sm-3" align="center">N°</div>
                                <div class="col-sm-9">
                                    <a href="#" ng-click="changeSort('nombre_proyecto')"><i class="fa fa-sort"></i> Proyecto</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <a href="#" ng-click="changeSort('nombre_cliente')"><i class="fa fa-sort"></i>  Cliente</a>
                        </div>
                        <div class="col-sm-2">
                            <a href="#" ng-click="changeSort('nombre_etapa')"><i class="fa fa-sort"></i>  Estatus</a>
                        </div>
                        <div class="col-sm-2">
                            <center>
                                <a href="#" ng-click="changeSort('fecha_creacion_avance')"><i class="fa fa-sort"></i> Ultimo avance</a>
                            </center>
                        </div>
                    </div>

                    <br>
                    
                    <div class="panel panel-inverse overflow-hidden custon-list" ng-repeat="proyecto in proyectos| filter:opciones.buscador | orderBy:sort:reverse  track by $index">
                        <div class="panel-heading">
                            <h3 class="panel-title list-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#[[$index+1]]">
                                    <i class="fa fa-plus pull-right"></i> 
                                </a>    
                            </h3>
                            <div class="box-button-list">
                                <a class="btn btn-list" ng-if="proyecto.proyecto_interno == 1" data-toggle="tooltip" data-title="Proyecto Interno"><i class="fa fa-sitemap"></i></a>
                                <a class="btn btn-list" ng-href="{{ url( '/mis-proyectos/[[proyecto.id_proyecto]]' ) }}" data-toggle="tooltip" data-title="Detalle"><i class="fa fa-list"></i></a>
                                <a class="btn btn-list" ng-href="{{ url( '/mis-proyectos/avances/[[proyecto.id_proyecto]]/create' ) }}" data-toggle="tooltip" data-title="Crear Avance"><i class="fa fa-line-chart"></i></a>
                            </div>
                            <h3 class="panel-title list-title">
                                <div class="row">
                                    <div class="col-sm-3"> 
                                        <div class="row">
                                            <div class="col-sm-3"> [[$index+1]] </div>
                                            <div class="col-sm-9 text-ellipsis">
                                                [[proyecto.nombre_proyecto]]
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 text-ellipsis" ng-if="!proyecto.proyecto_interno" >
                                        [[proyecto.nombre_cliente]]
                                    </div> 

                                    <div class="col-sm-3 text-ellipsis" ng-if="proyecto.proyecto_interno" >
                                        [[proyecto.nombre_lider_proyecto]]
                                    </div> 

                                    <div class="col-sm-3 text-ellipsis">
                                        [[proyecto.nombre_etapa]]
                                    </div>

                                    <div class="col-sm-1 text-ellipsis">
                                        [[proyecto.fecha_creacion_avance | DateForHumans]]
                                    </div>

                                </div>                               
                            </h3>
                        </div>
                        <div id="[[$index+1]]" class="panel-collapse collapse">
                            <div class="panel-body">
                                
                                <!--
                                
                                <p>Fecha de creación: [[proyecto.fecha_creacion_proyecto]] </p>
                                <p>Rol: [[proyecto.nombre_tipo_rol]]</p>
                                <p>Tipo de Proyecto: [[proyecto.nombre_grupo_etapas]]</p>
                                <hr>

                                -->
                                
                                <div ng-if="proyecto.asunto_avance != null">
                                    
                                    <p class="center"></p>
                                    <div class="row">
                                        <!-- begin col-12 -->
                                        <div class="col-12 ui-sortable">
                                            <!-- begin panel -->
                                            <div class="panel panel-inverse panel-ultimo-avance">
                                                <div class="panel-heading-3">
                                                    <div class="panel-heading-btn">
                                                        <p class="fecha-ultimo-avance">
                                                            <!--[[proyecto.fecha_creacion_avance | DateForHumans]]-->
                                                            <p ng-show="proyecto.nombre_dominio"><i class="fa fa-globe"></i> Sitio web: 
                                                                <a ng-href="[[proyecto.nombre_dominio]]" target="_blank">
                                                                    [[proyecto.nombre_dominio ]]
                                                                </a>
                                                            </p>            
                                                        </p>
                                                    </div>
                                                    <h4 class="panel-title"><img width="40" alt="" src="{{ url('img/user.png') }}"> [[proyecto.nombre_usuario]]</h4>
                                                </div>
                                                <div class="panel-body">
                                                    <div ng-bind-html="proyecto.descripcion_avance"></div> 
                                                </div>
                                                <div class="panel-heading-3">
                                                    <h4 class="panel-title text-ellipsis"><b>Asunto:</b> [[proyecto.asunto_avance]] </h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <section id="do_action" ng-show="!proyectos">
            <div class="center">
                <div class="row">
                    <div class="col-md-12 list-none">
                        <i class="fa fa-ban"></i>
                        <h1> No tiene Proyectos Asignados.</h1>
                    </div>
                </div>
            </div>
        </section>

    </div><!-- content -->
	
</div>

@endsection