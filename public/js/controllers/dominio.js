coreApp.controller('DominioController', function ($scope, $log) {
	console.log("dominio");
	$scope.dominio={};
	$scope.submitted = false;
	$scope.sort = "name";
	$scope.reverse = false;

	$scope.compare = function(asignado,usado) {
		if (usado > asignado){
			return true;
		}
		return false;
	}
	$scope.changeSort = function(value){
	    if ($scope.sort == value){
	      $scope.reverse = !$scope.reverse;
	      return;
	    }

	    $scope.sort = value;
	    $scope.reverse = false;
	}

	$scope.titulo_ayuda = "Creación de Dominio";
	$scope.sub_titulo = "Deberá rellenar los campos indicados en el formulario para la creación del dominio.";
	$scope.descripcion_ayuda = 	'<strong>Proyecto</strong>: Se refiere al nombre del proyecto. Seleccione un proyecto registrado en el sistema.' +
								'<a href="http://keygestion.com.ve/proyectos/create" target="blank">Click aquí</a> para '+
								'generar uno nuevo.<br><br><strong>Empresa Proveedora</strong>: Se trata de la Empresa Provedora de Hosting o Alojamiento.'+
								'Seleccione una de las Empresas Proveedoras registradas en el sistema. Puede generar una nueva' +
								'mediante el siguiente  <a href="http://keygestion.com.ve/dominios/create" target="blank">Enlace.</a>'+
								'<br><br><strong>Nombre Dominio</strong>: Se refiere a la identificación o dirección del sitio web. Ejemplo: '+
								'<a href=http://keysystems.com/"">keysystems.com</a>. <br><br><strong>Espacio de disco asignado</strong>:' +
								'Seleccione el tamaño o espacio de memoria máximo disponible para el proyecto dentro'+ 
								'del hosting o servidor. <br><br><strong>Fecha de creacion de dominio</strong>: Se refiere a la fecha en la' +
								'cual fue activado el dominio en la web. ';

});