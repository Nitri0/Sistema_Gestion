@extends('layouts.base')

@section('content')
<div class="container">
	<h2>empresa proveedora</h2><br><br>
	nombre: {{ $empresa_proveedora->nombres_empresa_proveedora }} <br>
	telefono: {{ $empresa_proveedora->telefono_empresa_proveedora}} <br>
	
</div>
@stop