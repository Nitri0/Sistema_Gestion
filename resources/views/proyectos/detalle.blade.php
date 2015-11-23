@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
        	
            <div class="btn-toolbar">
                @if($proyecto->habilitado_proyecto)
                <div class="btn-group">
                	<form action="/proyectos/finalizar/{{$proyecto->id_proyecto}}" method="post">
	                    <button type="submit" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Finalizar Proyecto">
	                        <i class="fa fa-thumbs-up"></i>
	                    </button>
                    </form>
                </div>
                @else
                <div class="btn-group">
                	<form action="/proyectos/reabrir/{{$proyecto->id_proyecto}}" method="post">
	                    <button  class="btn btn-warning btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Habilitar Proyecto">
	                        <i class="fa fa-unlock"></i>
	                    </button>
                    </form>
                </div>
          		@endif
                <div class="btn-group">
                	<form action="/proyectos/{{$proyecto->id_proyecto}}" method="post">
                		<input type="hidden" name="_method" value="delete">
	                    <button type="submit" class="btn btn-danger btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Eliminar Proyecto">
	                        <i class="fa fa-trash"></i>
	                    </button>
                    </form>
                </div>
                
			</div>
        </ol>
        

        <h1 class="page-header"><i class="fa fa-laptop"></i> Dellate del Proyecto </h1>
        
		<div class="row">
            
            <!-- begin col-12 -->
            <div class="col-md-6 ui-sortable">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Información del Proyecto</h4>
                    </div>

                    <div class="panel-body">
                    	<br>
                    	<div class="table-responsive">
                            <table class="table table-profile">
                                <tbody>
                                    <tr class="highlight">
                                        <td class="field">Nombre</td>
                                        <td><a href="#">{{ $proyecto->nombre_proyecto }}</a></td>
                                    </tr>
                                    <tr class="divider">
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td class="field">Descripción</td>
                                        <td>{{ $proyecto->direccion_proyecto}}</td>
                                    </tr>
                                    <tr class="divider">
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="field">Etapa actual de proyecto</td>
                                        <td><a href="#">{{ $proyecto->getEstatus()}}</a></td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="field">Dominio</td>
                                        <td><a href="http://{{ $proyecto->getNombreDominio() }}" target="_blank" class="label label-info" href="#">{{ $proyecto->getNombreDominio() }}</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

					</div><!-- boby -->
                </div>
            </div>

            <!-- begin col-12 -->
            <div class="col-md-6 ui-sortable">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Información del Cliente</h4>
                    </div>

                    <div class="panel-body">
                    	<div class="table-responsive">
                            <table class="table table-profile">
                                <tbody>
                                    <tr class="highlight">
                                        <td class="field">Nombre</td>
                                        <td><a href="#">{{ $proyecto->getCliente()->nombre_cliente }}</a></td>
                                    </tr>
                                    <tr class="divider">
                                        <td colspan="2"></td>
                                    </tr>
                                     <tr class="highlight">
                                        <td class="field">Persona Contacto</td>
                                        <td><a href="#">{{ $proyecto->getCliente()->persona_contacto_cliente}}</a></td>
                                    </tr>
                                    <tr>
                                        <td class="field">Telefono 1</td>
                                        <td><i class="fa fa-mobile fa-lg m-r-5"></i> {{ $proyecto->getCliente()->telefono_cliente}}  <a href="#" class="m-l-5">Edit</a></td>
                                    </tr>
                                    <tr>
                                        <td class="field">Telefono 2</td>
                                        <td><i class="fa fa-mobile fa-lg m-r-5"></i> {{ $proyecto->getCliente()->telefono_cliente}}</td>
                                    </tr>
                                    <tr class="divider">
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="field">Correo Electronico</td>
                                        <td><a href="email:{{ $proyecto->getCliente()->email_cliente}}" class="label label-danger">{{ $proyecto->getCliente()->email_cliente}}</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

					</div><!-- boby -->
                </div>
            </div>
        
        </div>

    	<div class="row">
            
            <!-- begin col-12 -->
            <div class="col-12 ui-sortable">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Información del Proyecto</h4>
                    </div>

                    <div class="panel-body">

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

	<br><br><br>
	<h2>INTEGRANTES</h2><br>
	@foreach($rol as $integrante)
		{{$integrante->getUser()->getFullName()}} - {{$integrante->getRolName()}} 
		<form action="/integrantes/{{$integrante->id_rol_usuario}}" method="POST">
			<input type="hidden" name="_method" value="delete">
			<input type="hidden" name="redirect" value="{{url('/proyectos/'.$proyecto->id_proyecto )}}">
			<button type="submit" class="btn btn-sm btn-danger">Eliminar integrante</button >
		</form>
		 <br>
		 <br>
		 <br>
	@endforeach
	Agregar integrante
	<form action="/integrantes" method="POST">
		<div class="from-group">
			<input type="hidden" name="id_proyecto" value="{{$proyecto->id_proyecto}}">
			<input type="hidden" name="redirect" value="{{url('/proyectos/'.$proyecto->id_proyecto )}}">

			<label for="">Integrante </label>
			<select class="form-control" name="id_usuario">
				<option class="option" value="">Seleccione un Usuario</option>
				@foreach($usuarios as $usuario)
					<option class="option" value="{{$usuario->id_usuario}}">
						{{ $usuario->getFullName()}}
					</option>
				@endforeach
			</select>
			<label for="">Rol que cumplirá</label>
			<select class="form-control" name="id_tipo_rol">
				<option class="option" value="">Seleccione un Rol</option>
				@foreach($roles as $rol)
					<option class="option" value="{{$rol->id_tipo}}">
						{{ $rol->nombre_tipo }} 
					</option>
				@endforeach
			</select>
			<button type="submit" class="btn btn-sm btn-success">Agregar</button >				
		</div>
	</form>
	


					</div><!-- boby -->
                </div>
            </div>
        </div>

    </div><!-- content -->
	
</div>
@endsection