@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
        	@if($proyecto->getEstatus()!="Finalizado")
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="/mis-proyectos/avances/{{$proyecto->id_proyecto}}/create" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Crear Avance">
                        <i class="fa fa-line-chart"></i>
                    </a>
                </div>
            </div>
          	@endif
        </ol>
        

        <h1 class="page-header"><i class="fa fa-laptop"></i> Dellate de mi Proyecto </h1>
        
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
                        <h4 class="panel-title">Mis Proyectos</h4>
                    </div>

                    <div class="panel-body">
	<h2>INFORMACION PROYECTO</h2><br>
	nombre: {{ $proyecto->nombre_proyecto }} <br>
	descripcion: {{ $proyecto->direccion_proyecto}} <br>
	Etapa actual de proyecto: {{ $proyecto->getEstatus()}} <br><br><br>

	<h2>INFORMACION CLIENTE</h2><br>
	nombre: {{ $proyecto->getCliente()->nombre_cliente }} <br>
	persona Contacto: {{ $proyecto->getCliente()->persona_contacto_cliente}} <br>
	telefono 1: {{ $proyecto->getCliente()->telefono_cliente}} <br>
	telefono 2: {{ $proyecto->getCliente()->telefono_cliente}} <br>
	correo electronico: {{ $proyecto->getCliente()->email_cliente}} <br>
 
	<br><br><br>

	<h2>INFORMACION DOMINIO</h2><br>
	nombre: {{ $proyecto->getNombreDominio() }} <br>
 
	<br><br><br>

	<h2>ETAPAS</h2><br>
	@foreach($etapas->getEtapas() as $etapa)
		{{$etapa->nombre_etapa}} <br>
		@if ($etapa->getAvances($proyecto->id_proyecto)->first())
		  -- Avances:<br>
		@endif
		@foreach($etapa->getAvances($proyecto->id_proyecto) as $avance)
			---- {{$avance->asunto_avance}} - {{$avance->descripcion_avance}} - {{$avance->fecha_creacion_avance}} - {{$avance->getNombreCreador()}}<br>
		@endforeach
		<br>
	@endforeach

	<br><br>
	integrantes: <br>
	@foreach($rol as $integrante)
		{{$integrante->getUser()->getFullName()}}  - {{$integrante->getRolName()}} <br>
	@endforeach
	<br><br>
	
	
					</div><!-- boby -->
                </div>
            </div>
        </div>

    </div><!-- content -->
	
</div>
@endsection