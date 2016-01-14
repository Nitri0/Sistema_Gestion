@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="ProyectoController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')

    @include('alerts.mensaje_error')
	@include('alerts.mensaje_success')
	
	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/tipo_proyectos/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Agregar tipo de Proyecto">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>

		<h1 class="page-header"></h1>

        <div class="row">
            <div class="col-12">
                <div class="panel-group" id="accordion">
                	<div class="row text-list">
                		<div class="col-sm-4"> 
                			<div class="row">
                				<div class="col-sm-12">
                        			<i class="fa fa-sitemap"></i> Tipo de Proyecto
                        		</div>
                			</div>
                		</div>
                	</div>

                	<br>
                    @foreach($tipo_proyectos as $tipo_proyecto)
                    <div class="panel panel-inverse overflow-hidden custon-list">
                        <div class="panel-heading">
                            <h3 class="panel-title list-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion" href="#{{$tipo_proyecto->id_tipo_proyecto}}">
                                    <i class="fa fa-plus pull-right"></i> 
                                </a>	
                            </h3>
                            <div class="box-button-list">
		        				<a class="btn btn-sm btn-info btn-cirule" href="{{url('/tipo_proyectos/'.$tipo_proyecto->id_tipo_proyecto.'/edit')}}" data-toggle="tooltip" data-title="Editar"><i class="fa fa-pencil-square-o"></i></a>
		        			</div>
                            <h3 class="panel-title list-title">
                            	<div class="row">
                            		<div class="col-sm-4"> 
                            			<div class="row">
                            				<div class="col-sm-12">
		                            			{{$tipo_proyecto->nombre_tipo_proyecto}}
		                            		</div>
                            			</div>
                            		</div>
                            	</div>                           	 
                            </h3>
                        </div>
                        <div id="{{$tipo_proyecto->id_tipo_proyecto}}" class="panel-collapse collapse">
                            <div class="panel-body">
								<a href="{{url('/tipo_proyectos/'.$tipo_proyecto->id_tipo_proyecto.'/destroy')}}" class="btn btn-sm btn-danger pull-right" data-toggle="tooltip" data-title="Eliminar"><i class="fa fa-trash"></i></a>
                        	</div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
            <div align="center">{!! $tipo_proyectos->render() !!}</div>
        </div>

    </div><!-- content -->
	
</div>
@endsection