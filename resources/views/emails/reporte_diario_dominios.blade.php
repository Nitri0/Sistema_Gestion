los dominios que estan a {{$tiempo_vencimiento}} por vencerse son:

@foreach($dominios as $dominio)
	{{$dominio->nombre_dominio}}
@endforeach