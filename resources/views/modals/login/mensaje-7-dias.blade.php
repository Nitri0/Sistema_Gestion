@if(Session::has('mensaje-7-dias'))
<div class="modal bs-example-modal-sm fade" id="7-dia" labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title"><i class="fa fa-user-times"></i> Licencia vencida</h4>
			</div>
			<div class="modal-body">
				<p>A vencido su periodo de prueba de 7 dias, 
				para obtener el servicio completo envie un correo con sus datos de contacto
				a <a href="mailto:info@keygestion.com.ve">info@keygestion.com.ve</a> y lo antes posible nos estaremos comunicando con usted.</p>
			</div>
			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-danger btn-sm-cerrar-7-dia" data-dismiss="modal">Cerrar</a>
			</div>
		</div>
	</div>
</div>
@endif