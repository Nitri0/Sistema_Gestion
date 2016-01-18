coreApp.controller('ClienteController', function ($scope, $log) {
	console.log("cliente");
	$scope.submitted = false;
	$scope.cliente = {};

	$scope.titulo_ayuda = "Creación de Cliente";
	$scope.sub_titulo = "Deberá completar los campos para generar un nuevo cliente en el sistema.";
	$scope.descripcion_ayuda = 	'<strong>Formulario</strong>'+
	'<br><br><strong>Nombre de cliente</strong>: Identificador del cliente. Indicar Nombre y Apellido'+
	'<br><br><strong>Persona de contacto</strong>: Indica la persona quien responde por los requerimientos del proyecto.'+
	'Identificador de cliente (rif, cedula, etc): Información de identificación del cliente.'+
	'<br><br><strong>Correo</strong>: Dirección Electrónica del Usuario'+
	'<br><br><strong>Telefono 1</strong>: Número de contacto 1'+
	'<br><br><strong>Telefono 2</strong>: Número de contacto 2'+
	'<br><br><strong>Dirección</strong>: Ubicación del cliente o empresa.'+
	'Presiona <strong>Registrar</strong> para generar el nuevo cliente en el sistema.';


});