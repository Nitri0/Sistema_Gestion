@if(Session::has('upgrade'))
<div class="modal bs-example-modal-sm fade" id="7-dia" labelledby="myLargeModalLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Lo Sentimos <i class="fa fa-exclamation"></i></h4>
			</div>
			<div class="modal-body" align="center">
				<p>Para agregar mas personas a tu equipo de trabajo debes comunicarte con el equipo de soporte. Envía un correo con tus datos a <a href="mailto:info@gestionlist.com">info@gestionlist.com</a> y nuestro equipo se estará comunicando con Ud. a la brevedad.</p>
			</div>
			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-danger btn-sm-cerrar-7-dia" data-dismiss="modal">Cerrar</a>
			</div>
		</div>
	</div>
</div>
@endif