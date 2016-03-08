<div class="modal bs-example-modal-sm fade" id="suscripcion" labelledby="myLargeModalLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" align="center">Inscribir Empresa</h4>
			</div>
			<div ng-init="urlRedirect='{{url('/admin_empresas')}}'"></div>
			<div class="modal-body" align="center" ng-init="urlAction='{{url('/inscribir-empresa')}}'">
				<p>Rellena el siguiente formulario para inscribir a una empresa.</p>
			</div>
			<form class="form-horizontal" name="formulario" id="formulario" action="[[urlAction]]" method="POST">	
				<input type="hidden" name="id_empresa" ng-model="id_empresa" ng-value="id_empresa">
		
                <div class="form-group">
                    <label class="col-md-4 control-label">Número de integrántes</label>
                    <div class="col-md-6" >
                       <input type="number" numericOnly class="form-control" name="cantidad" ng-model="cantidad" ng-required="true" oninvalid="setCustomValidity(' ')">
						<div class="error campo-requerido" ng-show="formulario.cantidad.$invalid && (formulario.cantidad.$touched || submitted)">
                            <small class="error" ng-show="formulario.cantidad.$error.required">
                                * Campo requerido.
                            </small>
                        <small class="error" ng-show="formulario.cantidad.$error.number">
                                * Solo números
                            </small>
                    	</div>
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