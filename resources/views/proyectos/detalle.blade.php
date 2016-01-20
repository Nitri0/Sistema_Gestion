@extends('base-admin')

@section('js')
    <script src="{{ asset('/js/controllers/helper.js') }}"></script>
@endsection

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="SubmitController">
	
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
        

        <h1 class="page-header">Dellate del Proyecto </h1>
        
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
                                    <tr class="line-bottom">
                                        <td class="field">Nombre</td>
                                        <td>{{ $proyecto->nombre_proyecto }}</td>
                                    </tr>
                                    <tr class="divider">
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td class="field">Descripción</td>
                                        <td>{{ $proyecto->direccion_proyecto}}</td>
                                    </tr>
                                    <tr>
                                        <td class="field">Etapa actual de proyecto</td>
                                        <td>{{ $proyecto->getEstatus()}}</td>
                                    </tr>
                                    <tr>
                                        <td class="field">Dominio</td>
                                        <td><a href="{{ $proyecto->getNombreDominio() }}" target="_blank" href="#">{{ $proyecto->getNombreDominio() }}</a></td>
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
                                    <tr class="line-bottom">
                                        <td class="field">Nombre</td>
                                        <td>{{ $proyecto->getCliente()->nombre_cliente }}</td>
                                    </tr>
                                    <tr class="divider">
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td class="field">Telefono 1</td>
                                        <td><i class="fa fa-mobile fa-lg m-r-5"></i> {{ $proyecto->getCliente()->telefono_cliente}}</td>
                                    </tr>
                                    <tr>
                                        <td class="field">Telefono 2</td>
                                        <td><i class="fa fa-mobile fa-lg m-r-5"></i> {{ $proyecto->getCliente()->telefono_2_cliente}}</td>
                                    </tr>
                                    <tr>
                                        <td class="field">Correo Electronico</td>
                                        <td><a href="email:{{ $proyecto->getCliente()->email_cliente}}">{{ $proyecto->getCliente()->email_cliente}}</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

					</div><!-- boby -->
                </div>
            </div>
        
        </div>

        <div class="row">
            <div class="col-md-12 ui-sortable">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Integrantes</h4>
                    </div>
                    <div class="panel-body">
                        <br>

                        <div ng-init="urlRedirect='{{ url('proyectos/'.$proyecto->id_proyecto) }}'"></div>
                        <div ng-init="urlAction='{{ url('/integrantes') }}'"></div>

                        <form class="form-horizontal" id="formulario" name="formulario" action="/integrantes" method="POST">
                                
                            <input type="hidden" name="id_proyecto" value="{{$proyecto->id_proyecto}}">
                            <input type="hidden" name="redirect" value="{{url('/proyectos/'.$proyecto->id_proyecto )}}">
                            
                            <div class="form-group">
                                <label class="col-md-1 control-label ng-binding">Integrante</label>
                                <div class="col-md-4">
                                    <select class="form-control js-example-data-array" name="id_usuario" ng-model="id_usuario" ng-required="true">
                                        <option value="">Seleccione un Usuario</option>
                                        @foreach($usuarios as $usuario)
                                            <option class="option" value="{{$usuario->id_usuario}}">
                                                {{ $usuario->getFullName()}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="error campo-requerido" ng-show="formulario.id_usuario.$invalid && (formulario.id_usuario.$touched || submitted)">
                                        <small class="error" ng-show="formulario.id_usuario.$error.required">
                                            * Campo requerido.
                                        </small>
                                    </div>
                                </div>
                                <label class="col-md-2 control-label ng-binding">Rol que cumplirá</label>
                                <div class="col-md-4">
                                    <select class="form-control js-example-data-array" name="id_tipo_rol" ng-model="id_tipo_rol" ng-required="true">
                                        <option value="">Seleccione un rol</option>
                                        @foreach($roles as $rols)
                                            <option value="{{$rols->id_tipo_rol }}">
                                                {{ $rols->nombre_tipo_rol }} 
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="error campo-requerido" ng-show="formulario.id_tipo_rol.$invalid && (formulario.id_tipo_rol.$touched || submitted)">
                                        <small class="error" ng-show="formulario.id_tipo_rol.$error.required">
                                            * Campo requerido.
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <button  type="button" ng-click="submit(formulario.$valid)" class="btn btn-primary m-r-5 m-b-5"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>

                        </form>
                        
                        <hr>
                       
                        <ul class="registered-users-list clearfix">
                            @foreach($rol as $integrante)
                            <li>
                                <form action="/integrantes/{{$integrante->id_rol_usuario}}" method="POST">
                                    <input type="hidden" name="_method" value="delete">
                                    <input type="hidden" name="redirect" value="{{url('/proyectos/'.$proyecto->id_proyecto )}}">
                                    <button type="submit" class="btn btn-sm btn-danger btn-eliminar-integrante" data-toggle="tooltip" data-title="Eliminar"><i class="fa fa-remove"></i></button >
                                </form>  
                                <a href="javascript:;"><img src="{{ url('thema/admin/html/assets/img/user-1.jpg') }}" alt=""></a>
                                <h4 class="username text-ellipsis">
                                    {{$integrante->getUser()->getFullName()}}
                                    <small class="text-ellipsis">{{$integrante->getRolName()}}</small>
                                </h4>

                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">

            <center>
                <h3 class="title">Etapas</h3>
            </center>
            <br>
            <br>
        	
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
                                	
                                    {!!$avance->descripcion_avance!!}
                                </div>
                                <div class="asunto">
                                <h6>Asunto: {{$avance->asunto_avance}}</h6>
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
        </div>
					
    </div><!-- content -->
	
</div>
@endsection