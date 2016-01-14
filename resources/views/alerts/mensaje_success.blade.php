
		@if(Session::has('mensaje'))
		<div id="gritter-notice-key">
			<div class="alert alert-success">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  	{{Session::get('mensaje')}}
			</div>
		</div>
		@endif