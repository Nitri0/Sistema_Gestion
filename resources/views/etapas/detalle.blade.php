@extends('layouts.base')

@section('content')
<div class="container">
	Nombre: {{ $grupo_etapas->nombre_grupo_etapas }} <br>
	Descripcion: {{ $grupo_etapas->descripcion_grupo_etapas}} <br>
	cantidad de etapas: {{ $grupo_etapas->cantidad_etapas}} <br><br><br>
	
	@if($grupo_etapas->getEtapas()->first())
		Etapas: <br>
	@endif
	@foreach($grupo_etapas->getEtapas() as $etapa)
		nombre_etapa: {{$etapa->nombre_etapa}} &nbsp;&nbsp;&nbsp;&nbsp; orden: {{$etapa->numero_orden_etapa}}<br>
	@endforeach



	<form action="/grupo_etapas/{{$grupo_etapas->id_grupo_etapas}}" method="post">
		<input type="hidden" name="_method" value="delete">
		<button type="submit" class="btn btn-success" >Eliminar grupo de etapas</a>
	</form>
</div>
@stop