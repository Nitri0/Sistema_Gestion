@extends('layouts.base')

@section('content')
	<body>
		<div class="container">
			<div class="content">
				<div class="title">
						<h1>Gestión</h1>
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
						<h3>Dominios por vencerse</h3>
				</div>	

			</div>
		</div>

	</body>
@stop
