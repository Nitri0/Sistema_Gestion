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
						Etiquetas de data del cliente
                    	<div class="well">
                        	<ul>
                        		<li><h5>$cliente->nombre_cliente</h5></li>
                        		<li><h5>$cliente->email_cliente</h5></li>
                        		<li><h5>$cliente->persona_contacto_cliente</h5></li>
                        		<li><h5>$cliente->telefono_cliente</h5></li>
                        		<li><h5>$cliente->telefono_2_cliente</h5></li>
                        		<li><h5>$cliente->direccion_cliente</h5></li>
                        	</ul>
                    	</div>
	                </div>

	                <div class="col-md-4">
	                	Etiquetas
                    	<div class="well">
                        	<ul> Etiquetas de data del Proyecto
                        		<li><h5>$proyecto->nombre_proyecto</h5></li>
                        	</ul>
                        	<ul> Etiquetas de datos del Dominio
                        		<li><h5>$dominio->nombre_dominio</h5></li>
                        	</ul>
                    	</div>
	                </div>

	                <div class="col-md-4">
	                	Etiquetas de datos Propios
                    	<div class="well">
                        	<ul> Etiquetas de data del Proyecto
                        		<li><h5>$mi_correo</h5></li>
                        		Nombre:
                        		<li><h5>$mis_datos->fullName()</h5></li>
                        		<li><h5>$mis_datos->telefono_perfil</h5></li>
                        		<li><h5>$mis_datos->cedula_perfil</h5></li>
                        	</ul>
                    	</div>                        
	                </div>

	                <div class="col-md-12">
                    	<div class="well">
	                    	<center>

								<br>	<br>
								<strong>Para colocar la data es necesario usar doble {{}} y dentro colocar la variable que se desea imprimir<br>
								ejemplo: {{ $cliente->nombre_cliente } } (sin espacios) </strong><br><br>

								<strong>P.D: no olvidar colocar la etiqueta { !! $data !! } (sin espacios) en el lugar donde estará la data que se llenará automaticamente al crear un avance</strong><br><br><br>
							</center>
						</div>
	                </div>
				
				</div>
			</div>
			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-sm btn-danger" data-dismiss="modal">Cerrar</a>
			</div>
		</div>
	</div>
</div>