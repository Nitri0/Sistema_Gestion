@extends('base-admin')

@section('js')
    <script src="{{ asset('/js/controllers/helper.js') }}"></script>
@endsection

@section('content')

<div id="page-container" class="fade page-header-fixed" ng-controller="SubmitController">
	
	@include('layouts/navbar-admin')

	@include('alerts.mensaje_success')
	@include('alerts.mensaje_error')

    @include('modals/ayudas/roles')

    <form class="form-horizontal" action="{{ url('roles/') }}" method="POST" name="formulario" id="formulario" >

    	<div id="content" class="content content-asistente ng-scope">
            
            <div ng-init="urlRedirect='{{ url('asistente/paso4/list') }}'"></div>

            <div ng-init="urlAction='{{ url('roles/') }}'"></div>
            <h1 class="page-header">Crear Rol </h1>

            <div class="row">
                <!-- begin col-12 -->
                <div class="col-12 ui-sortable">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading-2">
                            <div class="panel-heading-btn">
                                <a href="#roles-ayuda" class="btn btn-ayuda" data-toggle="modal"><i class="fa fa-question"></i></a>
                            </div>
                            <h4 class="panel-title">Roles</h4>
                        </div>

                        <div class="panel-body">

                            <div class="form-group">
                                <label class="col-md-4 control-label">Nombre</label>
                                <div class="col-md-5">
                                   <input type="text" text-only class="form-control" ng-model="model.nombre_tipo_rol" name="nombre_tipo_rol" ng-required="true" oninvalid="setCustomValidity(' ')">
                                    <div class="error campo-requerido" ng-show="formulario.nombre_tipo_rol.$invalid && (formulario.nombre_tipo_rol.$touched || submitted)">
                                        <small class="error" ng-show="formulario.nombre_tipo_rol.$error.required">
                                            * Campo requerido.
                                        </small>
                                    </div>                                     
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Descripcion</label>
                                <div class="col-md-5">
                                   <textarea rows="5" class="form-control" ng-model="model.descripcion_tipo_rol" name="descripcion_tipo_rol" ng-required="true" oninvalid="setCustomValidity(' ')"></textarea>
                                    <div class="error campo-requerido" ng-show="formulario.descripcion_tipo_rol.$invalid && (formulario.descripcion_tipo_rol.$touched || submitted)">
                                        <small class="error" ng-show="formulario.descripcion_tipo_rol.$error.required">
                                            * Campo requerido.
                                        </small>
                                    </div>
                                </div>
                            </div>
            
                        </div><!-- boby -->
                    </div>
                </div>
            </div>
            
        </div>

        <!-- Navbar fixed bottom -->
        <div class="navbar navbar-default navbar-fixed-bottom" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Paso 4/5 Roles</a>
                </div>
                <div class="navbar-collapse">
                    <!-- Right nav -->
                    <ul class="nav-siguiente navbar-right">
                        <button class="btn btn-success m-r-5 m-b-5" type="button" ng-click="submit(formulario.$valid)">
                            Registrar <span ng-show="snipper===true" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>
                        </button>
                    </ul>
                </div><!--/.nav-collapse -->
            </div><!--/.container -->
        </div>

    </form>

</div>
@endsection