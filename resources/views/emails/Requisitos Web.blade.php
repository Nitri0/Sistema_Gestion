<body style="font-family: verdana; font-size: 12px;">
<p style="text-align: center;">
<a href="http://keysystemsca.com.ve" ><img src="http://keysystemsca.com/wp-content/uploads/2015/04/logo.png" width=" 150px"/></a>
</p>
Buen día Sr(a) <b> {{$cliente->nombre_cliente}}</b> espero este muy bien.
<p style="text-align: justify;">
Ahora necesitamos que rellene el siguiente <a href="http://keysystemsca.com.ve/requisitos-web/" target="_blank"><b>formulario</b></a>, donde solicitaremos los datos de su empresa ó proyecto para conocer un poco los intereses que desea ofrecer al mercado.
<br><br>
**********
<br>
{!! $data !!}.
</p>
<?php if(isset($token)):?>
	<p>para responder este mensaje por favor haga click <a href="{{ route('avances.avance.comentario',$token) }}">aqui</a></p>
<?php endif; ?>
<br>
Recuerde que nos estaremos comunicando con usted en los próximos 4 días hábiles, de no ser así, favor comunicarse al siguiente número de soporte: <b>+58 (412)-205-6913</b> ó bien enviándonos un correo electrónico a la siguiente dirección: <b>reclamos@keysystems.com.ve</b>.<br><br>
Saludos
<br><br>
<footer style="text-align: center;"> 
    <a href="https://www.facebook.com/keysystemsca/" target="_blank"><img width="35px" src="http://keypanelservices.com/Manuel/facebook.png"></a>
    <a href="https://twitter.com/keysystemsca" target="_blank"><img width="35px" src="http://keypanelservices.com/Manuel/twitter.png"></a>
    <a href="https://instagram.com/keysystemsca/" target="_blank"><img width="35px" src="http://keypanelservices.com/Manuel/instagram.png"></a>
</footer>
</body><br><br><p align='center'>Mensaje enviado a través de la plataforma de gestión de proyectos <a href={{url()}}>GestiónList</a>. Todos los derechos reservados 2016<p>