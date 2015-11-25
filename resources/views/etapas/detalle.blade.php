@extends('base-admin')

@section('content')

<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
	
	@include('layouts/navbar-admin')

    @include('layouts/sidebar-admin')
	
	<div id="content" class="content ng-scope">
        
        <ol class="breadcrumb pull-right">
            <div class="btn-toolbar">
                <div class="btn-group">
                    <a href="{{ url( '/grupo_etapas/create' ) }}" class="btn btn-success btn-sm p-l-20 p-r-20" data-toggle="tooltip" data-title="Agregar">
                        <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </ol>

        <h1 class="page-header"><i class="fa fa-database"></i> Detalle de Grupo de Etapa</h1>
        
        <div class="row">
            <!-- begin col-12 -->
            <div class="col-md-4 ui-sortable">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Detalle de Etapas</h4>
                    </div>

                    <div class="panel-body">
                    	<div class="table-responsive">
                            <table class="table table-profile">
                                <tbody>
                                    <tr>
                                        <td class="field">Nombre</td>
                                        <td><a>{{ $grupo_etapas->nombre_grupo_etapas }} </a></td>
                                    </tr>
                                    <tr class="divider">
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="field">Descripción</td>
                                        <td>{{ $grupo_etapas->descripcion_grupo_etapas}}</td>
                                    </tr>
                                    <tr>
                                        <td class="field">cantidad de etapas</td>
                                        <td><a class="label label-info">{{ $grupo_etapas->cantidad_etapas}}</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
					</div><!-- boby -->
                </div>
            </div>

            <!-- begin col-12 -->
            <div class="col-md-8 ui-sortable">
                <!-- begin panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4 class="panel-title">Lista de Etapas</h4>
                    </div>

                    <div class="panel-body color-timeline">

						<ul class="timeline">
							@foreach($grupo_etapas->getEtapas() as $etapa)
						    <li>
						        <!-- begin timeline-time -->
						        <div class="timeline-time">
						            <span class="date">Orden</span>
						            <span class="time">{{$etapa->numero_orden_etapa}}</span>
						        </div>
						        <!-- end timeline-time -->
						        <!-- begin timeline-icon -->
						        <div class="timeline-icon">
						            <a href="javascript:;"><i class="fa fa-star"></i></a>
						        </div>
						        <!-- end timeline-icon -->
						        <!-- begin timeline-body -->
						        <div class="timeline-body">
						            @if($grupo_etapas->getEtapas()->first())
										<h5>Etapas</h5>
									@endif
									<div class="timeline-content">
			                            <p>
			                            	{{$etapa->nombre_etapa}}
			                            </p>
						            </div>
						        </div>
						        <!-- end timeline-body -->
						    </li>
						    @endforeach
						    <li>
						        <!-- begin timeline-icon -->
						        <div class="timeline-icon">
						            <a href="javascript:;"><i class="fa fa-trash"></i></a>
						        </div>
						        <!-- end timeline-icon -->
						        <!-- begin timeline-body -->
						        <div class="timeline-body-eliminar">
						            <form action="/grupo_etapas/{{$grupo_etapas->id_grupo_etapas}}" method="post">
										<input type="hidden" name="_method" value="delete">
										<button type="submit" class="btn btn-danger" data-toggle="tooltip" data-title="Grupo de Etapas">Eliminar</button>
									</form>
						        </div>
						        <!-- begin timeline-body -->
						    </li>
						</ul>

					</div><!-- boby -->
                </div>
            </div>
        
        </div>

    </div><!-- content -->
	
</div>

@endsection