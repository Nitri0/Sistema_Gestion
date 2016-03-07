<html>
	<body style="font-family: calibri; font-size: 14px;">
		<p>Bienvenido {{$correo_usuario}} a GestiónList</p>
		<p align="justify">
			A continuación deberá activar su cuenta ingresando a través del siguiente enlace: <a href="{{ url('/activacion/'.$codigo_activacion) }}">Activar Mi Cuenta</a></b>
			<br>
			Muchas gracias por su valioso tiempo.
		</p>
	</body>		
</html>