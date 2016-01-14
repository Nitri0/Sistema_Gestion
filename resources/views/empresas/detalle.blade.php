@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/admin_empresas/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Agregar Empresas">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>
        

        <h1 class="page-header"><i class="fa fa-laptop"></i> Lista de Empresas </h1>
        
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-4 ui-sortable">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand" data-original-title="" title=""><i class="fa fa-expand"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload" data-original-title="" title=""><i class="fa fa-repeat"></i></a>
                            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse" data-original-title="" title=""><i class="fa fa-minus"></i></a>
                        </div>
                        <h4 class="panel-title">Empresas</h4>
                    </div>

                    <div class="panel-body">

                    <div class="table-responsive">
                            <table class="table table-profile">
                                <tbody>
                                    <tr>
                                        <td class="field">Nombre</td>
                                        <td>{{ $empresa->nombre_empresa }}</td>
                                    </tr>
                                    <tr class="divider">
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="field">Dirección</td>
                                        <td>{{ $empresa->direccion_empresa}}</td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="field">Email</td>
                                        <td><span class="label label-danger">{{ $empresa->email_empresa}}</span></td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="field">Telefono</td>
                                        <td>{{ $empresa->telefono_empresa}}</td>
                                    </tr>
                                    <tr>
                                        <td class="field">RIF</td>
                                        <td><span class="label label-info size-label">{{ $empresa->rif_empresa}}</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

					</div><!-- boby -->
                </div>
            </div>
        </div>

    </div><!-- content -->
	
</div>
@endsection