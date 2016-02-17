@extends('base-admin')

@section('js')
    <script src="{{ asset('/js/controllers/helper.js') }}"></script>
    <script src="{{ asset('/js/controllers/proyecto_detalle.js') }}"></script>
@endsection

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed" ng-controller="ProyectoDetalleController">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
    @include('alerts.mensaje_success')
    @include('alerts.mensaje_error') 
	
	<div id="content" class="content ng-scope" ng-controller="SubmitController">
        
        @include('modals/eliminar')

        <ol class="breadcrumb pull-right">
        	
            <div class="btn-toolbar">
                @if($proyecto->habilitado_proyecto)
                <div class="btn-group">
                	<form action="/proyectos/finalizar/{{$proyecto->id_proyecto}}" method="post">
	                    <button type="submit" class="btn btn-list p-l-20 p-r-20" data-toggle="tooltip" data-title="Finalizar Proyecto">
	                        <i class="fa fa-thumbs-up"></i>
	                    </button>
                    </form>
                </div>
                @else
                <div class="btn-group">
                	<form action="/proyectos/reabrir/{{$proyecto->id_proyecto}}" method="post">
	                    <button  class="btn btn-list p-l-20 p-r-20" data-toggle="tooltip" data-title="Habilitar Proyecto">
	                        <i class="fa fa-unlock"></i>
	                    </button>
                    </form>
                </div>
          		@endif
                <div class="btn-group">
                    <div ng-init="eliminar_url='/proyectos/{{$proyecto->id_proyecto}}/destroy'"></div>
                    <a ng-click="eliminar(eliminar_url)" href="#eliminar" class="btn btn-list p-l-20 p-r-20" data-toggle="modal" data-title="Eliminar Proyecto">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
                
			</div>
        </ol>
        

        <h1 class="page-header">Dellate del Proyecto </h1>
        
		<div class="row">
            
            <!-- begin col-12 -->
            <div class="col-md-6 ui-sortable">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading-2">
                        <h4 class="panel-title">Información del Proyecto</h4>
                    </div>

                    <div class="panel-body">
                    	<div class="table-responsive">
                            <table class="table table-profile">
                                <tbody>
                                    <tr class="tr-custon"></tr>
                                    <tr class="line-bottom">
                                        <td class="field">Nombre</td>
                                        <td>{{ $proyecto->nombre_proyecto }}</td>
                                    </tr>
                                    <tr class="tr-custon"></tr>
                                    <tr class="divider">
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td class="field">Descripción</td>
                                        <td>{{ $proyecto->descripcion_proyecto}}</td>
                                    </tr>
                                    <tr>
                                        <td class="field">Etapa actual de proyecto</td>
                                        <td>{{ $proyecto->getEstatus()}}</td>
                                    </tr>
                                    @if($proyecto->getNombreDominio() != "No asignado")
                                    <tr>
                                        <td class="field">Dominio</td>
                                        <td><a href="{{ $proyecto->getNombreDominio() }}" target="_blank" href="#">{{ $proyecto->getNombreDominio() }}</a></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

					</div><!-- boby -->
                </div>

                 <!-- begin panel -->
                @if( $proyecto->proyecto_interno )
                    <div class="panel panel-inverse">
                        <div class="panel-heading-2">
                            <h4 class="panel-title">Información de Lider de proyecto</h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <tbody>
                                        <tr class="tr-custon"></tr>
                                        <tr class="line-bottom">
                                            <td class="field">Nombre</td>
                                            <td>{{ $proyecto->getCliente()->nombre_cliente }}</td>
                                        </tr>
                                        <tr class="tr-custon"></tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td class="field">Telefono 1</td>
                                            <td><i class="fa fa-mobile fa-lg m-r-5"></i> {{ $proyecto->getCliente()->telefono_cliente}}</td>
                                        </tr>
                                        @if($proyecto->getCliente()->telefono_2_cliente)
                                        <tr>
                                            <td class="field">Telefono 2</td>
                                            <td><i class="fa fa-mobile fa-lg m-r-5"></i> {{ $proyecto->getCliente()->telefono_2_cliente}}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td class="field">Correo Electronico</td>
                                            <td><a href="email:{{ $proyecto->getCliente()->email_cliente}}">{{ $proyecto->getCliente()->email_cliente}}</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div><!-- boby -->
                    </div>
                @else
                    <div class="panel panel-inverse">
                        <div class="panel-heading-2">
                            <h4 class="panel-title">Información del Cliente</h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-profile">
                                    <tbody>
                                        <tr class="tr-custon"></tr>
                                        <tr class="line-bottom">
                                            <td class="field">Nombre</td>
                                            <td>{{ $proyecto->getCliente()->nombre_cliente }}</td>
                                        </tr>
                                        <tr class="tr-custon"></tr>
                                        <tr class="divider">
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td class="field">Telefono 1</td>
                                            <td><i class="fa fa-mobile fa-lg m-r-5"></i> {{ $proyecto->getCliente()->telefono_cliente}}</td>
                                        </tr>
                                        @if($proyecto->getCliente()->telefono_2_cliente)
                                        <tr>
                                            <td class="field">Telefono 2</td>
                                            <td><i class="fa fa-mobile fa-lg m-r-5"></i> {{ $proyecto->getCliente()->telefono_2_cliente}}</td>
                                        </tr>
                                        @endif
                                        <tr>
                                            <td class="field">Correo Electronico</td>
                                            <td><a href="email:{{ $proyecto->getCliente()->email_cliente}}">{{ $proyecto->getCliente()->email_cliente}}</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div><!-- boby -->
                    </div>
                @endif



            </div>

            <!-- begin col-12 -->
            <div class="col-md-6 ui-sortable">
                <div class="panel panel-inverse">
                    <div class="panel-heading-2">
                        <h4 class="panel-title">Integrantes</h4>
                    </div>
                    <div class="panel-body">
                        <div class="height-custon-md" data-scrollbar="true">
                            <br>

                            <div ng-init="urlRedirect='{{ url('proyectos/'.$proyecto->id_proyecto) }}'"></div>
                            <div ng-init="urlAction='{{ url('/integrantes') }}'"></div>

                            <form class="form-horizontal" id="formulario" name="formulario" action="/integrantes" method="POST">
                                    
                                <input type="hidden" name="id_proyecto" value="{{$proyecto->id_proyecto}}">
                                <input type="hidden" name="redirect" value="{{url('/proyectos/'.$proyecto->id_proyecto )}}">
                                
                                <div class="form-group">
                                    <label class="col-md-2 control-label ng-binding">Integrante</label>
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
                                    <label class="col-md-1 control-label ng-binding">Rol</label>
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
                                    <div>
                                        <button  type="button" ng-click="submit(formulario.$valid)" class="btn btn-list"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>

                            </form>
                            
                            <hr>
                           
                            <ul class="registered-users-list clearfix">
                                @foreach($rol as $integrante)
                                <li>
                                    <form class="eliminar-integrante" action="/integrantes/{{$integrante->id_rol_usuario}}" method="POST">
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
        
        </div>

        <center>
            <h3 class="title">Etapas</h3>
        </center>

        <br>

        <div class="row">
            <div class="col-md-5 col-md-offset-1">
                <select class="form-control js-example-data-array">
                    <option value="">Filtrar etapa</option>
                    @foreach($etapas->getEtapas() as $etapa)
                        @if ($etapa->getAvances($proyecto->id_proyecto)->count()>0)
                            <option class="option" value="{{$etapa->nombre_etapa}}">
                                {{$etapa->nombre_etapa}}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-5 col-md-offset">
                <div class="progress progress-striped active">
                    <div class="progress-bar" style="width: {{$progress}}%; padding-top: 6px;">{{$progress}}%</div>
                </div>
            </div>
        </div>

        <br>
        
        <div class="row">
            @foreach($etapas->getEtapas() as $etapa)
                    @if ($etapa->getAvances($proyecto->id_proyecto)->count()>0)

                    <div class="col-md-2">
                        <h4 class="title center title-epata">{{$etapa->nombre_etapa}}</h4>
                    </div>
                    <div class="col-md-12"></div>
               
                    @endif
                @foreach($etapa->getAvances($proyecto->id_proyecto) as $avance)
                
                    <div class="col-md-12">
                        <div class="timeline-body">
                            <div class="timeline-header">
                                <span class="userimage"><img width="34" height="34" src="{{url('img/user.png')}}" alt=""></span>
                                <span class="username"><a href="javascript:;">{{$avance->getNombreCreador()}}</a> <small></small></span>
                                <span class="pull-right text-muted">{{$avance->fecha_creacion_avance}}</span>
                            </div>
                            <div class="timeline-content collapse" id="{{$avance->id_avance}}">
                                <br>
                                <p>
                                    {!!$avance->descripcion_avance!!}
                                </p>
                                <br>
                            </div>
                            <div class="timeline-footer">
                                <div class="row">
                                    <div class="col-md-6">
                                        <p> Asunto: {{$avance->asunto_avance}} </p>
                                    </div>
                                    <div class="col-md-6">
                                        <a class="f-s-20" href="#{{$avance->id_avance}}" data-toggle="collapse"><i class="fa fa-ellipsis-h"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
  
                @endforeach
            @endforeach
        </div>

        <br>
					
    </div><!-- content -->
	
</div>
@endsection