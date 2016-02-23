@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/admin_usuarios/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Agregar Usuario">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>
        

        <h1 class="page-header">Lista de Usuarios </h1>
        
		@include('alerts.mensaje_success')
		@include('alerts.mensaje_error')

		<div ng-init="usuarios={{$usuarios}}"></div>
		<div ng-init="url='{{url()}}'"></div>

        <div class="row">
            <div class="col-12">
                <div class="panel-group" id="accordion">
                    <div class="row text-list">                        
                        <div class="col-sm-8"> 
                            <div class="row">                                
                                <div class="col-sm-1" align="center">N° </div>
                                <div class="col-sm-2">
                                    Estatus
                                </div>                            
                                <div class="col-sm-9">
                                    Correo Usuario
                                </div>
                            </div>
                        </div>                        
                    </div>

                    <br>
                    
                    <div class="panel panel-inverse overflow-hidden custon-list" ng-repeat="usuario in usuarios| filter:opciones.buscador | orderBy:sort:reverse  track by $index">
                        <div class="panel-heading">
                            <!--<h3 class="panel-title list-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#[[$index+1]]">
                                    <i class="fa fa-plus pull-right"></i> 
                                </a>    
                            </h3>-->
                            <div class="box-button-list">
                                <a class="btn btn-list" ng-href="{{ url( '/admin_usuarios/[[usuario.id_usuario]]/edit' ) }}" data-toggle="tooltip" data-title="Editar"><i class="fa fa-pencil-square-o"></i></a>
                            	<a ng-if="usuario.habilitado_usuario == 1" class="btn btn-list" ng-href="{{ url( '/admin_usuarios/[[usuario.id_usuario]]/destroy' ) }}" data-toggle="tooltip" data-title="Deshabilitar"><i class="fa fa-thumbs-o-down"></i></a>
                            	<a ng-if="usuario.habilitado_usuario == 0" class="btn btn-list" ng-href="{{ url( '/admin_usuarios/[[usuario.id_usuario]]/habilitar' ) }}" data-toggle="tooltip" data-title="Habilitar"><i class="fa fa-thumbs-o-up"></i></a>
                            </div>
                            <h3 class="panel-title list-title">
                                <div class="row">                                    
                                    <div class="col-sm-8"> 
                                        <div class="row">
                                            <div class="col-sm-1"> [[$index+1]] </div>
                                            <div class="col-sm-2">
                                                <div class="icon-usuario-habilitado" ng-if="usuario.habilitado_usuario == 1">
                                                    <i class="fa fa-check-circle"></i>
                                                </div>
                                                <div class="icon-usuario-desabilitado" ng-if="usuario.habilitado_usuario == 0">
                                                    <i class="fa fa-times"></i>
                                                </div>
                                            </div>                                            
                                            <div class="col-sm-9">
                                                [[usuario.correo_usuario]]
                                            </div>
                                        </div>
                                    </div>                               
                                </div>                               
                            </h3>
                        </div>
                        <div id="[[$index+1]]" class="panel-collapse collapse">
                            <div class="panel-body">
                                [[usuario]]
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        @include('modals/upgrade-cuenta')
    </div><!-- content -->

	
</div>
@endsection