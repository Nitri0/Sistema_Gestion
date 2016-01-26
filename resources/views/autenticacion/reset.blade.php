@extends('base-admin')

@section('js')
	<script src="{{ asset('/js/controllers/helper.js') }}"></script>
@endsection

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="SubmitController">
	
	@include('layouts/navbar-admin')
	@include('alerts.mensaje_success')
	@include('alerts.mensaje_error')

	<div ng-init="urlRedirect='{{ url('mis-proyectos/') }}'"></div>
    <div ng-init="urlAction='{{ url('/reset-password') }}'"></div>
    <div ng-init="model={}"></div>
	
	<div id="content" class="content ng-scope" ng-controller="SubmitController">

        <h1 class="page-header"><i class="fa fa-key"></i> Cambiar contraseña </h1>

        <div class="row">
	        <!-- begin col-12 -->
	        <div class="col-md-10 ui-sortable">
	            <!-- begin panel -->
	            <div class="panel panel-inverse">
	                <div class="panel-heading">
	                    <div class="panel-heading-btn">
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand" data-original-title="" title=""><i class="fa fa-expand"></i></a>
	                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse" data-original-title="" title=""><i class="fa fa-minus"></i></a>
	                    </div>
	                    <h4 class="panel-title">Contraseña</h4>
	                </div>

	                <div class="panel-body">

						<form name="formulario" id="formulario" class="form-horizontal" method="POST" action="{{ url('/reset-password') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<div class="form-group">
								<label class="col-md-3 control-label">Contraseña Actual</label>
								<div class="col-md-6">
									<input type="password" class="form-control" name="old-password" ng-required="true">
									<div class="error campo-requerido" ng-show="formulario.old-password.$invalid && (formulario.old-password.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.old-password.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                            	</div>	
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label">Nueva Contraseña</label>
								<div class="col-md-6">
									<input type="password" class="form-control" name="password" ng-model="model.password" ng-required="true">
									<div class="error campo-requerido" ng-show="formulario.password.$invalid && (formulario.password.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.password.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                            	</div>	
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-3 control-label">Confirmar nueva Contraseña</label>
								<div class="col-md-6">
									<input type="password" class="form-control" name="password_confirmation" ng-model="model.password_confirmation" ng-required="true">
									<div class="error campo-requerido" ng-show="formulario.password_confirmation.$invalid && (formulario.password_confirmation.$touched || submitted)">
	                                    <small class="error" ng-show="formulario.password_confirmation.$error.required">
	                                        * Campo requerido.
	                                    </small>
	                            	</div>	
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<button type="button" class="btn btn-success" ng-click="submit(formulario.$valid)">
										Resetear Contraseña <span ng-show="snipper===true" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>
									</button>
								</div>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>

	</div>
</div>
				