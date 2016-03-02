<div class="modal fade bs-example-modal-sm" id="confirmar_registrar" labelledby="myLargeModalLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title" align="center">¿Esta Seguro?</h4>
			</div>
			<div class="modal-body" align="center">
				<p>Una vez creada no podrá modificarlo, sólo podra eliminarlo y crear uno nuevo.</p>
			</div>
			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-danger" data-dismiss="modal">No</a>
				<button type="button" class="btn btn-success" ng-click="submit(formulario.$valid)" data-dismiss="modal">
					Si
				</button>
			</div>
		</div>
	</div>
</div>