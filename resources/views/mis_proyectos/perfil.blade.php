@extends('base-admin')

@section('content')


<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="PerfilController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
        
        <!--<ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url('mis-publicidades/agregar-publicidad')}}" class="btn btn-white btn-sm p-l-20 p-r-20">
                        <i class="fa fa-plus-square"></i>
                    </a>
                </div>
                <div class="btn-group">
                    <a href="{{ url('mis-publicidades/listar')}}" class="btn btn-white btn-sm p-l-20 p-r-20">
                        <i class="fa fa-pencil-square-o"></i>
                    </a>
                </div>
            </div>
        </ol>-->

        <h1 class="page-header"><i class="fa fa-user"></i> Editar perfil </h1>
        
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
                        <h4 class="panel-title">Editar</h4>
                    </div>

                    <div class="panel-body">

						<div ng-init="perfil={{ $perfil }}"></div>
						<form class="form-horizontal" action="{{ url('perfil') }}" method="POST">
							
							<div class="well">	
								
								<div class="form-group">
	                                <label class="col-md-4 control-label">Nombre</label>
	                                <div class="col-md-5">
	                                    <input type="text" class="form-control" ng-model="perfil.nombre_perfil" name="nombre_perfil">
	                                </div>
	                            </div>

	                            <div class="form-group">
	                                <label class="col-md-4 control-label">Apellido</label>
	                                <div class="col-md-5">
	                                    <input type="text" class="form-control" ng-model="perfil.apellido_perfil" name="apellido_perfil">
	                                </div>
	                            </div>

	                            <div class="form-group">
	                                <label class="col-md-4 control-label">Cédula</label>
	                                <div class="col-md-5">
	                                    <input type="text" class="form-control" ng-model="perfil.cedula_perfil" name="cedula_perfil">
	                                </div>
	                            </div>

	                            <div class="form-group">
	                                <label class="col-md-4 control-label">Sexo</label>
	                                <div class="col-md-5">
	                                    <input type="text" class="form-control" ng-model="perfil.sexo_perfil" name="sexo_perfil">
	                                </div>
	                            </div>

	                            <div class="form-group">
	                                <label class="col-md-4 control-label">Fecha de nacimiento</label>
	                                <div class="col-md-5">
	                                    <input type="text" id="daterangepicker" class="form-control" ng-model="perfil.telefono_perfil" name="telefono_perfil">
	                                </div>
	                            </div>

	                            <div class="form-group">
	                                <label class="col-md-4 control-label">Dirección</label>
	                                <div class="col-md-5">
	                                    <input type="text" class="form-control" ng-model="perfil.direccion_perfil" name="direccion_perfil">
	                                </div>
	                            </div>

	                            <div class="form-group">
	                                <label class="col-md-4 control-label">Portal Web</label>
	                                <div class="col-md-5">
	                                    <input type="textarea" class="form-control" ng-model="perfil.portal_web_perfil" name="portal_web_perfil">
	                                </div>
	                            </div>
			
								<br>
								<center>
									<button type="submit" class="btn btn-success m-r-5 m-b-5">
										Actualizar <i class="fa fa-undo"></i>
									</button>
								</center>
							
							</div>
						
						</form>
	
	 				</div><!-- boby -->
                </div>
            </div>
        </div>

    </div><!-- content -->
	
</div>

@endsection