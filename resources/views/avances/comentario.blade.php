@extends('base-admin')

@section('js')
    <script src="{{ asset('/bower_components/ckeditor/ckeditor.js') }}"></script>
@endsection


@section('content')

<div id="page-container" ng-controller="AvanceController">
	
	<div id="content" class="content ng-scope" style="margin-left: 0;"  >
        <div ng-show="viewBolean">  
            <div ng-init="urlRedirect='{{ url('mis-proyectos/') }}'"></div>
                <h1 class="page-header">Agregar comentario al avance.</h1>
                <div ng-init="urlAction='{{ url('avances') }}'"></div>
                <form class="form-horizontal" action="" id="formulario" name="formulario" method="POST" ng-init="initCommentForm({{$avance}})">       
        			<input type="text" ng-model="comentario.id_avance" ng-hide="true" name="id_avance">
                    <div class="row">
                        <!-- begin col-12 -->
                        <div class="col-md-12">
                            <div class="panel panel-inverse" data-sortable-id="form-wysiwyg-1">
                                <div class="panel-heading-2">
                                    <div class="panel-heading-btn">
                                        
                                    </div>
                                    <h4 class="panel-title">Descripción</h4> 
                                </div>                        
                                <div class="panel-body panel-form">
                                    <textarea class="ckeditor" ck-editor id="editor1" rows="30" ng-model="comentario.contenido_avance_comentario" name="contenido_avance_comentario" ng-required="true" oninvalid="setCustomValidity(' ')">
                                    
                                    </textarea>                              
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                             <div  flow-init="{target: '/KeySysGestion/Sistema_Gestion/public/actividades/adjuntar'}" flow-files-submitted="adjuntoComentario($flow)"><!--flow-name="adjuntos.flow"-->     
                                <input type="file" flow-btn/>
                                Total files #[[$flow.files.length]]
                            </div>
                        </div>

                    </div>
                <center>
                    <button class="btn btn-success m-r-5 m-b-5" type="button" ng-click="submitCommentForm()">
                        Registrar <span ng-show="snipper===true" class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>
                    </button>
                </center>
                </form>               

        </div><!-- content -->
        <div ng-hide="viewBolean">
            <h2>Comentario agregado</h2>
        </div>
	</div>
    @include('modals/ayuda')

</div>
@endsection