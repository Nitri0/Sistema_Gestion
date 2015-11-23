@extends('base-admin')

@section('content')


<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="DominioController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">

        <h1 class="page-header"><i class="fa fa-link"></i> Crear Dominio </h1>
        
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
                        <h4 class="panel-title">Dominio</h4>
                    </div>

                    <div class="panel-body">
	
		@if($dominio)
			<h2>Editar Dominio</h2>
			<div ng-init="dominio={{$dominio}}"></div>
			
			<form action="{{ url('dominios/'.$dominio->id_dominio) }}" method="POST" novalidate>
			<input type="hidden" name="_method" value="PUT">
		@else
			<h2>Crear Dominio</h2>
			<form action="{{ url('dominios/') }}" method="POST" novalidate>

		@endif
			<br><br>

		@if($proyecto)
			<label for="">Proyecto:</label>
			<label for="">{{$proyecto->nombre_proyecto}} - {{$proyecto->getCliente()->nombre_cliente}}</label>
		@else
			<div class="from-group">
				<label for="">Proyecto</label>
				<select class="form-control" name="id_proyecto" required>
					<option class="option" value="">Seleccione un proyecto</option>
					@foreach($proyectos as $key)
						<option class="option" value="{{$key->id_proyecto}}">
							{{$key->nombre_proyecto}} - {{$key->getCliente()->nombre_cliente}}</option>
					@endforeach
				</select>
			</div>					
		@endif
					
			<br>			
			<div class="from-group">
				<label for="">Empresa proveedora</label>
				<select class="form-control" name="id_empresa_proveedora">
					<option class="option" value="">Seleccione una empresa proveedora</option>
					@foreach($empresas_proveedoras as $key)
						<option class="option" value="{{$key->id_empresa_proveedora}}"
						@if($dominio && $dominio->id_empresa_proveedora==$key->id_empresa_proveedora) 
							selected 
						@endif >
							{{$key->nombres_empresa_proveedora}}</option>
					@endforeach
		
				</select>
				<button >
					<a href="{{ url('/empresas_proveedoras/create') }}">Agregar una empresa proveedora</a>
				</button>
			</div>

			<br>
			<div class="from-group">
				<label for="">Nombre dominio</label>
				<input type="text" class="form-control" ng-model="dominio.nombre_dominio" name="nombre_dominio">
			</div>	
			

			<br>
			<div class="from-group">
				<label for="">Espacio de disco asignado</label>
				<select class="form-control" name="espacio_asignado_dominio" ng-model="dominio.espacio_asignado_dominio">
					<option class="option" value="">Seleccione un tamaño</option>
					@foreach($tamanos as $key=> $value)
						<option class="option" value="{{$key}}">{{$value}}</option>
					@endforeach
				</select>

			</div>	
			<br>

			<div class="from-group">
				<label for="">Fecha de creacion de dominio</label>
				<input type="date" class="form-control" ng-value="dominio.fecha_dominio" name="fecha_dominio">
			</div>	
			<br><br>
			<button type="submit">
				@if($dominio)
					Actualizar
				@else
					Registrar
				@endif
			</button>
		</form>

					</div><!-- boby -->
                </div>
            </div>
        </div>

    </div><!-- content -->
	
</div>

@endsection