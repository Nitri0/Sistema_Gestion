@extends('layouts.base')

@section('content')
<div class="container">
	<h2>Dominio</h2><br><br>
	empresa proveedora: {{ $dominio->empresaProveedora()}} <br>
	nombre de dominio: {{ $dominio->nombre_dominio}} <br>
	size used :  {{ $dominio->getSizeUsed()}} <br>
	
</div>
@stop