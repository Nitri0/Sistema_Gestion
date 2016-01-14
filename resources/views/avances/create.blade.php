@extends('base-admin')

@section('js')
    <script src="{{ asset('/bower_components/ckeditor/ckeditor.js') }}"></script>
@endsection


@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="AvanceController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope"  >

		<!--<ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/mis-proyectos/[[proyecto.id_proyecto]]' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Detalle">
                        <i class="fa fa-list"></i>
                    </a>
                </div>
            </div>
        </ol>-->
        <div ng-init="urlRedirect='{{ url('mis-proyectos/') }}'"></div>
        <h1 class="page-header"><i class="fa fa-laptop"></i> Crear avance de mi Proyecto </h1>
        <div ng-init="urlAction='{{ url('/mis-proyectos/avances/'.$id_proyecto.'/create') }}'"></div>
        <form class="form-horizontal" action="" id="formulario" name="formulario" method="POST">       

            <div class="row">
                <!-- begin col-12 -->
                <div class="col-12 ui-sortable">
                    <!-- begin panel -->
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand" data-original-title="" title=""><i class="fa fa-expand"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload" data-original-title="" title=""><i class="fa fa-repeat"></i></a>
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse" data-original-title="" title=""><i class="fa fa-minus"></i></a>
                            </div>
                            <h4 class="panel-title">Crear avance</h4>
                        </div>

                        <div class="panel-body">
    							
							<div class="from-group">
								<label class="col-md-4 control-label">Etapa/Sprint/Paso: </label>
								<div class="col-md-5"> 
									<h6 class="text-success">{{$proyecto->getEstatus()}}</h6>
								</div>
								<input type="hidden" class="form-control" name="id_etapa" ng-value='{{$proyecto->getIdEtapa()}}'>
							</div>			

							<div class="form-group">
                                <label class="col-md-4 control-label">¿Avance de cierre de etapa?</label>
                                <div class="col-md-5">
                                    <label class="radio-inline">
                                        <input type="radio" name="check_cierre_etapa" value="1">
                                        si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="check_cierre_etapa" value="0" checked="checked">
                                        no
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
								<label class="col-md-4 control-label"> Asunto </label>
								<div class="col-md-5">
									<input type="text" text-num-only class="form-control" ng-model="avance.notificacion_avance" name="asunto_avance" ng-required="true" oninvalid="setCustomValidity(' ')">
                                    <div class="error campo-requerido" ng-show="formulario.asunto_avance.$invalid && (formulario.asunto_avance.$touched || submitted)">
                                        <small class="error" ng-show="formulario.asunto_avance.$error.required">
                                            * Campo requerido.
                                        </small>
                                    </div>                                      
                                </div>
							</div>

							<div class="form-group">
                                <label class="col-md-4 control-label">¿Con copia al cliente?</label>
                                <div class="col-md-5">
                                    <label class="radio-inline">
                                        <input type="radio" name="check_copia_cliente_avance" ng-model="check" value="1">
                                        si
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="check_copia_cliente_avance" ng-model="check" value="0" checked="checked">
                                        no
                                    </label>
                                </div>
                            </div>

                            <div class="form-group" ng-if="check==1">
								<label class="control-label col-md-4">Plantillas</label>
								<div class="col-md-5">
								    <select class="form-control js-example-data-array" name="id_plantilla" ng-model="id_plantilla" ng-required="true" oninvalid="setCustomValidity(' ')">
                                        <option class="option" value="">Seleccione una plantilla</option>
                                        @foreach($plantillas as $plantilla)
												<option class="option" value="{{$plantilla->id_plantilla}}">
													{{ $plantilla->nombre_plantilla }}
												</option>							
										@endforeach	
                                    </select>
                                    <div class="error campo-requerido" ng-show="formulario.id_plantilla.$invalid && (formulario.id_plantilla.$touched || submitted)">
                                        <small class="error" ng-show="formulario.id_plantilla.$error.required">
                                            * Campo requerido.
                                        </small>
                                    </div>                                          
                                </div>
                                <div class="col-md-2">
									<a class="btn btn-sm btn-success" ng-if="id_plantilla" target="_blank" href="{{ url( '/plantillas/preview/'.$proyecto->id_proyecto.'/[[id_plantilla]]/' ) }}"> preview <i class="fa fa-eye"></i></a>
								</div>
							</div>

                            <div class="btn-ayuda">
                                <a href="#ayuda" class="btn btn-sm btn-info" data-toggle="modal">
                                    <i class="fa fa-life-ring"></i>
                                </a>
                            </div>
                            @include('modals/ayuda')
    							
    					</div><!-- boby -->
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="panel panel-inverse" data-sortable-id="form-wysiwyg-1">
                        <div class="panel-heading">
                            <div class="panel-heading-btn">
                                <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                            </div>
                            <h4 class="panel-title">Descripción</h4> 
                        </div>
                        <div class="panel-body panel-form">
                            <textarea class="ckeditor" ck-editor id="editor1" rows="30" ng-model="avance.descripcion_avance" name="descripcion_avance" ng-required="true" oninvalid="setCustomValidity(' ')">
                            
                            </textarea>
                            <div class="error campo-requerido" ng-show="formulario.descripcion_avance.$invalid && (formulario.descripcion_avance.$touched || submitted)">
                                <small class="error" ng-show="formulario.descripcion_avance.$error.required">
                                    * Campo requerido.
                                </small>
                            </div>                                 
                        </div>
                    </div>
                </div>

            </div>
        <center>
            <button class="btn btn-success m-r-5 m-b-5" type="button" ng-click="submit(formulario.$valid)">
                    Registrar <i class="fa fa-pencil-square-o"></i>
            </button>
        </center>
        </form>
        

    </div><!-- content -->
	
</div>
@endsection