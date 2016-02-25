coreApp.controller('GrupoEtapasController', function ($scope, $log, $http, $window) {
	console.log("Grupo de etapas");
	$scope.etapas=[0,];
	$scope.cantidad_etapas=0;
	$scope.GrpEtapas={};
	$scope.submitted = false;
	$scope.enviando=false;
	$scope.snipper  = false;


	$scope.agregar_etapa= function(argument) {
		$scope.etapas.push(1);
		$scope.cantidad_etapas = $scope.etapas.length;
	};

	$scope.mostrar_modal= function(formValid) {
		$scope.submitted=true;
		if (formValid==true){
			if ($scope.cantidad_etapas >0){
				angular.element('#confirmar_registrar').modal('show');
			}
		}
	};

	$scope.eliminar_etapa= function(argument) {
		$scope.etapas.pop();
		$scope.cantidad_etapas = $scope.etapas.length;
	};

	$scope.submit= function(formValid) {
		console.log(formValid);
		$scope.snipper = true;
		$scope.submitted=true;
		angular.element('#confirmar_registrar').modal('hide');
		if (formValid==true && $scope.enviando == false){
			if ($scope.cantidad_etapas >0){
		        var json = {};
        		angular.element('#formulario').serializeArray().map(function(x){json[x.name] = x.value;});
        		$scope.enviando=true;
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
		}
		else{
			$scope.snipper  = false;
		};
		return false;
	}

	$scope.mensaje_emilinar = "¿Esta seguro que desea eliminar este Tipo de proyecto?, no podrá ser recuperado";

	$scope.eliminar = function(url_eliminar){
		console.log(url_eliminar);
		$scope.eliminar_url = url_eliminar;
	};	
});