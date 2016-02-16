<!-- begin #header -->
<div id="header" class="header navbar navbar-default navbar-fixed-top">
	<!-- begin container-fluid -->
	<div class="container-fluid">
		<!-- begin mobile sidebar expand / collapse button -->
		<div class="navbar-header">
			<a href="{{ url('/mis-proyectos') }}" class="navbar-brand"><img class="nav-admin-logo" src="{{ url('img/logo.png') }}"> Key Gestión</a>
			<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<!-- end mobile sidebar expand / collapse button -->
		
		<!-- begin header navigation right -->
		<ul class="nav navbar-nav navbar-right">

			<li>
				<form class="navbar-form full-width">
					<div class="form-group">
						<input type="text" class="form-control" placeholder="Buscar" ng-model="opciones.buscador"/>
						<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
					</div>
				</form>
			</li>
			
			@if(Auth::user()->tiene_permiso('proyectos'))
			<li class="dropdown">
				<a href="{{ url('asistente/iniciando')}}" class="dropdown-toggle f-s-14">
					<i class="fa fa-magic" data-toggle="tooltip" data-placement="bottom" data-title="Creación Guiada"></i>
				</a>
			</li>
			@endif

			<li class="dropdown navbar-user">
				<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
					<img src="{{ url('/img/user.png') }}" alt="" /> 
					<span class="hidden-xs">{{ Auth::user()->fullName()}}</span> <b class="caret"></b>
				</a>
				<ul class="dropdown-menu animated fadeInLeft">
					<li class="arrow"></li>
					<li><a href="{{ url ('/perfil') }}">Editar perfil Usuario</a></li>
					@if(Auth::user()->isAdmin())
					<li><a href="{{ url ('/perfil-empresa') }}">Editar perfil Empresa</a></li>
					@endif
					<li><a href="#compartir" data-toggle="modal">Díselo a tus amigos...</a></li>
					<!--<li><a href="#WelcomeTour" data-toggle="modal">Paseo por Gestión</a></li>-->
					<li><a href="{{url('/reset-password')}}"><!-- <i class="fa fa-key"></i> --> Cambiar Contraseña</a></li>
					<li class="divider"></li>
					<li><a href="{{ url ('/logout') }}"><i class="fa fa-sign-in"></i> Cerrar sesión</a></li>
				</ul>
			</li>
		</ul>
		<!-- end header navigation right -->
	</div>
	<!-- end container-fluid -->
</div>
<!-- end #header -->

