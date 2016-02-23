@if(Session::has('upgrade'))
<div class="modal bs-example-modal-sm fade" id="7-dia" labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title"><i class="fa fa-user-times"></i> Licencia requerida</h4>
			</div>
			<div class="modal-body">
				<p>Para registrar a tu equipo de trabajo necesitas suscribirte a un plan!, envía un correo con tus datos a <a href="mailto:info@keygestion.com.ve">info@keygestion.com.ve</a> y lo antes posible nos estaremos comunicando con usted adjuntando la información con los planes y precios.</p>
			</div>
			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-danger btn-sm-cerrar-7-dia" data-dismiss="modal">Cerrar</a>
			</div>
		</div>
	</div>
</div>
@endif