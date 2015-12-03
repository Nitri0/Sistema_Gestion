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
                    	<div class="table-responsive">
                            <table class="table table-profile">
                                <tbody>
                                    <tr>
                                        <td class="field">Nombre</td>
                                        <td>{{ $proyecto->nombre_proyecto }}</td>
                                    </tr>
                                    <tr class="divider">
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="field">Descripción</td>
                                        <td>{{ $proyecto->direccion_proyecto}}</td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="field">Etapa actual de proyecto</td>
                                        <td>{{ $proyecto->getEstatus()}}</td>
                                    </tr>
                                    <tr>
                                        <td class="field">Dominio</td>
                                        <td><a href="http://{{ $proyecto->getNombreDominio() }}" target="_blank" class="label label-info size-label" href="#">{{ $proyecto->getNombreDominio() }}</a></td>
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
                                    <tr>
                                        <td class="field">Nombre</td>
                                        <td>{{ $proyecto->getCliente()->nombre_cliente }}</td>
                                    </tr>
                                     <tr class="highlight">
                                        <td class="field">Persona Contacto</td>
                                        <td>{{ $proyecto->getCliente()->persona_contacto_cliente}}</td>
                                    </tr>
                                    <tr>
                                        <td class="field">Telefono 1</td>
                                        <td><i class="fa fa-mobile fa-lg m-r-5"></i> {{ $proyecto->getCliente()->telefono_cliente}}</td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="field">Telefono 2</td>
                                        <td><i class="fa fa-mobile fa-lg m-r-5"></i> {{ $proyecto->getCliente()->telefono_2_cliente}}</td>
                                    </tr>
                                    <tr class="divider">
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td class="field">Correo Electronico</td>
                                        <td><a href="email:{{ $proyecto->getCliente()->email_cliente}}" class="label label-danger size-label">{{ $proyecto->getCliente()->email_cliente}}</a></td>
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
                        <h4 class="panel-title">Etapas</h4>
                    </div>

                    <div class="panel-body color-timeline">

                    	<ul class="timeline">
                    		@foreach($etapas->getEtapas() as $etapa)
						    <li>
						        <!-- begin timeline-time -->
						        <div class="timeline-time">
						            <span class="date" style="padding-top: 15px; color:#00acac;">{{$etapa->nombre_etapa}}</span>
						        </div>
						        <!-- end timeline-time -->
						        <!-- begin timeline-icon -->
						        <div class="timeline-icon">
						            <a href="javascript:;"><i class="fa fa-star"></i></a>
						        </div>
						        <!-- end timeline-icon -->
						        <!-- begin timeline-body -->
						        <div class="timeline-body">
						           	@if ($etapa->getAvances($proyecto->id_proyecto)->first())
										<center><h5>Avances</h5></center>
									@endif
									<br>
						            <ul class="chats">
	                                    @foreach($etapa->getAvances($proyecto->id_proyecto) as $avance)
	                                    <li class="left">
	                                        <span class="date-time">{{$avance->fecha_creacion_avance}}</span>
	                                        <a href="javascript:;" class="name">{{$avance->getNombreCreador()}}</a>
	                                        <a href="javascript:;" class="image"><img width="50" alt="" src="{{url('img/user.png')}}"></a>
	                                        <div class="message">
	                                        	<h5>{{$avance->asunto_avance}}</h5>
	                                            {{$avance->descripcion_avance}}
	                                        </div>
	                                    </li>
	                                    @endforeach
	                                </ul>
						        </div>
						        <!-- end timeline-body -->
						    </li>
						    @endforeach
						    
						    <li>
						        <div class="timeline-icon">
						            <a href="javascript:;"><i class="fa fa-thumbs-up"></i></a>
						        </div>
						    </li>
						</ul>

					</div><!-- boby -->
                </div>
            </div>
        </div>
		

		<div class="row">
            
            <!-- begin col-12 -->
            <div class="col-md-5 ui-sortable">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Integrantes</h4>
                    </div>

                    <div class="panel-body color-timeline">
						<ul class="media-list media-list-with-divider">
							@foreach($rol as $integrante)
							<li class="media media-sm well">
								<a href="javascript:;" class="pull-left">
									<img src="{{ url('/img/user.png') }}" alt="" class="sm-object rounded-corner">
								</a>
								<div class="media-body media-body-custon">
									<h5 class="media-heading">{{$integrante->getUser()->getFullName()}} </h5>
									<p>{{$integrante->getRolName()}}</p>
								</div>
								<div class="pull-right">
									<form action="/integrantes/{{$integrante->id_rol_usuario}}" method="POST">
										<input type="hidden" name="_method" value="delete">
										<input type="hidden" name="redirect" value="{{url('/proyectos/'.$proyecto->id_proyecto )}}">
										<button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-title="Eliminar"><i class="fa fa-trash"></i></button >
									</form>
								</div>
							</li>
							@endforeach
						</ul>
                    </div><!-- boby -->
                </div>
            </div>

            <div class="col-md-7">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Agergar Integrantes</h4>
                    </div>

                    <div class="panel-body color-timeline">
						<div class="well">
							<form class="form-horizontal" action="/integrantes" method="POST">
								
								<input type="hidden" name="id_proyecto" value="{{$proyecto->id_proyecto}}">
								<input type="hidden" name="redirect" value="{{url('/proyectos/'.$proyecto->id_proyecto )}}">
								
								<div class="form-group">
	                                <label class="col-md-4 control-label ng-binding">Integrante</label>
	                                <div class="col-md-8">
	                                    <select class="form-control js-example-data-array" name="id_usuario">
	                                        <option value="">Seleccione un Usuario</option>
	                                        @foreach($usuarios as $usuario)
	                                        	<option class="option" value="{{$usuario->id_usuario}}">
	                                        		{{ $usuario->getFullName()}}
	                                        	</option>
	                                        @endforeach
										</select>
	                                </div>
	                            </div>
	                            
	                            <div class="form-group">
	                                <label class="col-md-4 control-label ng-binding">Rol que cumplirá</label>
	                                <div class="col-md-8">
	                                    <select class="form-control js-example-data-array" name="id_tipo_rol">
	                                        <option value="">Seleccione un Usuario</option>
	                                        @foreach($roles as $rol)
												<option value="{{$rol->id_tipo_rol }}">
													{{ $rol->nombre_tipo_rol }} 
												</option>
											@endforeach
										</select>
	                                </div>
	                            </div>
	                            <br>
								<center>
									<button type="submit"  class="btn btn-primary m-r-5 m-b-5"><i class="fa fa-plus"></i> Agregar Integrantes</button>
								</center>		
							</div>
						</form>
                    	
                    </div><!-- boby -->
                </div>
            </div>
        
        </div>

    </div><!-- content -->
	
</div>
@endsection