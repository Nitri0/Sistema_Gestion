@extends('layouts.base')

@section('content')
<div class="container">
	<h2>INFORMACION BASICA</h2><br>
	nombre: {{ $proyecto->nombre_proyecto }} <br>
	descripcion: {{ $proyecto->direccion_proyecto}} <br>
	Etapa actual de proyecto: {{ $proyecto->getEstatus()}} <br><br><br>

	Etapas: <br><br>
	@foreach($etapas->getEtapas() as $etapa)
		{{$etapa->nombre_etapa}} <br>
		@if ($etapa->getAvances($proyecto->id_proyecto)->first())
		  -- Avances:<br>
		@endif
		@foreach($etapa->getAvances($proyecto->id_proyecto) as $avance)
			---- {{$avance->asunto_avance}} - {{$avance->descripcion_avance}} - {{$avance->fecha_creacion_avance}}<br>
		@endforeach
		<br>
	@endforeach

	<br><br>
	integrantes: <br>
	@foreach($rol as $integrante)
		{{$integrante->getUser()->getFullName()}} - {{$integrante->getRolName()}} <br>
	@endforeach
	<br><br>
	@if($proyecto->getEstatus()!="Finalizado")
		<form action="/proyectos/{{$proyecto->id_proyecto}}" method="post">
			<input type="hidden" name="_method" value="delete">
			<button type="submit" class="btn btn-success" href="/proyectos/avances/{{$proyecto->id_proyecto}}/create">Eliminar Proyecto</a>
		</form>
	@endif
	
</div>
@stop