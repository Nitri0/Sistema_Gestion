@if(Session::has('upgrade'))
<div class="modal bs-example-modal-sm fade" id="7-dia" labelledby="myLargeModalLabel">
	<div class="modal-dialog" ng-controller="AdminUsuariosController">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Lo Sentimos <i class="fa fa-exclamation"></i></h4>
			</div>
			<div class="modal-body" align="center" ng-init="urlAction='{{url('/contactame')}}'">
				<p>Para agregar mas personas a tu equipo de trabajo debes comunicarte con el equipo de soporte llenando el siguiente formulario.</p>
			</div>
			<form class="form-horizontal" name="formulario" id="formulario" action="[[urlAction]]" method="POST">	
				<div class="form-group">
				    <label class="col-md-4 control-label">Nombres *</label>
				    <div class="col-md-5">
				       <input type="text" text-num-only class="form-control" name="nombres" ng-model="nombres" ng-required="true" oninvalid="setCustomValidity(' ')">
						<div class="error campo-requerido" ng-show="formulario.nombres.$invalid && (formulario.nombres.$touched || submitted)">
				            <small class="error" ng-show="formulario.nombres.$error.required">
				                * Campo requerido.
				            </small>
				    	</div>
				    </div>
				</div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Teléfono *</label>
                    <div class="col-md-5" >
                       <input type="text" text-num-only class="form-control" name="telefono" ng-model="telefono" ng-required="true" oninvalid="setCustomValidity(' ')">
						<div class="error campo-requerido" ng-show="formulario.telefono.$invalid && (formulario.telefono.$touched || submitted)">
                            <small class="error" ng-show="formulario.telefono.$error.required">
                                * Campo requerido.
                            </small>
                    	</div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Correo *</label>
                    <div class="col-md-5" >
                       <input type="text" text-num-only class="form-control" name="correo" ng-model="correo" ng-required="true" oninvalid="setCustomValidity(' ')">
						<div class="error campo-requerido" ng-show="formulario.correo.$invalid && (formulario.correo.$touched || submitted)">
                            <small class="error" ng-show="formulario.correo.$error.required">
                                * Campo requerido.
                            </small>
                    	</div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label">Comentario</label>
                    <div class="col-md-5" >
                       <input type="text" text-num-only class="form-control" name="comentario" ng-model="comentario" ng-required="true" oninvalid="setCustomValidity(' ')">
                    </div>
                </div>

				<div class="modal-footer">
					<a href="javascript:;" class="btn btn-danger btn-sm-cerrar-7-dia" data-dismiss="modal" >Cerrar</a>
					<a href="javascript:;" class="btn btn-info btn-sm-cerrar-7-dia" ng-click="submit(formulario.$valid)" >Enviar</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endif