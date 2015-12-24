
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

			@if(Auth::user()->isSuperAdmin())
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
			<li >
				<a href="{{ url('mis-proyectos') }}">
				    <i class="fa fa-star"></i>
				    <span>Mis Proyectos</span>
			    </a>
			</li>	
			@elseif(Auth::user()->isAdmin())
			<li class="has-sub" ng-init="menu={{Auth::user()->getAllPermisosMenu()}}"><!-- ng-click="usuario_active()" ng-class="{'': !usuario, 'active': usuario}" -->
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
			<li >
				<a href="{{ url('mis-proyectos') }}">
				    <i class="fa fa-star"></i>
				    <span>Mis Proyectos</span>
			    </a>
			</li>	

			<li class="has-sub" ng-repeat="item in menu">
				<a  href="javascript:;" >
					<b class="caret pull-right"></b>
				    <i class="[[item.icon]]"></i>
				    <span>[[item.nombre_menu]]</span>
				    
			    </a>
			    <ul class="sub-menu" >
					<li ng-repeat='subitem in item.submenu'>
						<a href="{{ url('[[item.nombre_modulo]]/[[subitem.raw]]') }}">[[subitem.label]]</a>
					</li>
			    </ul>
			</li>			
			@else
			
			<li ng-init="menu={{Auth::user()->getPermisosMenu()}}">
				<a href="{{ url('mis-proyectos') }}">
				    <i class="fa fa-star"></i>
				    <span>Mis Proyectos</span>
			    </a>
			</li>	

			<li class="has-sub" ng-repeat="item in menu">
				<a  href="javascript:;" >
					<b class="caret pull-right"></b>
				    <i class="[[item.icon]]"></i>
				    <span>[[item.nombre_menu]]</span>
				    
			    </a>
			    <ul class="sub-menu" >
					<li ng-repeat='subitem in item.submenu'>
						<a href="{{ url('[[item.nombre_modulo]]/[[subitem.raw]]') }}">[[subitem.label]]</a>
					</li>
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