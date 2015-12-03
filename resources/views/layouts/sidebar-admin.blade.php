
@section('controller')
	<script src="{{ asset('/js/controllers/sidebarcontroller.js') }}"></script>
@endsection

<!-- begin #sidebar -->
<div id="sidebar" class="sidebar" ng-controller="SidebarController">
	<!-- begin sidebar scrollbar -->
	<div data-scrollbar="true" data-height="100%">
		<!-- begin sidebar user -->
		<ul class="nav">
			<li class="nav-profile">
				<div class="image">
					<a href="keysystemsca.com.ve"><img src="{{ url('/img/ks-logo.png')}}" alt="" /></a>
				</div>
				<div class="info">
					Key Systems
					<small>©Copyright 2015</small>
				</div>
			</li>
		</ul>
		<!-- end sidebar user -->
		<!-- begin sidebar nav -->
		<ul class="nav">
			<li class="nav-header">Proyectos</li>
			<li class="has-sub"><!-- ng-click="proyecto_active()" ng-class="{'': !proyecto, 'active': proyecto}"-->
				<a href="javascript:;" >
				    <b class="caret pull-right"></b>
				    <i class="fa fa-laptop"></i>
				    <span>Pag WEB</span>
			    </a>
				<ul class="sub-menu">
				    <li><a href="{{ url('proyectos') }}">Todo los Proyectos</a></li>
				    <li><a href="{{ url('mis-proyectos') }}">Mis Proyectos</a></li>
				    <li><a href="{{ url('admin_empresas') }}">Empresas [FALTA ESTILO]</a></li>
				    <li><a href="{{ url('empresas_proveedoras') }}">Empresas Proveedoras</a></li>
				    <li><a href="{{ url('proyectos-finalizados') }}">Proyectos Finalizados</a></li>
				    <li><a href="{{ url('dominios') }}">Dominios</a></li>
				    <li><a href="{{ url('clientes') }}">Clientes</a></li>
				    <li><a href="{{ url('plantillas') }}">Pantillas</a></li>
				    <li><a href="{{ url('grupo_etapas') }}">Grupos de Etapas</a></li>
				    <li><a href="{{ url('tipo_proyectos') }}">Tipo de Proyectos</a></li>
				</ul>
			</li>
			<li class="has-sub"><!-- ng-click="usuario_active()" ng-class="{'': !usuario, 'active': usuario}" -->
				<a href="javascript:;">
				    <b class="caret pull-right"></b>
				    <i class="fa fa-users"></i>
				    <span>Admistrar Usuarios</span>
			    </a>
				<ul class="sub-menu">
				    <li><a href="{{ url('admin_usuarios') }}">Lista Usuarios</a></li>
				</ul>
			</li>
	        <!-- begin sidebar minify button -->
			<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
	        <!-- end sidebar minify button -->
		</ul>
		<!-- end sidebar nav -->
	</div>
	<!-- end sidebar scrollbar -->
</div>
<!-- begin #sidebar -->

<div class="sidebar-bg"></div>
<!-- end #sidebar -->