@extends('layouts.base')

@section('content')
<div class="container">
	nombre: {{ $empresa->nombre_empresa }} <br>
	direccion: {{ $empresa->direccion_empresa}} <br>
	email: {{ $empresa->email_empresa}} <br>
	telefono: {{ $empresa->telefono_empresa}} <br>
	rif: {{ $empresa->rif_empresa}} <br>
	
</div>
@stop