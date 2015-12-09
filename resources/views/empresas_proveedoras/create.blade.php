@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="ProveedorController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
        
        @if($empresa_proveedora)
        
        <h1 class="page-header"><i class="fa fa-laptop"></i> Editar Empresa Proveedora </h1>
        <div ng-init="empresa_proveedora={{ $empresa_proveedora }}"></div>
        <form class="form-horizontal" action="{{ url('empresas_proveedoras/'.$empresa_proveedora->id_empresa_proveedora) }}" method="POST">
        <input type="hidden" name="_method" value="PUT">
        @else
   		
   		<h1 class="page-header"><i class="fa fa-laptop"></i> Crear Empresa Proveedora </h1>
   		<form class="form-horizontal" action="{{ url('empresas_proveedoras/') }}" method="POST">	
       	
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
	                        <h4 class="panel-title">Empresa Proveedora</h4>
	                    </div>

	                    <div class="panel-body">

		                    <div class="form-group">
	                            <label class="col-md-4 control-label">Nombres de empresa proveedora</label>
	                            <div class="col-md-5">
	                                <input type="text" class="form-control" ng-model="empresa_proveedora.nombres_empresa_proveedora" name="nombres_empresa_proveedora">
	                            </div>
	                        </div>	

	                        <div class="form-group">
	                            <label class="col-md-4 control-label">Telefono de empresa proveedora</label>
	                            <div class="col-md-5">
	                                <input type="text" class="form-control" ng-model="empresa_proveedora.telefono_empresa_proveedora" name="telefono_empresa_proveedora">
	                            </div>
	                        </div>	

							<br>

							<center>
							@if($empresa_proveedora)
								<button class="btn btn-danger m-r-5 m-b-5"type="submit"> Actualizar <i class="fa fa-refresh"></i></button>
							@else
								<button class="btn btn-success m-r-5 m-b-5" type="submit"> Registrar <i class="fa fa-pencil-square-o"></i></button>
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
