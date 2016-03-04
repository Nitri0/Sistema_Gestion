@extends('layouts.base')

@section('content')
	<body>
		<div class="container">
			<div class="content">
				<div class="title">
						<h1>Gestion</h1>
				</div>	

				<div class="title">
						<h3>Avances</h3>
						<li>
							<a href="{{ url('avances') }}">
								Listar
							</a>	
						</li>
						<li>
							<a href="{{ url('avances/create') }}">
								Crear
							</a>	
						</li>
				</div>	

				<div class="title">
						<h3>Proyectos</h3>
						<li>
							<a href="{{ url('proyectos') }}">
								Listar
							</a>	
						</li>
						<li>
							<a href="{{ url('proyectos/create') }}">
								Crear
							</a>	
						</li>						
				</div>	

			</div>
		</div>

	</body>
@stop
