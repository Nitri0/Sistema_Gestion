<div class="modal fade bs-example-modal-sm" id="eliminar" labelledby="myLargeModalLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title"><i class="fa fa-trash"></i> Eliminar</h4>
			</div>
			<div class="modal-body">
				<p>[[mensaje_emilinar]]</p>
			</div>
			<div class="modal-footer">
				<div ng-init="url='{{url()}}'"></div>
				<a href="javascript:;" class="btn btn-danger" data-dismiss="modal">No</a>
				<a ng-href="[[ url + eliminar_url]]" class="btn btn-success">
					Si
				</a>
			</div>
		</div>
	</div>
</div>