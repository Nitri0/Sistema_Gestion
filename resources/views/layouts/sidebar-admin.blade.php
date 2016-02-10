
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

			<li class="has-sub"><!-- ng-click="proyecto_active()" ng-class="{'': !proyecto, 'active': proyecto}"-->
				<a href="{{ url('mis-proyectos')}}" >
				    <i class="fa fa-star"></i>
				    <span>Mis Proyectos</span>
			    </a>
			</li>		

			@if(Auth::user()->tiene_permiso('proyectos'))
			<li class="has-sub"><!-- ng-click="proyecto_active()" ng-class="{'': !proyecto, 'active': proyecto}"-->
				<a href="javascript:;" >
				    <b class="caret pull-right"></b>
				    <i class="fa fa-sitemap"></i>
				    <span>Proyectos</span>
			    </a>
				<ul class="sub-menu">
				    <li><a href="{{ url('proyectos') }}">Filtrar</a></li>
				    <li><a href="{{ url('proyectos/create') }}">Crear proyecto</a></li>
				    <li><a href="{{ url('proyectos-finalizados') }}">Proyectos inactivos</a></li>
				</ul>
			</li>
			@endif	

			@if(Auth::user()->tiene_permiso('tipo_proyectos'))
			<li class="has-sub"><!-- ng-click="proyecto_active()" ng-class="{'': !proyecto, 'active': proyecto}"-->
				<a href="javascript:;" >
				    <b class="caret pull-right"></b>
				    <i class="fa fa-sort-amount-asc"></i>
				    <span>Tipos de proyectos</span>
			    </a>
				<ul class="sub-menu">
				    <li><a href="{{ url('tipo_proyectos') }}">Filtrar</a></li>
				    <li><a href="{{ url('tipo_proyectos/create') }}">Crear tipo de proyecto</a></li>
				</ul>
			</li>
			@endif

			@if(Auth::user()->tiene_permiso('clientes'))
			<li class="has-sub"><!-- ng-click="proyecto_active()" ng-class="{'': !proyecto, 'active': proyecto}"-->
				<a href="javascript:;" >
				    <b class="caret pull-right"></b>
				    <i class="fa fa-wheelchair"></i>
				    <span>Clientes</span>
			    </a>
				<ul class="sub-menu">
				    <li><a href="{{ url('clientes') }}">Filtrar</a></li>
				    <li><a href="{{ url('clientes/create') }}">Crear clientes</a></li>
				</ul>
			</li>
			@endif

			@if(Auth::user()->tiene_permiso('roles'))
			<li class="has-sub"><!-- ng-click="proyecto_active()" ng-class="{'': !proyecto, 'active': proyecto}"-->
				<a href="javascript:;" >
				    <b class="caret pull-right"></b>
				    <i class="fa fa-puzzle-piece"></i>
				    <span>Roles de usuarios</span>
			    </a>
				<ul class="sub-menu">
				    <li><a href="{{ url('roles') }}">Filtrar</a></li>
				    <li><a href="{{ url('roles/create') }}">Crear rol de usuario</a></li>
				</ul>
			</li>
			@endif

			@if(Auth::user()->tiene_permiso('plantillas'))
			<li class="has-sub"><!-- ng-click="proyecto_active()" ng-class="{'': !proyecto, 'active': proyecto}"-->
				<a href="javascript:;" >
				    <b class="caret pull-right"></b>
				    <i class="fa fa-clipboard"></i>
				    <span>Plantillas</span>
			    </a>
				<ul class="sub-menu">
				    <li><a href="{{ url('plantillas') }}">Filtrar</a></li>
				    <li><a href="{{ url('plantillas/create') }}">Crear plantilla</a></li>
				</ul>
			</li>
			@endif
			<li class="has-sub"><!-- ng-click="proyecto_active()" ng-class="{'': !proyecto, 'active': proyecto}"-->
				<a href="javascript:;" >
				    <b class="caret pull-right"></b>
				    <i class="fa fa-globe"></i>
				    <span>Modulo Web</span>
			    </a>
				<ul class="sub-menu">
					@if(Auth::user()->tiene_permiso('dominios') )
				    <li class="has-sub">
					    <a href="javascript:;"><b class="caret pull-right"></b> Dominios</a>
					    <ul class="sub-menu">
					        <li><a href="{{ url('dominios') }}">Filtar</a></li>
					        <li><a href="{{ url('dominios/create') }}">Crear dominio</a></li>
					    </ul>
					</li>
					@endif
					@if(Auth::user()->tiene_permiso('empresas_proveedoras') )
					<li class="has-sub">
					    <a href="javascript:;"><b class="caret pull-right"></b> Proveedores</a>
					    <ul class="sub-menu">
					        <li><a href="{{ url('empresas_proveedoras') }}">Filtar</a></li>
					        <li><a href="{{ url('empresas_proveedoras/create') }}">Crear proveedor</a></li>
					    </ul>
					</li>
					@endif
				</ul>
			</li>
			

			@if(Auth::user()->isAdmin())
			<li class="has-sub"><!-- ng-click="proyecto_active()" ng-class="{'': !proyecto, 'active': proyecto}"-->
				<a href="javascript:;" >
				    <b class="caret pull-right"></b>
				    <i class="fa fa-users"></i>
				    <span>Administrar usuarios</span>
			    </a>
				<ul class="sub-menu">
				    <li><a href="{{ url('admin_usuarios') }}">Filtrar</a></li>
				    <li><a href="{{ url('admin_usuarios/create') }}">Crear usuario</a></li>
				</ul>
			</li>
			@endif

			@if(Auth::user()->isSuperAdmin())
			<li class="has-sub"><!-- ng-click="proyecto_active()" ng-class="{'': !proyecto, 'active': proyecto}"-->
				<a href="javascript:;" >
				    <b class="caret pull-right"></b>
				    <i class="fa fa-building"></i>
				    <span>Empresas</span>
			    </a>
				<ul class="sub-menu">
				    <li><a href="{{ url('admin_empresas') }}">Listar Empresas</a></li>
				    <li><a href="{{ url('admin_empresas/create') }}">Crear Empresas</a></li>
				</ul>
			</li>
			@endif

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