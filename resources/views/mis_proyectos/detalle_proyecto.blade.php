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
        

        <h1 class="page-header">Dellate del Proyecto </h1>
        

    	<div class="row">
            
            <!-- begin col-4 -->
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
                                    <tr class="line-bottom">
                                        <td class="field">Nombre</td>
                                        <td><a>{{ $proyecto->nombre_proyecto }}</a></td>
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
                                        <td><span>{{ $proyecto->getEstatus()}}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="field">Dominio</td>
                                        <td><a href="{{ $proyecto->getNombreDominio() }}" target="_blank">{{ $proyecto->getNombreDominio() }}</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>		
					</div><!-- boby -->
                </div>
            </div>
        
            <div class="col-md-6 ui-sortable">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading-2">
                        <h4 class="panel-title">Información del Cliente</h4>
                    </div>

                    <div class="panel-body">
                    	<div class="table-responsive">
                            <table class="table table-profile">
                                <tbody>
                                    <tr class="line-bottom">
                                        <td class="field">Nombre</td>
                                        <td><a>{{ $proyecto->getCliente()->nombre_cliente }}</a></td>
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
		
		</div><!-- row -->
        
        <div class="row">
            <div class="col-md-12 ui-sortable">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading-2">
                        <h4 class="panel-title">Integrantes</h4>
                    </div>

                    <div class="panel-body">
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
                    </div><!-- boby -->
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