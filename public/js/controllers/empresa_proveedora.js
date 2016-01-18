coreApp.controller('ProveedorController', function ($scope, $log) {
	console.log("proveedor");
	$scope.submitted = false;
	$scope.proveedor={};

	$scope.titulo_ayuda = "Creación de Empresa Proveedora";
	$scope.sub_titulo = "El formulario permite agregar una nueva empresa proveedora de servicio de hosting o alojamiento web.";
	$scope.descripcion_ayuda = 	'<strong>Formulario</strong>'+
	'<br><br><strong>Nombres de empresa proveedora</strong>: Identica la Empresa Proveedora. Deberá ingresar el nombre de la misma.'+
	'<br><br><strong>Teléfono de empresa proveedora</strong>: Información de Contacto. Rellenar campo con el número de contacto de la empresa proveedora a agregar dentro del sistema.';
});