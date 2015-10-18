@extends('layouts.base')

@section('content')
<div class="container">
	<h2>Dominio</h2><br><br>
	cliente (dueño del dominio): {{ $dominio->nombre_cliente() }} <br>
	empresa proveedora: {{ $dominio->empresa_proveedora()}} <br>
	nombre de dominio: {{ $dominio->nombre_dominio}} <br>
	
</div>
@stop