@extends('base-admin')

@section('js')
    <script src="{{ asset('/js/controllers/actividades.js') }}"></script>    
@endsection

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed page-content-full-height" ng-controller="ActividadController">
    
    @include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
    
    @include('alerts.mensaje_error')
    @include('alerts.mensaje_success')

    <!-- Modal -->
    @include('modals/actividades/adjuntar')
    @include('modals/actividades/sub_actividad')
    @include('modals/actividades/actividad')

    <div ng-init="initProyectos({{$proyectos}},{{$actividadesPersonales}},{{Auth::user()->id_usuario}})"></div><!--actividades={{$proyectos}}-->
    <div ng-init="url='{{url()}}'"></div>
    <!-- content -->
    <div id="content" class="content content-full-width" style="bottom:0px!important">
        <div class="vertical-box">
            <div class="vertical-box-column width-250">
                <div class="vertical-box">
                    <div class="wrapper bg-griss">
                        Lista de Proyectos
                    </div>
                    <div class="vertical-box-row bg-white">
                        <div class="vertical-box-cell">
                            <div class="vertical-box-inner-cell">
                                <div data-scrollbar="true" data-height="100%" class="wrapper-7">

                                    <div class="panel panel-inverse overflow-hidden custon-list" ng-click="initActividades(null)">
                                        <div class="panel-heading">
                                            <h3 class="panel-title list-title">
                                                <div class="row">
                                                    <div class="col-sm-10"> 
                                                        <div class="row">
                                                            <div class="col-sm-2 color-fa-star"> <i class="fa fa-star"></i> </div>
                                                            <div class="col-sm-10">
                                                                Mis Actividades 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                               
                                            </h3>
                                        </div>
                                    </div> 

                                    <div class="panel panel-inverse overflow-hidden custon-list" style="margin-bottom: 5px;" ng-repeat="(clave, proyecto) in proyectos" ng-click="initActividades(clave , proyecto.nombre_proyecto)">
                                        <div class="panel-heading">
                                            <h3 class="panel-title list-title">
                                                <div class="row">
                                                    <div class="col-sm-8"> 
                                                        <div class="row">
                                                            <div class="col-sm-1"> [[clave+1]] </div>
                                                            <div class="col-sm-9 text-ellipsis">
                                                                [[proyecto.nombre_proyecto]]
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                               
                                            </h3>
                                        </div>
                                    </div> 

                                </div>
                            </div>
                        </div>
                    </div>
                    <div ng-show="nombre_proyecto_select" class="wrapper bg-griss" style="color: #00acac;text-transform: capitalize;">
                        <i class="fa fa-check-circle-o"></i> [[nombre_proyecto_select]]
                    </div>
                </div>
            </div>
            <div class="vertical-box-column">
                <div class="vertical-box">
                    <div class="vertical-box-row">
                        <div class="vertical-box-cell">
                            <div class="vertical-box-inner-cell">
                                <div data-scrollbar="true" data-height="100%" class="wrapper">
                                    <div class="row">
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
                                                       <div class="panel panel-inverse overflow-hidden custon-list" ng-repeat="(clave, actividad) in actividades | filter:filterTask" ng-click="datosActividad(actividad.id_actividad)">
                                                            <div class="panel-heading">
                                                                <!--<h3 class="panel-title list-title">
                                                                    <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#[[clave]]">
                                                                        <i class="fa fa-plus pull-right"></i> 
                                                                    </a>    
                                                                </h3>-->
                                                                <div class="box-button-list" style="  margin-right: -5px;">
                                                                    <button class="btn btn-list" ng-click="editModal(actividad.id_actividad)">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </button>
                                                                    <button class="btn btn-list" data-toggle="modal" data-target="#adjunto">
                                                                        <i class="fa fa-paperclip"></i>
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
                                                            <!--<div id="[[clave]]" class="panel-collapse collapse">
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
                                                                    <!--<button class="btn btn-success btn-sm" ng-click="editModal(activitySelected.id_actividad)">

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
                                                                <div class="no-consulta" ng-if="activitySelected.comentarios.length == 0">
                                                                    <i class="fa fa-comments"></i>
                                                                    <p >No tiene comentarios</p>
                                                                </div>
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
                                                                <div class="no-consulta" ng-if="activitySelected.subActividades.length == 0">
                                                                    <i class="fa fa-thumb-tack"></i>
                                                                    <p >No tiene Sub-actividades</p>
                                                                </div>
                                                                <div class="panel-group">
                                                                    <div class="panel panel-inverse overflow-hidden custon-list" ng-repeat="(clave, sub_actividad) in activitySelected.subActividades" >
                                                                        <div class="panel-heading">
                                                                            <h3 class="panel-title list-title">
                                                                                <!--<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#sub_[[clave]]">
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
                                                                <div class="no-consulta" ng-if="activitySelected.adjuntos.length == 0">
                                                                    <i class="fa fa-paperclip"></i>
                                                                    <p >No tiene archivos adjuntos</p>
                                                                </div>
                                                                <a href="../adjuntos/[[adjunto.url_adjunto]]" target="_blank" ng-repeat="(clave, adjunto) in activitySelected.adjuntos" class="adjunto">
                                                                    <div class="referencia_adjunto" ng-if="adjunto.tipo_adjunto == 'jpg' || adjunto.tipo_adjunto == 'png'" style="background-image:url('../adjuntos/[[adjunto.url_adjunto]]');"></div>
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
                                                                <div class="no-consulta" ng-if="activitySelected.comentarios.length == 0">
                                                                    <i class="fa fa-comments"></i>
                                                                    <p >No tiene comentarios</p>
                                                                </div>
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
    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end #content -->
</div>

@endsection