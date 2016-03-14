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
            <div ng-init="initProyectos({{$proyectos}})"></div><!--actividades={{$proyectos}}-->
            <div ng-init="url='{{url()}}'"></div>
            <div class="col-md-12">
                <div class="panel panel-inverse overflow-hidden custon-list" style="white-space: nowrap;
    overflow-x: scroll !important;">                    
                    <div class="proyectos-actividades-list" ng-repeat="(clave, proyecto) in proyectos" ng-click="initActividades(clave)">
                        <span>[[proyecto.nombre_proyecto]]</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel-group" id="accordion">
                    <div class="col-12 ui-sortable">
                        <div class="panel panel-inverse">
                            <div class="panel-heading-2">
                                <div class="panel-heading-btn">
                                    <button class="btn btn-success btn-agregar" data-title="Crear actividad" ng-click="addModal()">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <h4 class="panel-title">Lista de Actividades</h4>
                            </div>
                        </div>
                    </div>

                	<br>
                    <div>
                       <div class="panel panel-inverse overflow-hidden custon-list" ng-repeat="(clave, actividad) in actividades" ng-click="datosActividad(clave)">
                            <div class="panel-heading">
                                <!--<h3 class="panel-title list-title">
                                    <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#[[clave+1]]">
                                        <i class="fa fa-plus pull-right"></i> 
                                    </a>    
                                </h3>-->
                                <div class="box-button-list" style="  margin-right: -5px;">
                                    <button class="btn btn-list" ng-click="editModal(arrayKeySelected)">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    <button class="btn btn-list" data-toggle="modal" data-target="#adjunto">
                                        <i class="fa fa-puzzle-piece"></i>
                                    </button>
                                    <button class="btn btn-list"  data-toggle="modal" data-target="#sub_actividad">
                                        <i class="fa fa-thumb-tack"></i>
                                    </button>
                                    <button class="btn btn-list">
                                        <i class="fa fa-check-square-o"></i>
                                    </button>
                                </div>
                                <h3 class="panel-title list-title">
                                    <div class="row">
                                        <div class="col-sm-8"> 
                                            <div class="row">
                                                <div class="col-sm-1"> [[clave+1]] </div>
                                                <div class="col-sm-9">
                                                    [[actividad.nombre_actividad]]
                                                </div>
                                            </div>
                                        </div>
                                    </div>                               
                                </h3>
                            </div>
                            <!--<div id="[[clave+1]]" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <button class="btn btn-success btn-sm" ng-click="editModal(arrayKeySelected)">
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
                                    <a ng-click="destruir(true,actividad.id_actividad,arrayKeySelected)" class="btn btn-sm btn-danger pull-right" data-toggle="tooltip" data-title="Eliminar"><i class="fa fa-trash"></i></a>
                                </div>
                            </div>-->
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
                                    <a ng-click="destruir(true,actividad.id_actividad,arrayKeySelected)" class="btn btn-list pull-right" data-toggle="tooltip" data-title="Eliminar"><i class="fa fa-trash"></i></a>
                                </legend>
                                <div>
                                   <p>
                                        [[activitySelected.descripcion]]
                                    </p> 
                                </div>
                                 <div>
                                    <!--<button class="btn btn-success btn-sm" ng-click="editModal(arrayKeySelected)">
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
                                    </button>-->
                                </div>
                            </fieldset>
                            <fieldset>
                                <legend>
                                    Comentarios
                                </legend>
                                <ul class="chats">
                                    <li class="left" ng-repeat="(clave, comentario) in activitySelected.comentarios"><!-- right -->
                                        <span class="date-time">11:23pm</span>
                                        <a href="javascript:;" class="name">[[fullName(comentario.usuario)]]</a>
                                        <a href="javascript:;" class="image"><img alt="" src="{{ url('/img/user.jpg') }}"></a>
                                        <div class="message">
                                            [[comentario.contenido_comentario]]
                                        </div>
                                    </li>
                                </ul>
                                <!--<div class="comentario" ng-repeat="(clave, comentario) in activitySelected.comentarios" >
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
                                </div>--> 
                            </fieldset>
                            <br>
                            <div class="crear-comentario">
                                <form>
                                    <textarea rows="4" name="contenido_comentario" id="contenido_comentario" class="form-control iconic-textarea" ng-model="contenido_comentario"></textarea>
                                    <a ng-click="comentarActividad(arrayKeySelected)" class="iconic-textarea"><i class="fa fa-paper-plane"></i></a>
                                    <!--<button ng-click="comentarActividad(arrayKeySelected)">Comentar</button>-->
                                </form>                                
                            </div>
                            
                           
                        </div>
                        <div role="tabpanel" class="tab-pane" id="sub_actividades">
                            <fieldset>
                                <legend>Sub-actividades</legend>
                                <div class="panel-group">
                                    <div class="panel panel-inverse overflow-hidden custon-list" ng-repeat="(clave, sub_actividad) in activitySelected.subActividades" >
                                        <div class="panel-heading">
                                            <h3 class="panel-title list-title">
                                                <!--<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#sub_[[clave+1]]">
                                                    <i class="fa fa-plus pull-right"></i> 
                                                </a>-->    
                                                <div class="box-button-list" style="  margin-right: -5px;">
                                                    <button class="btn btn-list">
                                                        <i class="fa fa-check-square-o"></i>
                                                    </button>
                                                    <button class="btn btn-list">
                                                        <a ng-href="{{ url( '/actividades/[[actividad.id_actividad]]/destroy' ) }}" data-toggle="tooltip" data-title="Eliminar" style="color: rgba(0,0,0,0.6);"><i class="fa fa-trash"></i></a>
                                                    </button>
                                                </div>
                                            </h3>
                                            <h3 class="panel-title list-title">
                                                <div class="row">
                                                    <div class="col-sm-9"> 
                                                        <div class="row">
                                                            <div class="col-sm-1"> [[clave+1]] </div>
                                                            <div class="col-sm-8">
                                                                [[sub_actividad.nombre_sub_actividad]]
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>                               
                                            </h3>
                                        </div>     
                                        <div id="sub_[[clave+1]]" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <!--
                                                <button class="btn btn-success btn-sm" ng-click="editModal(arrayKeySelected)">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <button class="btn btn-success btn-sm">
                                                    <i class="fa fa-puzzle-piece"></i>
                                                </button>
                                                <button class="btn btn-success btn-sm"  data-toggle="modal" data-target="#sub_actividad">
                                                    <i class="fa fa-thumb-tack"></i>
                                                </button>
                                                <button class="btn btn-success btn-sm">
                                                    <i class="fa fa-check-square-o"></i>
                                                </button>
                                                <a ng-href="{{ url( '/actividades/[[actividad.id_actividad]]/destroy' ) }}" class="btn btn-sm btn-danger pull-right" data-toggle="tooltip" data-title="Eliminar"><i class="fa fa-trash"></i></a>
                                                -->
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
                                <ul class="chats">
                                    <li class="left" ng-repeat="(clave, comentario) in activitySelected.comentarios"><!-- right -->
                                        <span class="date-time">11:23pm</span>
                                        <a href="javascript:;" class="name">[[fullName(comentario.usuario)]]</a>
                                        <a href="javascript:;" class="image"><img alt="" src="{{ url('/img/user.jpg') }}"></a>
                                        <div class="message">
                                            [[comentario.contenido_comentario]]
                                        </div>
                                    </li>
                                </ul>
                                <!--<div class="comentario" ng-repeat="(clave, comentario) in activitySelected.comentarios" >
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
                                </div>--> 
                            </fieldset>
                            <br>
                            <div class="crear-comentario">
                                <form>
                                    <textarea rows="4" name="contenido_comentario" id="contenido_comentario" class="form-control iconic-textarea" ng-model="contenido_comentario"></textarea>
                                    <a ng-click="comentarActividad(arrayKeySelected)" class="iconic-textarea"><i class="fa fa-paper-plane"></i></a>
                                    <!--<button ng-click="comentarActividad(arrayKeySelected)">Comentar</button>-->
                                </form>                                
                            </div>
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
                            <select name="usuarios_actividad" id="usuarios_actividad" ng-model="usuarios_actividad" class="form-control" multiple="true">
                                <option  value="[[usuario.usuario.id_usuario]]" ng-repeat="(clave, usuario) in usuarios">
                                    <span >
                                        [[fullName(usuario.usuario)]]
                                    </span>
                                    
                                </option>
                            </select>  
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
                            <input type="date" text-num-only class="form-control" ng-model="actividad.fecha_inicio_actividad" name="fecha_inicio_actividad">
     
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">fecha estamada de fin</label>
                        <div class="col-md-8">
                            <input type="date" text-num-only class="form-control" ng-model="actividad.fecha_aproximada_entrega_actividad" name="fecha_aproximada_entrega_actividad">
    
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
                            <input type="date" text-num-only class="form-control" ng-model="sub_actividad.fecha_inicio_sub_actividad" name="fecha_inicio_sub_actividad">

                            <div class="error campo-requerido" ng-show="formularioNuevo.fecha_inicio_sub_actividad.$invalid && (formularioNuevo.fecha_inicio_sub_actividad.$touched || submitted)">
                                <small class="error" ng-show="formularioNuevo.fecha_inicio_sub_actividad.$error.required">
                                    * Campo requerido.
                                </small>
                            </div>      
                        </div>
                        <div style="clear:both;"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">fecha estamada de fin</label>
                        <div class="col-md-8">
                            <input type="date" text-num-only class="form-control" ng-model="sub_actividad.fecha_aproximada_entrega_sub_actividad" name="fecha_aproximada_entrega_sub_actividad">

                            <div class="error campo-requerido" ng-show="formularioNuevo.fecha_aproximada_entrega_sub_actividad.$invalid && (formularioNuevo.fecha_aproximada_entrega_sub_actividad.$touched || submitted)">
                                <small class="error" ng-show="formularioNuevo.fecha_aproximada_entrega_sub_actividad.$error.required">
                                    * Campo requerido.
                                </small>
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


