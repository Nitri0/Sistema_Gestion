@extends('base-admin')


@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="ProyectoController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')

    @include('alerts.mensaje_success')
    @include('alerts.mensaje_error')
	
	<div id="content" class="content ng-scope">

        <h1 class="page-header"><i class="fa fa-laptop"></i> Mis Proyectos </h1>

        <div ng-init="proyectos={{$proyectos}}"></div>
        <div ng-init="url='{{url()}}'"></div>
        
        <div class="row">
            <div class="col-12">
                <div class="panel-group" id="accordion">
                    <div class="row text-list">
                        <div class="col-sm-3"> 
                            <div class="row">
                                <div class="col-sm-3"># </div>
                                <div class="col-sm-9">
                                    Proyecto
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            Cliente
                        </div>
                        <div class="col-sm-3">
                            Dominio
                        </div>
                        <div class="col-sm-3">
                            <a href="#" ng-click="changeSort('proyecto.nombre_etapa')">Estatus</a>
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
                                <a class="btn btn-sm btn-info btn-cirule" ng-href="{{ url( '/mis-proyectos/[[proyecto.id_proyecto]]' ) }}" data-toggle="tooltip" data-title="Detalle"><i class="fa fa-list"></i></a>
                                <a class="btn btn-sm btn-success btn-cirule" ng-href="{{ url( '/mis-proyectos/avances/[[proyecto.id_proyecto]]/create' ) }}" data-toggle="tooltip" data-title="Crear Avance"><i class="fa fa-line-chart"></i></a>
                            </div>
                            <h3 class="panel-title list-title">
                                <div class="row">
                                    <div class="col-sm-3"> 
                                        <div class="row">
                                            <div class="col-sm-3"> [[$index+1]] </div>
                                            <div class="col-sm-9">
                                                [[proyecto.nombre_proyecto]]
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <a href="{{url('/clientes/[[proyecto.id_cliente]]')}}">
                                            [[proyecto.nombre_cliente | noAsignado]]
                                        </a>
                                    </div>

                                    <div class="col-sm-3">
                                        <a href="{{url('/dominios/[[proyecto.id_dominio]]')}}">
                                            [[proyecto.nombre_dominio | noAsignado ]]
                                        </a>
                                    </div>

                                    <div class="col-sm-2">
                                        [[proyecto.nombre_etapa]]
                                    </div>

                                </div>                               
                            </h3>
                        </div>
                        <div id="[[$index+1]]" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>Fecha de creación: [[proyecto.fecha_creacion_proyecto]] </p>
                                <p>Rol: [[proyecto.nombre_tipo_rol]]</p>
                                <p>Tipo de Proyecto: [[proyecto.nombre_tipo_proyecto]]</p>
                                <p class="center">Ultimo Avance</p>
                                <div class="row">
                                    <div class="col-md-8 col-md-offset-2">
                                        <ul class="chats">
                                            <li class="left">
                                                <span class="date-time">2016-01-04 16:43:20</span>
                                                <a href="javascript:;" class="name">Usuario</a>
                                                <a href="javascript:;" class="image"><img width="50" alt="" src="http://localhost:8000/img/user.png"></a>
                                                <div class="message">
                                                    Proyecto creado exitosamente
                                                </div>
                                                <div class="asunto">
                                                <h6>Asunto: Iniciando Proyecto</h6>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div><!-- content -->
	
</div>

@endsection