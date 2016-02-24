<html>
	<body style="font-family: calibri; font-size: 12px;">
		<p>Bienvenido {{$correo_usuario}} a GestiónList</p>
		<p align="justify">
			Para poder acceder al sistema solo debes ingresar al siguiente enlace: <a href="{{ url('/activacion/'.$codigo_activacion) }}">Enlace de activación</a></b>
			<br>
			Muchas gracias por su valioso tiempo.
		</p>
	</body>		
</html>