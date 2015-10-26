@extends('layouts.base')

@section('content')
<div class="container">
	<h2>Dominio</h2><br><br>
	cliente (dueño del dominio): {{ $dominio->nombreCliente() }} <br>
	empresa proveedora: {{ $dominio->empresaProveedora()}} <br>
	nombre de dominio: {{ $dominio->nombre_dominio}} <br>
	
</div>
@stop