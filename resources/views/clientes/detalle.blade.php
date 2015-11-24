@extends('base-admin')

@section('content')


<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/clientes/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>

        <h1 class="page-header"><i class="fa fa-laptop"></i> Detalle del Cliente </h1>
        
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
                        <h4 class="panel-title">Cliente</h4>
                    </div>

                    <div class="panel-body">

                    	<div class="table-responsive">
                            <table class="table table-profile">
                                <tbody>
                                    <tr>
                                        <td class="field">Nombre</td>
                                        <td><a>{{ $cliente->nombre_cliente }}</a></td>
                                    </tr>
                                    <tr class="divider">
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="field">Dirección</td>
                                        <td>{{ $cliente->direccion_cliente}}</td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="field">Email</td>
                                        <td><span class="label label-danger">{{ $cliente->email_cliente}}</span></td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="field">Telefono</td>
                                        <td><i class="fa fa-mobile fa-lg m-r-5"></i> {{ $cliente->telefono_cliente}}</td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="field">Telefono 2</td>
                                        <td><i class="fa fa-mobile fa-lg m-r-5"></i> {{ $cliente->telefono_2_cliente}}</td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="field">rif/ci</td>
                                        <td><span class="label label-success">{{ $cliente->ci_rif_cliente}} </span></td>
                                    </tr>
                                    <tr>
                                        <td class="field">Persona de contacto</td>
                                        <td><span class="label label-danger">{{ $cliente->persona_contacto_cliente}} </span></td>
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