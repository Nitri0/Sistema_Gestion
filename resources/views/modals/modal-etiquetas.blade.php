<div class="modal fade bs-example-modal-lg" id="modal-etiquetas" labelledby="myLargeModalLabel">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Etiquetas de plantilla</h4>
			</div>
			<div class="modal-body">
				<div class="row">
				
					<div class="col-md-4">
						<div class="col-md-12">	
							<h5>Etiquetas de data del cliente</h5>
							<br>
						</div>
						<div class="col-md-12">
	                    	<div class="list-group">
						         <a href="javascript:;"
						            class="list-group-item"
						            ng-repeat="cliente in clientes"
						            context-menu="menuCliente">
						             [[cliente.name]]
						        </a>
						    </div>
		                </div>
					</div>
	                
	                <div class="col-md-4">
	                	<div class="col-md-12">	
							<h5>Etiquetas</h5>
							<br>
						</div>
						<div class="col-md-12">
	                    	<div class="list-group">
						         <a href="javascript:;"
						            class="list-group-item"
						            ng-repeat="etiqueta in etiquetas"
						            context-menu="menuEtiqueta">
						             [[etiqueta.name]]
						        </a>
						    </div>
		                </div>
	                </div>

	                <div class="col-md-4">
	                	<div class="col-md-12">	
							<h5>Etiquetas de Usuario</h5>
							<br>
						</div>
						<div class="col-md-12">
	                    	<div class="list-group">
						         <a href="javascript:;"
						            class="list-group-item"
						            ng-repeat="usuario in usuarios"
						            context-menu="menuUsuario">
						             [[usuario.name]]
						        </a>
						    </div>
		                </div>                       
	                </div>
	                <div class="col-md-12" align="center">
	                	Nota: Presione el click derecho del mouse para copiar la etiqueta que desee colocar en su plantilla de correo.
	                </div>
	                <!--<div class="col-md-12">
                    	<div class="well">
	                    	<center>

								<br>	<br>
								<strong>Para colocar la data es necesario usar doble {{}} y dentro colocar la variable que se desea imprimir<br>
								ejemplo: {{ $cliente->nombre_cliente } } (sin espacios) </strong><br><br>

								<strong>P.D: no olvidar colocar la etiqueta { !! $data !! } (sin espacios) en el lugar donde estará la data que se llenará automaticamente al crear un avance</strong><br><br><br>
							</center>
						</div>
	                </div>-->
				
				</div>
			</div>
			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-sm btn-danger" data-dismiss="modal">Cerrar</a>
			</div>
		</div>
	</div>
</div>