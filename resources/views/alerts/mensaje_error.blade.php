		@if(Session::has('mensaje-error'))
			<div id="gritter-notice-wrapper">
				<div id="gritter-item-1" class="gritter-item-wrapper my-sticky-class" role="alert">
					<div class="alert alert-danger">
					  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					  	{{Session::get('mensaje-error')}}
					</div>
				</div>
			</div>
		@endif

