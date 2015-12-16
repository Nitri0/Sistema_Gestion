@extends('base-admin')

@section('js')
    <script src="{{ asset('/js/controllers/helper.js') }}"></script>
@endsection

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="GrupoEtapasController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope" ng-controller="SubmitController">
        
        <div ng-init="urlRedirect='{{ url('tipo_proyectos/') }}'"></div>

        @if($tipo_proyecto)
        
        <h1 class="page-header"><i class="fa fa-laptop"></i> Editar tipo de proyecto </h1>
        <div ng-init="model={{ $tipo_proyecto }}"></div>
        <div ng-init="urlAction='{{ url('tipo_proyectos/'.$tipo_proyecto->id_tipo_proyecto) }}'"></div>
        <form class="form-horizontal" name="formulario" id="formulario" action="{{ url('tipo_proyectos/'.$tipo_proyecto->id_tipo_proyecto) }}" method="POST">
        <input type="hidden" name="_method" value="PUT">
        
        @else
        <div ng-init="urlAction='{{ url('tipo_proyectos/') }}'"></div>
        <h1 class="page-header"><i class="fa fa-laptop"></i>  Crear tipo de proyecto </h1>
        <form class="form-horizontal" name="formulario" id="formulario" action="{{ url('tipo_proyectos/') }}" method="POST">      
        
        @endif

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
                            <h4 class="panel-title">Tipo de Proyectos</h4>
                        </div>

                        <div class="panel-body">	
                            
                            <br>

							<div class="form-group">
                                <label class="col-md-4 control-label">Identificador de proyectos</label>
                                <div class="col-md-5">
                                    <input type="text" class="form-control" ng-model="model.nombre_tipo_proyecto" name="nombre_tipo_proyecto" ng-required="true" oninvalid="setCustomValidity(' ')">
                                    <div class="error campo-requerido" ng-show="formulario.nombre_tipo_proyecto.$invalid && (formulario.nombre_tipo_proyecto.$touched || submitted)">
                                        <small class="error" ng-show="formulario.nombre_tipo_proyecto.$error.required">
                                            * Campo requerido.
                                        </small>
                                    </div>
                                </div>
                            </div>									

                            <br>

							<center>
                                @if($tipo_proyecto)
                                    <button type="button" ng-click="submit(formulario.$valid)" class="btn btn-danger m-r-5 m-b-5">
                                        Actualizar <i class="fa fa-undo"></i>
                                    </button>
                                @else
                                    <button type="button" ng-click="submit(formulario.$valid)" class="btn btn-info m-r-5 m-b-5">
                                        Registrar <i class="fa fa-pencil-square-o"></i>
                                    </button>
                                @endif
                            </center>

    					</div><!-- boby -->
                    </div>
                </div>
            </div>
        </form>

    </div><!-- content -->
	
</div>
@endsection

