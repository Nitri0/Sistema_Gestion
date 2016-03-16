<!-- Modal sub_actividad-->
<div class="modal fade" id="sub_actividad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar Sub-actividad</h4>
      </div>
      <div class="modal-body">
        <form id="formularioNuevo">
            <div class="form-group">
                <div class="form-group" ng-hide="personalP">
                    <label class="col-md-4 control-label">Usuarios </label>
                    <div class="col-md-8">
                       <select id="usuarios_actividad" ng-model="sub_actividad.id_usuario" class="form-control" name="id_usuario">
                           <option value="[[usuario.id_usuario]]" ng-repeat="usuario in activitySelected.usuarios">[[usuario.correo_usuario]]</option>
                       </select>
                    </div>
                    <div style="clear:both;"></div>
                </div>
                <label class="col-md-4 control-label">Nombre sub-actividad </label>
                <div class="col-md-8">
                    <input type="hidden" class="form-control" ng-model="sub_actividad.id_actividad" value="[[activitySelected.id_actividad]]" name="id_actividad" ng-model="activitySelected.id" >
                    <input type="text" text-num-only class="form-control" ng-model="sub_actividad.nombre_sub_actividad" name="nombre_sub_actividad" ng-required="true" oninvalid="setCustomValidity(' ')">

                    <div class="error campo-requerido" ng-show="formularioNuevo.nombre_sub_actividad.$invalid && (formularioNuevo.nombre_sub_actividad.$touched || submitted)">
                        <small class="error" ng-show="formularioNuevo.nombre_sub_actividad.$error.required">
                            * Campo requerido.
                        </small>
                    </div>  
                </div>
                <div style="clear:both;"></div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">Descripcion </label>
                <div class="col-md-8">
                    <textarea rows="5" class="form-control" ng-model="sub_actividad.descripcion_sub_actividad" name="descripcion_sub_actividad" ng-required="true" oninvalid="setCustomValidity(' ')">
                    </textarea>

                    <div class="error campo-requerido" ng-show="formularioNuevo.descripcion_sub_actividad.$invalid && (formularioNuevo.descripcion_sub_actividad.$touched || submitted)">
                        <small class="error" ng-show="formularioNuevo.descripcion_sub_actividad.$error.required">
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
                        <input type="text" id="subActivityInitDate" readonly="readonly" ng-model="sub_actividad.fecha_inicio_sub_actividad" name="fecha_inicio_sub_actividad" class="form-control"> 
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
                        <input type="text" id="subActivityEndDate" readonly="readonly" ng-model="sub_actividad.fecha_aproximada_entrega_sub_actividad" name="fecha_aproximada_entrega_sub_actividad" class="form-control"> 
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
        <button type="button" class="btn btn-primary" ng-click="agregarSubActividad(arrayKeySelected)">Agregar Sub-arctividad</button>
        <!--<button type="button" class="btn btn-primary" ng-click="saveTask()">Guardar Cambios</button>-->
      </div>
    </div>
  </div>
</div>