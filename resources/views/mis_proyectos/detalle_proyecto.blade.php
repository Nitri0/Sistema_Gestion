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
                    <a href="/mis-proyectos/avances/{{$proyecto->id_proyecto}}/create" class="btn btn-list p-l-20 p-r-20" data-toggle="tooltip" data-title="Crear Avance">
                        <i class="fa fa-line-chart"></i>
                    </a>
                </div>
            </div>
          	@endif
        </ol>
        

        <h1 class="page-header">Dellate del Proyecto </h1>
        
        <div class="row">
            
            <!-- begin col-12 -->
            <div class="col-md-6 ui-sortable">
                <!-- begin panel -->
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
                <div class="panel panel-inverse">
                    <div class="panel-heading-2">
                        <h4 class="panel-title">Información del Cliente</h4>
                    </div>

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
                                                <td class="field">Nombre de lider</td>
                                                <td>{{ $proyecto->lider_proyecto }}</td>
                                            </tr>
                                            <tr class="tr-custon"></tr>
                                            <tr class="divider">
                                                <td colspan="2"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div><!-- boby -->
                        </div>
                    @else
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
                    @endif
                </div>
            </div>

            <!-- begin col-12 -->
            <div class="col-md-6 ui-sortable">
                <div class="panel panel-inverse">
                    <div class="panel-heading-2">
                        <h4 class="panel-title">Integrantes</h4>
                    </div>
                    <div class="panel-body">
                        <div class="height-custon-md" data-scrollbar="true"> 
                            <ul class="registered-users-list clearfix">
                                @foreach($rol as $integrante)
                                <li>
                                    <form class="eliminar-integrante" action="/integrantes/{{$integrante->id_rol_usuario}}" method="POST">
                                        <input type="hidden" name="_method" value="delete">
                                        <input type="hidden" name="redirect" value="{{url('/proyectos/'.$proyecto->id_proyecto )}}">
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
            <div class="col-md-5 col-md-offset-">
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
                        <h3 class="title center title-epata">{{$etapa->nombre_etapa}}</h3>
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