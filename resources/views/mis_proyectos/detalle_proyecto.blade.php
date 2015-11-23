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
        

        <h1 class="page-header"><i class="fa fa-laptop"></i> Dellate del Proyecto </h1>
        

    	<div class="row">
            
            <!-- begin col-4 -->
            <div class="col-md-4 ui-sortable">
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
                                        <td><a>{{ $proyecto->nombre_proyecto }}</a></td>
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
                                        <td><span class="label label-danger">{{ $proyecto->getEstatus()}}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="field">Dominio</td>
                                        <td><a href="http://{{ $proyecto->getNombreDominio() }}" target="_blank" class="label label-info">{{ $proyecto->getNombreDominio() }}</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>		
					</div><!-- boby -->
                </div>
            </div>
        
            <div class="col-md-4 ui-sortable">
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
                                        <td><a>{{ $proyecto->getCliente()->nombre_cliente }}</a></td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="field">Persona Contacto</td>
                                        <td><a>{{ $proyecto->getCliente()->persona_contacto_cliente}}</a></td>
                                    </tr>
                                    <tr>
                                        <td class="field">Telefono 1</td>
                                        <td><i class="fa fa-mobile fa-lg m-r-5"></i> {{ $proyecto->getCliente()->telefono_cliente}}</td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="field">Telefono 2</td>
                                        <td><i class="fa fa-mobile fa-lg m-r-5"></i> {{ $proyecto->getCliente()->telefono_cliente}}</td>
                                    </tr>
                                    <tr>
                                        <td class="field">Correo Electronico</td>
                                        <td><span class="label label-danger">{{ $proyecto->getCliente()->email_cliente}}</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>		
					</div><!-- boby -->
                </div>
            </div>

            <div class="col-md-4 ui-sortable">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Integrantes</h4>
                    </div>

                    <div class="panel-body">
						<ul class="media-list media-list-with-divider media-messaging">
							@foreach($rol as $integrante)
							<li class="media media-sm">
								<a href="javascript:;" class="pull-left">
									<img src="{{ url('/img/user.png') }}" alt="" class="sm-object rounded-corner">
								</a>
								<div class="media-body">
									<h5 class="media-heading">{{$integrante->getUser()->getFullName()}} </h5>
									<p>{{$integrante->getRolName()}}</p>
								</div>
							</li>
							@endforeach

						</ul>	
					</div><!-- boby -->
                </div>
            </div>
		
		</div><!-- row -->

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

    </div><!-- content -->
	
</div>
@endsection