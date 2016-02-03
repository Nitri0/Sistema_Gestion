@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
    
    @include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
    
    <div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <form action="/tipo_proyectos/{{$grupo_etapas->id_grupo_etapas}}" method="post">
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-list" data-toggle="tooltip" data-title="Grupo de Etapas"><i class="fa fa-trash"></i></button>
                    </form>
                </div>
            </div>
        </ol>

        <h1 class="page-header">Detalle de Grupo de Etapa</h1>
        
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-12 ui-sortable">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading-2">
                        <h4 class="panel-title">Detalle de Etapas</h4>
                    </div>

                    <div class="panel-body">
                        <br>
                        <div class="row">
                            <div class="col-md-1">
                                Nombre
                            </div>
                            <div class="col-md-3">
                                {{ $grupo_etapas->nombre_grupo_etapas }}
                            </div>
                            <div class="col-md-1">
                                Descripción
                            </div>
                            <div class="col-md-4">
                                {{ $grupo_etapas->descripcion_grupo_etapas}}
                            </div>
                            <div class="col-md-2">
                                Cantidad de Etapas
                            </div>
                            <div class="col-md-1">
                                {{ $grupo_etapas->cantidad_etapas}}
                            </div>
                        </div>
                        <br>
                    </div><!-- boby -->
                </div>
            </div>
        
        </div>

        <div class="row">

            <center>
                <h3 class="title">Lista de Etapas</h3>
            </center>
            <br>
            <br>

            <ul class="timeline">
                @foreach($grupo_etapas->getEtapas() as $etapa)
                <li>
                    <!-- begin timeline-time -->
                    <div class="timeline-time">
                        <span class="time"></span>
                    </div>
                    <!-- end timeline-time -->
                    <!-- begin timeline-icon -->
                    <div class="timeline-icon">
                        <a href="javascript:;">{{$etapa->numero_orden_etapa}}</a>
                    </div>
                    <!-- end timeline-icon -->
                    <!-- begin timeline-body -->
                    <div class="timeline-body">
                        <div class="timeline-content">
                            <p>
                                {{$etapa->nombre_etapa}}
                            </p>
                        </div>
                    </div>
                    <!-- end timeline-body -->
                </li>
                @endforeach
                <li>
                    <!-- begin timeline-icon -->
                    <div class="timeline-icon">
                        <a href="javascript:;"><i class="fa fa-sort-amount-asc"></i></a>
                    </div>
                </li>
            </ul>
            
        </div>

    </div><!-- content -->
    
</div>

@endsection