<!-- Modal adjuntar-->
<div class="modal fade" id="adjunto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Adjuntar documento</h4>
      </div>
      <div class="modal-body">
        <div  flow-init="{target: '/KeySysGestion/Sistema_Gestion/public/actividades/adjuntar'}" flow-files-submitted="subirAdjuntos($flow)"><!--flow-name="adjuntos.flow"-->     
            <div class="alert arrastrar-ng" flow-drop  flow-drag-enter="style={border:'4px solid green'}" flow-drag-leave="style={}" ng-style="style">
                <i class="fa fa-paperclip"></i>
                <br>
                <p>Arrastra los archivos que desees agregar a la actividad</p>
            </div>      
            Total files #[[$flow.files.length]]
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div> 