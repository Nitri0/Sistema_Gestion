@extends('layouts.base')

@section('content')
<div class="container">
	<h2>INFORMACION BASICA</h2><br>
	nombre: {{ $proyecto->nombre_proyecto }} <br>
	descripcion: {{ $proyecto->direccion_proyecto}} <br>
	estatus: {{ $proyecto->getEstatus()}} <br>

	<h2>AVANCES</h2>
	<a href="/mis-proyectos/avances/{{$id_proyecto}}/create" >Agregar</a>
	
	@foreach($avances as $avance)
		<div>{{$avance->asunto_avance}}   {{$avance->descripcion_avance}}</div>
		<br>
	@endforeach
		<br>

	@if(sizeof($avances)>2)
		<a href="/mis-proyectos/avances/{{$id_proyecto}}">ver todos los avances</a>
	@endif
	
</div>
@stop