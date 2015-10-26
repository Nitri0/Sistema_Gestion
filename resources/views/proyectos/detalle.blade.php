@extends('layouts.base')

@section('content')
<div class="container">
	nombre: {{ $proyecto->nombre_proyecto }} <br>
	direccion: {{ $proyecto->direccion_proyecto}} <br>
	email: {{ $proyecto->email_proyecto}} <br>
	telefono: {{ $proyecto->telefono_proyecto}} <br>
	telefono 2: {{ $proyecto->telefono_2_proyecto}} <br>
	rif/ci: {{ $proyecto->ci_rif_proyecto}} <br>
	Persona de contacto: {{ $proyecto->persona_contacto_proyecto}} <br>
	
	
</div>
@stop