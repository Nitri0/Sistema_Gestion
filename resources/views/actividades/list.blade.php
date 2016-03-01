@extends('base-admin')

@section('js')
    <script src="{{ asset('/js/controllers/actividades.js') }}"></script>    
@endsection

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="ActividadController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	@include('alerts.mensaje_error')
	@include('alerts.mensaje_success')

	<div id="content" class="content ng-scope">
		<div class="row">
            <div ng-init="initProyectos({{$proyectos}},{{Auth::user()->id_usuario}})"></div><!--actividades={{$proyectos}}-->
            <div ng-init="url='{{url()}}'"></div>
            <div class="col-md-12">
                <div class="panel panel-inverse overflow-hidden custon-list" style="white-space: nowrap;
    overflow-x: scroll !important;">            
                    <div class="proyectos-actividades-list" ng-click="initActividades(null)">
                        <span> Mis Actividades </span>
                    </div>        
                    <div class="proyectos-actividades-list" ng-repeat="(clave, proyecto) in proyectos" ng-click="initActividades(clave)">
                        <span>[[proyecto.nombre_proyecto]]</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel-group" id="accordion">
                	<div class="row text-list">
                        <div class="col-sm-9">
                           <h1 class="page-header">Lista de Actividades </h1> 
                        </div>
                        <div class="col-sm-3">

                            <div class="btn-toolbar" style="text-align:right;">
                                <!--<a href="{{ url( '/actividades/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Crear actividad">
                                    <i class="fa fa-plus"></i>
                                </a>-->
                                <button class="btn btn-success btn-sm p-l-20 p-r-20" data-title="Crear actividad" ng-click="addModal()">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                	</div>

                	<br>
                    <div>
                       <div class="panel panel-inverse overflow-hidden custon-list" ng-repeat="(clave, actividad) in actividades | filter:filterTask" ng-click="datosActividad(actividad.id_actividad)">
                            <div class="panel-heading">
                                <h3 class="panel-title list-title">
                                    <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#[[clave]]">
                                        <i class="fa fa-plus pull-right"></i> 
                                    </a>    
                                </h3>
                                <h3 class="panel-title list-title">
                                    <div class="row">
                                        <div class="col-sm-10"> 
                                            <div class="row">
                                                <div class="col-sm-3"> [[clave+1]] </div>
                                                <div class="col-sm-9">
                                                    [[actividad.nombre_actividad]]
                                                </div>
                                            </div>
                                        </div>
                                    </div>                               
                                </h3>
                            </div>
                            <div id="[[clave]]" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <button class="btn btn-success btn-sm" ng-click="editModal(actividad.id_actividad)">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#adjunto">
                                        <i class="fa fa-puzzle-piece"></i>
                                    </button>
                                    <button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#sub_actividad">
                                        <i class="fa fa-thumb-tack"></i>
                                    </button>
                                    <button class="btn btn-success btn-sm">
                                        <i class="fa fa-check-square-o"></i>
                                    </button>
                                    <a ng-click="destruir(true,actividad.id_actividad)" class="btn btn-sm btn-danger pull-right" data-toggle="tooltip" data-title="Eliminar"><i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                        </div> 
                    </div>
                    

                </div>
            </div>
            <div class="col-md-6">
                <div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
                        <li role="presentation"><a href="#sub_actividades" aria-controls="sub_actividades" role="tab" data-toggle="tab">Sub-actividades</a></li>
                        <li role="presentation"><a href="#adjuntos" aria-controls="adjuntos" role="tab" data-toggle="tab">Adjuntos</a></li>
                        <li role="presentation"><a href="#comentarios" aria-controls="comentarios" role="tab" data-toggle="tab">Comentarios</a></li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="general">
                            <fieldset>
                                <legend>
                                    [[activitySelected.nombre]]
                                </legend>
                                <div>
                                   <p>
                                        [[activitySelected.descripcion]]
                                    </p> 
                                </div>
                                 <div>
                                    <button class="btn btn-success btn-sm" ng-click="editModal(activitySelected.id_actividad)">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#adjunto">
                                        <i class="fa fa-puzzle-piece"></i>
                                    </button>
                                    <button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#sub_actividad">
                                        <i class="fa fa-thumb-tack"></i>
                                    </button>
                                    <button class="btn btn-success btn-sm">
                                        <i class="fa fa-check-square-o"></i>
                                    </button>

                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>
                                    Comentarios
                                </legend>
                                <div class="comentario" ng-repeat="(clave, comentario) in activitySelected.comentarios" >
                                    <label class="autor">
                                        [[fullName(comentario.usuario)]]  
                                    </label>
                                    <h3 class="panel-title list-title">
                                        <div class="row">
                                            <div class="col-sm-12"> 
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        [[comentario.contenido_comentario]]
                                                    </div>
                                                </div>
                                            </div>

                                        </div>                               
                                    </h3>                               
                                </div> 
                            </fieldset>
                            <div class="crear-comentario">
                                <form>
                                    <textarea rows="4" name="contenido_comentario" id="contenido_comentario" class="form-control" ng-model="contenido_comentario"></textarea>
                                    <button ng-click="comentarActividad(arrayKeySelected)">Comentar</button>
                                </form>                                
                            </div class="crear-comentario">
                            
                           
                        </div>
                        <div role="tabpanel" class="tab-pane" id="sub_actividades">
                            <fieldset>
                                <legend>Sub-actividades</legend>
                                <div class="panel-group">
                                    <div class="panel panel-inverse overflow-hidden custon-list" ng-repeat="(clave, sub_actividad) in activitySelected.subActividades" >
                                        <div class="panel-heading">
                                            <h3 class="panel-title list-title">
                                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#sub_[[clave]]">
                                                    <i class="fa fa-plus pull-right"></i> 
                                                </a>    
                                            </h3>
                                            <h3 class="panel-title list-title">
                                                <div class="row">
                                                    <div class="col-sm-10"> 
                                                        <div class="row">
                                                            <div class="col-sm-3"> [[clave+1]] </div>
                                                            <div class="col-sm-9">
                                                                [[sub_actividad.nombre_sub_actividad]]
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>                               
                                            </h3>
                                        </div>     
                                        <div id="sub_[[clave]]" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <button class="btn btn-success btn-sm" ng-click="finishTask(false,sub_actividad.id_sub_actividad)">
                                                    <i class="fa fa-check-square-o"></i>
                                                </button>
                                                <a ng-click="destruir(false,sub_actividad.id_sub_actividad)" class="btn btn-sm btn-danger pull-right" data-toggle="tooltip" data-title="Eliminar"><i class="fa fa-trash"></i></a>

                                            </div>
                                        </div>                               
                                    </div> 
                                </div>
                                
                            </fieldset>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="adjuntos">
                            <fieldset class="adjunto-content">
                                <legend>adjuntos</legend>
                                <a href="../public/adjuntos/[[adjunto.url_adjunto]]" target="_blank" ng-repeat="(clave, adjunto) in activitySelected.adjuntos" class="adjunto">
                                    <div class="referencia_adjunto" ng-if="adjunto.tipo_adjunto == 'jpg' || adjunto.tipo_adjunto == 'png'" style="background-image:url('../public/adjuntos/[[adjunto.url_adjunto]]');"></div>
                                    <span class="tipo-adjunto">.[[adjunto.tipo_adjunto | uppercase]] </span>
                                    <span class="tag-adjunto"> #[[adjunto.tag_adjunto]] </span>
                                </a>
                            </fieldset>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="comentarios">
                            <fieldset>
                                <legend>
                                    Comentarios
                                </legend>
                                <div class="comentario" ng-repeat="(clave, comentario) in activitySelected.comentarios" >
                                    <label class="autor">
                                       [[fullName(comentario.usuario)]]
                                    </label>
                                    <h3 class="panel-title list-title">
                                        <div class="row">
                                            <div class="col-sm-12"> 
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        [[comentario.contenido_comentario]]
                                                    </div>
                                                </div>
                                            </div>

                                        </div>                               
                                    </h3>                               
                                </div> 
                            </fieldset>
                            <div class="crear-comentario">
                                <form>
                                    <textarea name="contenido_comentario" id="contenido_comentario" class="form-control" rows="5" ng-model="contenido_comentario"></textarea>
                                    <button ng-click="comentarActividad(arrayKeySelected)">Comentar</button>
                                </form>                                
                            </div class="crear-comentario">
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        <div class="form-group">
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
                    <div class="alert" flow-drop  flow-drag-enter="style={border:'4px solid green'}" flow-drag-leave="style={}"
     ng-style="style">
                        Arrastra los archivos que desees agregar a la actividad
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
    </div><!-- content -->
</div>
@endsection


