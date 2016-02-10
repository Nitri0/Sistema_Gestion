<div class="modal fade bs-example-modal-lg" id="ayuda" labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">[[titulo_ayuda]]</h4>
			</div>
			<div class="modal-body">
            	<div ng-bind-html="descripcion_ayuda"></div>
			</div>
			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-sm btn-danger" data-dismiss="modal">Cerrar</a>
			</div>
		</div>
	</div>
</div>