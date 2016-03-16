<!-- Modal Actividad-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">[[tituloModal]]</h4>
      </div>
      <div class="modal-body">
        <form id="formulario">
            <div class="form-group">
                <label class="col-md-4 control-label">Usuarios </label>
                <div class="col-md-8">
                   <select id="usuarios_actividad" multiple="true" ng-model="usuarios_actividad" class="form-control" ng-options="fullName(usuario.usuario) for usuario in usuarios"></select>
                </div>
                <div style="clear:both;"></div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Nombre actividad </label>
                <div class="col-md-8">
                    <input type="text" ng-hide="true" ng-model="actividad.id_actividad" name="id_actividad">
                    <input type="text" ng-hide="true" ng-model="id_proyecto" name="id_proyecto">
                    <input type="text" only-text class="form-control" ng-model="actividad.nombre_actividad" name="nombre_actividad" ng-required="true" oninvalid="setCustomValidity(' ')">

                    <div class="error campo-requerido" ng-show="formulario.nombre_actividad.$invalid && (formulario.nombre_actividad.$touched || submitted)">
                        <small class="error" ng-show="formulario.nombre_actividad.$error.required">
                            * Campo requerido.
                        </small>
                    </div>  
                </div>
                <div style="clear:both;"></div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Descripcion </label>
                <div class="col-md-8">
                    <textarea rows="5" class="form-control" ng-model="actividad.descripcion_actividad" name="descripcion_actividad" ng-required="true" oninvalid="setCustomValidity(' ')">
                    </textarea>

                    <div class="error campo-requerido" ng-show="formulario.descripcion_actividad.$invalid && (formulario.descripcion_actividad.$touched || submitted)">
                        <small class="error" ng-show="formulario.descripcion_actividad.$error.required">
                            * Campo requerido.
                        </small>
                    </div>      
                </div>
                <div style="clear:both;"></div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">fecha de inicio </label>
                <div class="col-md-8">
                    <div class="input-group date" data-provide="datepicker">
                        <input type="text" id="activityInitDate" readonly="readonly" ng-model="actividad.fecha_inicio_actividad" name="fecha_inicio_actividad" class="form-control"> 
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                        <div id="picker-container"></div>
                    </div>
                </div>
                <div style="clear:both;"></div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">fecha estamada de fin</label>
                <div class="col-md-8">
                    <div class="input-group date" data-provide="datepicker">
                        <input type="text" id="activityEndDate" readonly="readonly" ng-model="actividad.fecha_aproximada_entrega_actividad" name="fecha_aproximada_entrega_actividad" class="form-control"> 
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-th"></span>
                        </div>
                        <div id="picker-container"></div>
                    </div>
                </div>
                <div style="clear:both;"></div>
            </div>
            <div style="clear:both;"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" ng-show="activityType" ng-click="agregarTarea()">Agregar Actividad</button>
        <button type="button" class="btn btn-primary" ng-hide="activityType" ng-click="editarActividad(arrayKeySelected)">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>