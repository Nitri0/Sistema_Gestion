<div class="modal fade" id="WelcomeTour" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Paseo</h4>
			</div>
			<div class="modal-body">
				 <section id="slider-ayuda">
					<div class="container-ayuda-slider">
						<div class="row">
							<div class="col-sm-12">
								<div id="slider-carousel" class="carousel slide" data-ride="carousel">
									<div class="carousel-inner">		
										<div class="item item-ayuda center active">
											<div class="col-sm-12">
												<p style="color:#B4B1AB;"><strong>Paseo por Gestion</strong></p>
												<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
												<br>
												<div class="img-ayuda">
													<img src="{{ asset('img/ayudas/cliente/laptop-gestión-clientes.png') }}" class="center img-ayuda-slider" alt="" />
												</div>
											</div>
										</div>
									</div>
								</div>		
							</div>
						</div>
					</div>
				</section>
			</div>
			<div class="modal-footer" ng-controller="TourController">
				<a href="javascript:;" class="btn btn-danger" data-dismiss="modal">Cerrar</a>
				<a ng-click="tour()" class="btn btn-success" data-dismiss="modal">Inicio</a>
			</div>
		</div>
	</div>
</div>