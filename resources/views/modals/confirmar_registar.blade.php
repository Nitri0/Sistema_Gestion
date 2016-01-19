<div class="modal fade bs-example-modal-sm" id="confirmar_registrar" labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title"><i class="fa fa-line-chart"></i> Crear Tipo Proyecto</h4>
			</div>
			<div class="modal-body">
				<p>¿Esta seguro que desea registrar el grupo de etapa?</p>
				<p>De hacerlo no podra volver a modificar las etapas.</p>
			</div>
			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-danger" data-dismiss="modal">No</a>
				<button type="button" class="btn btn-success" ng-click="submit(formulario.$valid)">
					Si
				</button>
			</div>
		</div>
	</div>
</div>