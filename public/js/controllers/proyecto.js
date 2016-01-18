coreApp.controller('ProyectoController',function($scope, $log, $http, $window) {
	console.log("Proyecto");
	$scope.submitted = false;
	$scope.personas=[];
	$scope.cantidad=0;
	$scope.proyecto={};
	$scope.enviando = false;
	$scope.sort = "name";
	$scope.reverse = false;

	$scope.changeSort = function(value){
	    if ($scope.sort == value){
	      $scope.reverse = !$scope.reverse;
	      return;
	    }

	    $scope.sort = value;
	    $scope.reverse = false;
	}
	
	$scope.agregar_integrantes= function(argument) {
		var persona = {
			usuario : "",
			rol : "",
		};
		$scope.personas.push(persona);
		$scope.cantidad = $scope.personas.length;
	};

	$scope.eliminar_integrantes= function(argument) {
		$scope.personas.pop();
		if ($scope.personas.length>0){
			$scope.cantidad = $scope.personas.length;
		}else{
			$scope.cantidad = 0;
		}
	};
	$scope.submit= function(formValid) {
		console.log(formValid);
		$scope.submitted=true;
		
		if (formValid==true && $scope.enviando ==false){
			if ($scope.cantidad >0){
		        var json = {};
        		angular.element('#formulario').serializeArray().map(function(x){json[x.name] = x.value;});
        		$scope.enviando=true;
				$http({
				    method: 'POST',
				    url: $scope.urlAction,
				    data: json,
				    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
				}).then(function successCallback(response) {
				    $window.location.href = "/proyectos";
				  }, function errorCallback(response) {
				  	$window.location.href = "/proyectos";
				    // called asynchronously if an error occurs
				    // or server returns response with an error status.
				  });    		
			}
		};
		return false;
	}
	$scope.titulo_ayuda = "Creación Proyecto";
	$scope.sub_titulo = "Deberá completar los campos para generar un nuevo proyecto en el sistema.";
	$scope.descripcion_ayuda = 	'<strong>Formulario</strong>'+
	'<br><br><strong>Tipo de Proyecto</strong>:  Se refiere al tipo de proyecto. Seleccione algun tipo de proyecto registrado en el sistema según sea el caso. '+
	'Haga <a href="http://test-proyecto3.com.ve/proyectos/create" target="blank">click aquí</a> o presione el ícono a la derecha de campo para generar un nuevo tipo.'+
	'Cliente: Se refiere a la persona o empresa que adquiere el servicio web. Hacer clic en el botón de la derecha del campo para agregar uno nuevo.'+
	'<br><br><strong>Grupo de Trabajo</strong>'+
	'<br><br><strong>Agregar Integrante</strong>: Permite agregar un Integrante al Proyecto. Al hacer clic en el botón se desplegará el siguiente formulario:'+
	'<br><br><strong>Integrante #</strong>: Lista de integrantes o participantes generados en el sistema. Seleccione el integrante a agregar al proyecto. '+
	'<br><br><strong>Rol</strong>: Indica el tipo de participación o la función que cumplirá el integrante. Seleccione el tipo de Rol. '+
	'Haga clic en el siguiente <a href="http://test-proyecto3.com.ve/roles/create" target="blank">enlace</a> para generar uno nuevo.'+
	'<br><br><strong>Eliminar Integrante</strong>: Permite eliminar o retirar integrantes del proyecto. Hacer clic en el botón para eliminar.'+
	'<br><br><strong>Registrar</strong>: Al hacer clic se efectuará el registro del proyecto, en caso de que los campos estén correctamente llenados.';
});