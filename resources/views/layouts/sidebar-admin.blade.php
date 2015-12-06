
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
			<li class="has-sub">
				<a href="javascript:;">
				    <b class="caret pull-right"></b>
				    <i class="fa fa-sitemap"></i>
				    <span>Proyectos</span>
			    </a>
				<ul class="sub-menu">
				    <li><a href="{{ url('proyectos') }}">Todos los proyectos</a></li>
				    <li><a href="{{ url('proyectos-finalizados') }}">Proyectos Finalizados</a></li>
				</ul>
			</li>
			<li>
				<a href="{{ url('mis-proyectos') }}">
				    <i class="fa fa-star"></i>
				    <span>Mis Proyectos</span>
			    </a>
			</li>
			<li class="has-sub">
				<a href="javascript:;">
				    <b class="caret pull-right"></b>
				    <i class="fa fa-wheelchair"></i>
				    <span>Clientes</span>
			    </a>
				<ul class="sub-menu">
				    <li><a href="{{ url('clientes') }}">Listar clientes</a></li>
				    <li><a href="{{ url('clientes/create') }}">Agregar Cliente</a></li>
				</ul>
			</li>
			<li class="has-sub">
				<a href="javascript:;">
				    <b class="caret pull-right"></b>
				    <i class="fa fa-line-chart"></i>
				    <span>Grupos de Etapas</span>
			    </a>
				<ul class="sub-menu">
				    <li><a href="{{ url('grupo_etapas') }}">Listar Etapas</a></li>
				    <li><a href="{{ url('grupo_etapas/create') }}">Agregar Etapas</a></li>
				</ul>
			</li>
			<li class="has-sub">
				<a href="javascript:;">
				    <b class="caret pull-right"></b>
				    <i class="fa fa-suitcase"></i>
				    <span>Tipo de Proyectos</span>
			    </a>
				<ul class="sub-menu">
				    <li><a href="{{ url('tipo_proyectos') }}">Listar</a></li>
				    <li><a href="{{ url('tipo_proyectos/create') }}">Agregar</a></li>
				</ul>
			</li>
			<li class="has-sub">
				<a href="javascript:;">
				    <b class="caret pull-right"></b>
				    <i class="fa fa-link"></i>
				    <span>Dominios</span>
			    </a>
				<ul class="sub-menu">
				    <li><a href="{{ url('dominios') }}">Listar Dominios</a></li>
				    <li><a href="{{ url('dominios/create') }}">Agregar Dominios</a></li>
				</ul>
			</li>
			<li class="has-sub">
				<a href="javascript:;">
				    <b class="caret pull-right"></b>
				    <i class="fa fa-paste"></i>
				    <span>Pantillas</span>
			    </a>
				<ul class="sub-menu">
				    <li><a href="{{ url('plantillas') }}">Listar Pantillas</a></li>
				    <li><a href="{{ url('plantillas/create') }}">Agregar Pantillas</a></li>
				</ul>
			</li>
			<li class="has-sub">
				<a href="javascript:;">
				    <b class="caret pull-right"></b>
				    <i class="fa fa-coffee"></i>
				    <span>Empresas Proveedoras</span>
			    </a>
				<ul class="sub-menu">
				    <li><a href="{{ url('empresas_proveedoras') }}">Listar Proveedores</a></li>
				    <li><a href="{{ url('empresas_proveedoras/create') }}">Agregar Proveedores</a></li>
				</ul>
			</li>

			<li class="has-sub"><!-- ng-click="proyecto_active()" ng-class="{'': !proyecto, 'active': proyecto}"-->
				<a href="javascript:;" >
				    <b class="caret pull-right"></b>
				    <i class="fa fa-coffee"></i>
				    <span>Empresas</span>
			    </a>
				<ul class="sub-menu">
				    <li><a href="{{ url('admin_empresas') }}">Listar Empresas</a></li>
				    <li><a href="{{ url('admin_empresas/create') }}">Crear Empresas</a></li>
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
				    <li><a href="{{ url('admin_usuarios/create') }}">Crear Usuarios</a></li>
				</ul>
			</li>
			<li class="has-sub">
				<a href="javascript:;">
				    <b class="caret pull-right"></b>
				    <i class="fa fa-coffee"></i>
				    <span>Roles [REVISAR ESTILO]</span>
			    </a>
				<ul class="sub-menu">
				    <li><a href="{{ url('roles') }}">Listar de roles [REVISAR ESTILO]</a></li>
				    <li><a href="{{ url('roles/create') }}">Agregar roles [REVISAR ESTILO]</a></li>
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