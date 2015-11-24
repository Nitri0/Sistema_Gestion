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

        <h1 class="page-header"><i class="fa fa-laptop"></i> Lista de Clientes </h1>
        
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
                        <h4 class="panel-title">Clientes</h4>
                    </div>

                    <div class="panel-body">

		@include('alerts.mensaje_success')
		@include('alerts.mensaje_error')

		<table class="table table-hover">
		    <thead>
		      <tr>
		        <th>Nombre</th>
		        <th>CI / RIF</th>
		        <th>Email</th>
		        <th>Contacto</th>
		        <th>Proyecto(s) Asociado(s)</th>
		        <th width="150px" >Operaciones</th>
		      </tr>
		    </thead>
		    <tbody>
		    	@foreach($clientes as $cliente)
			    	<tr>
						<td>{{$cliente->nombre_cliente}}</td>
						<td>{{$cliente->ci_rif_cliente}}</td>
			        	<td>{{$cliente->email_cliente}}</td>
			        	<td>{{$cliente->persona_contacto_cliente}}</td>
			        	<td>
			        			{{$cliente->getProyecto()}}
			        	</td>
			        	<td width="150px">
				        	<form action="/clientes/{{$cliente->id_cliente}}" method="post">
				        		<a class="btn btn-sm btn-info" href="{{ url( '/clientes/'.$cliente->id_cliente ) }}" data-toggle="tooltip" data-title="Detalle"><i class="fa fa-list"></i></a>
				        		<a class="btn btn-sm btn-success" href="{{ url( '/clientes/'.$cliente->id_cliente.'/edit' ) }}" data-toggle="tooltip" data-title="Editar"><i class="fa fa-pencil-square-o"></i></a>
								<input type="hidden" name="_method" value="delete">
								<button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-title="Eliminar"><i class="fa fa-trash"></i></button>
							</form>		        		
			        	</td>
			        </tr>
				@endforeach
		    </tbody>
		</table>

		<div align="center">{!! $clientes->render() !!}</div>
	 
	 				</div><!-- boby -->
                </div>
            </div>
        </div>

    </div><!-- content -->
	
</div>

@endsection