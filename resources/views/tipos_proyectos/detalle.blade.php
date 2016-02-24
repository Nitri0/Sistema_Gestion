@extends('layouts.base')

@section('content')
<div class="container">
	nombre: {{ $cliente->nombre_cliente }} <br>
	direccion: {{ $cliente->direccion_cliente}} <br>
	email: {{ $cliente->email_cliente}} <br>
	telefono: {{ $cliente->telefono_cliente}} <br>
	telefono 2: {{ $cliente->telefono_2_cliente}} <br>
	rif/ci: {{ $cliente->ci_rif_cliente}} <br>
	Persona de contacto: {{ $cliente->persona_contacto_cliente}} <br>
	
</div>
@stop