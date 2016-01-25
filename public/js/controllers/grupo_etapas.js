coreApp.controller('GrupoEtapasController', function ($scope, $log, $http, $window) {
	console.log("Grupo de etapas");
	$scope.etapas=[];
	$scope.cantidad_etapas=0;
	$scope.GrpEtapas={};
	$scope.submitted = false;
	$scope.enviando=false;
	$scope.snipper  = false;
	$scope.agregar_etapa= function(argument) {
		$scope.etapas.push(1);
		$scope.cantidad_etapas = $scope.etapas.length;
	};

	$scope.eliminar_etapa= function(argument) {
		$scope.etapas.pop();
		$scope.cantidad_etapas = $scope.etapas.length;
	};

	$scope.submit= function(formValid) {
		console.log(formValid);
		$scope.submitted=true;
		$scope.snipper = true;
		
		if (formValid==true &&$scope.enviando == false){
			if ($scope.cantidad_etapas >0){
		        var json = {};
        		angular.element('#formulario').serializeArray().map(function(x){json[x.name] = x.value;});
        		$scope.enviando=false;
				$http({
				    method: 'POST',
				    url: $scope.urlAction,
				    data: json,
				    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
				}).then(function successCallback(response) {
				    $window.location.href = $scope.urlRedirect;
				    $scope.snipper  = false;
				  }, function errorCallback(response) {
				  	$scope.snipper  = false;
				  	//$window.location.href = "/proyectos";
				    // called asynchronously if an error occurs
				    // or server returns response with an error status.
				  });    		
			}
		};
		return false;
	}

	$scope.titulo_ayuda = "Generación de Grupos de Etapas";
	$scope.sub_titulo = "Mediante el formulario podrá definir los distintos grupos de etapas de un Proyecto, permitiendo así clasificar,dividir o marcar un proyecto según el número de pasos, niveles o etapas.";
	$scope.descripcion_ayuda = 	'<strong>Datos de formulario</strong>'+
	'<br><br><strong>Identificador de grupo de etapas</strong>: Nombre del Grupo de Etapa. Deberá introducir el nombre que identificará el grupo.'+
	'<br><br><strong>Descripción del grupo de etapas</strong>: Permite agregar una descripción breve del grupo de etapa a generar.'+
	'<br><br><strong>Botón Agregar Nueva Etapa</strong>: Permite generar etapas en el grupo. Puede utilizar el botón tantas veces como etapas requieras añadir.'+
	'Al hacer clic al botón se desplegará un nuevo formulario con lo siguiente:'+
	'<br><br><strong>Identificar de Etapa</strong>: Indica el número de la etapa. Ejemplo: Etapa 1'+
	'<br><br><strong>Nombre de etapa</strong>: Permite identificar la etapa generada.'+
	'<br><br><strong>Botón Eliminar Última Etapa</strong>: Permite eliminar la última etapa agregada. Puede utilizar el botón tantas veces como etapas requieras eliminar.';
	
});