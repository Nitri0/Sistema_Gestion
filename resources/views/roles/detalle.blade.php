@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
    
    @include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
    
    <div id="content" class="content ng-scope">

        <h1 class="page-header"><i class="fa fa-link"></i> Detalle de Rol </h1>
        
        <div class="row">
            <!-- begin col-4 -->
            <div class="col-md-4 ui-sortable">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        
                        <h4 class="panel-title">Rol</h4>
                    </div>

                    <div class="panel-body">
                        <table class="table table-valign-middle m-b-0">
                            <tbody>
                                <tr>
                                    <td>Nombre: <span class="text-success"></span></td>
                                    <td><label class="label label-danger size-label">{{ $rol->nombre_tipo_rol}}</label></td>
                                </tr>
                                <tr>
                                    <td>descripcion: <span class="text-success"></span></td>
                                    <td><label class="label label-info size-label">{{ $rol->descripcion_tipo_rol}}</label></td>
                                </tr>
                            </tbody>
                        </table>
                    </div><!-- boby -->
                </div>
            </div>
        </div>

    </div><!-- content -->
    
</div>

@endsection