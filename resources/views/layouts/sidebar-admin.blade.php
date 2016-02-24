
@section('controller')
	<script src="{{ asset('/js/controllers/sidebarcontroller.js') }}"></script>
	<script src="{{ asset('/bower_components/ng-flow/dist/ng-flow-standalone.min.js') }}"></script>
@endsection

<!-- begin #sidebar -->
<div id="sidebar" class="sidebar" ng-controller="SidebarController">
	<!-- begin sidebar scrollbar -->
	<div data-scrollbar="true" data-height="100%">
		<!-- begin sidebar user -->
		<ul class="nav">
			<li class="nav-profile">
				<div class="image">
					<a href="#"><img src="{{ url('/img/user.jpg')}}" alt="" /></a>
				</div>
				<div class="info">
					{{Auth::user()->empresa->nombre_empresa}}
					<small class="text-ellipsis">{{Auth::user()->correo_usuario}}</small>
				</div>
			</li>
		</ul>
		<!-- end sidebar user -->
		<!-- begin sidebar nav -->
		<ul class="nav">			

			<li class="has-sub">
				<a href="{{ url('actividades')}}" >
				    <i class="fa fa-check"></i>
				    <span>Actividades</span>
			    </a>
			</li>	


			<li class="has-sub" id="mis_proyectos"><!-- ng-click="proyecto_active()" ng-class="{'': !proyecto, 'active': proyecto}"-->
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
				    <li><a href="{{ url('proyectos') }}">Todos los Proyectos</a></li>
				    <li><a href="{{ url('proyectos/create') }}">Crear Proyecto</a></li>
				    <li><a href="{{ url('proyectos-internos/create') }}">Crear Proyecto Interno</a></li>
				    <li><a href="{{ url('proyectos-finalizados') }}">Proyectos Finalizados</a></li>
				</ul>
			</li>
			@endif	

			@if(Auth::user()->tiene_permiso('tipo_proyectos'))
			<li class="has-sub"><!-- ng-click="proyecto_active()" ng-class="{'': !proyecto, 'active': proyecto}"-->
				<a href="javascript:;" >
				    <b class="caret pull-right"></b>
				    <i class="fa fa-sort-amount-asc"></i>
				    <span>Tipos de Proyectos</span>
			    </a>
				<ul class="sub-menu">
				    <li><a href="{{ url('tipo_proyectos') }}">Mis Tipos de Proyectos</a></li>
				    <li><a href="{{ url('tipo_proyectos/create') }}">Crear Tipo de Proyectos</a></li>
				</ul>
			</li>
			@endif

			@if(Auth::user()->tiene_permiso('clientes'))
			<li class="has-sub"><!-- ng-click="proyecto_active()" ng-class="{'': !proyecto, 'active': proyecto}"-->
				<a href="javascript:;" >
				    <b class="caret pull-right"></b>
				    <i class="fa fa-user"></i>
				    <span>Clientes</span>
			    </a>
				<ul class="sub-menu">
				    <li><a href="{{ url('clientes') }}">Mis Clientes</a></li>
				    <li><a href="{{ url('clientes/create') }}">Crear Clientes</a></li>
				</ul>
			</li>
			@endif

			@if(Auth::user()->tiene_permiso('roles'))
			<li class="has-sub"><!-- ng-click="proyecto_active()" ng-class="{'': !proyecto, 'active': proyecto}"-->
				<a href="javascript:;" >
				    <b class="caret pull-right"></b>
				    <i class="fa fa-puzzle-piece"></i>
				    <span>Roles del Equipo</span>
			    </a>
				<ul class="sub-menu">
				    <li><a href="{{ url('roles') }}">Mis Roles</a></li>
				    <li><a href="{{ url('roles/create') }}">Crear Rol de Usuario</a></li>
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
				    <li><a href="{{ url('plantillas') }}">Mis Plantillas</a></li>
				    <li><a href="{{ url('plantillas/create') }}">Crear Plantilla</a></li>
				</ul>
			</li>
			@endif
			@if(Auth::user()->getIdEmpresa() == 1 && (Auth::user()->tiene_permiso('dominios') || Auth::user()->tiene_permiso('empresas_proveedoras')  ))
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
					        <li><a href="{{ url('dominios') }}">Mis Dominios</a></li>
					        <li><a href="{{ url('dominios/create') }}">Crear Dominio</a></li>
					    </ul>
					</li>
					@endif
					@if(Auth::user()->tiene_permiso('empresas_proveedoras') )
					<li class="has-sub">
					    <a href="javascript:;"><b class="caret pull-right"></b> Proveedores</a>
					    <ul class="sub-menu">
					        <li><a href="{{ url('empresas_proveedoras') }}">Mis Proveedores</a></li>
					        <li><a href="{{ url('empresas_proveedoras/create') }}">Crear Proveedor</a></li>
					    </ul>
					</li>
					@endif
				</ul>
			</li>
			@endif

			@if(Auth::user()->isAdmin())
			<li class="has-sub"><!-- ng-click="proyecto_active()" ng-class="{'': !proyecto, 'active': proyecto}"-->
				<a href="javascript:;" >
				    <b class="caret pull-right"></b>
				    <i class="fa fa-users"></i>
				    <span>Equipo de Trabajo</span>
			    </a>
				<ul class="sub-menu">
				    <li><a href="{{ url('admin_usuarios') }}">Mi Equipo</a></li>
				    <li><a href="{{ url('admin_usuarios/create') }}">Crear Usuario</a></li>
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
				    <li><a href="{{ url('admin_empresas') }}">Mis Empresas</a></li>
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