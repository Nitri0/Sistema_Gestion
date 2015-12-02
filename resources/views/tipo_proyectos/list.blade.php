@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="ProyectoController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
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
        

        <h1 class="page-header"><i class="fa fa-sitemap"></i> Tipos de Proyecto </h1>
		
		@include('alerts.mensaje_error')
		@include('alerts.mensaje_success')

        <div class="row">
			<!-- begin col-3 -->
			@foreach($tipo_proyectos as $tipo_proyecto)
			<div class="col-md-3 col-sm-6">
				<div class="widget widget-stats bg-blue">
					<div class="stats-icon"><i class="fa fa-sitemap"></i></div>
					<div class="stats-info">
						<h4>PROYECTO</h4>
						<p>{{$tipo_proyecto->nombre_tipo_proyecto}}</p>	
					</div>
					<div class="stats-link">
						<a href="javascript:;">Detalle <i class="fa fa-arrow-circle-o-right"></i></a>
					</div>
				</div>
			</div>
			@endforeach
			<!-- end col-3 -->

			<div align="center">{!! $tipo_proyectos->render() !!}</div>
		</div>

    </div><!-- content -->
	
</div>
@endsection