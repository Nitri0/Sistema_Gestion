// Declare use of strict javascript
'use strict';

coreApp.controller('AvanceController', function ($scope, $log, $http, $window) {
	console.log("Avance");
	$scope.submitted = false;
	$scope.avance={};
	$scope.check=0;
	$scope.enviando = false;
	$scope.submit= function(formValid) {
		console.log('PRUEBA');
		$scope.submitted=true;
		if (formValid==true && $scope.enviando==false){
	        var json = {};
    		angular.element('#formulario').serializeArray().map(function(x){json[x.name] = x.value;});
    		json['descripcion_avance'] = $scope.avance.descripcion_avance.replace('&gt;','>');
    		$scope.enviando = true;
			$http({
			    method: 'POST',
			    url: $scope.urlAction,
			    data: json,
			    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).then(function successCallback(response) {
				console.log(response);
			    $window.location.href = $scope.urlRedirect;
			  }, function errorCallback(response) {
			  	console.log("error");
			  });    		
		};
		return false;
	}

	$scope.pantilla = function(check) {
    	console.log(check);
    	$(".js-example-data-array").select2();
	}

});

coreApp.controller('PerfilController', function ($scope, $log) {
	console.log("perfil");
	$scope.submitted = false;
	$scope.perfil={};
});

coreApp.controller('PlantillasController', function ($scope, $log, $http, $window) {
	console.log("plantillas");
	$scope.submitted = false;
	$scope.plantilla={};
	$scope.enviando = false;
	$scope.submit= function(formValid) {
		console.log('PRUEBA');
		$scope.submitted=true;
		if (formValid==true && $scope.enviando==false){
	        var json = {};
    		angular.element('#formulario').serializeArray().map(function(x){json[x.name] = x.value;});
    		json['raw_data_plantilla'] = $scope.plantilla.raw_data_plantilla.replace('&gt;','>');
    		$scope.enviando = true;
			$http({
			    method: 'POST',
			    url: $scope.urlAction,
			    data: json,
			    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
			}).then(function successCallback(response) {
				console.log(response);
			    $window.location.href = $scope.urlRedirect;
			  }, function errorCallback(response) {
			  	console.log("error");
			  });    		
		};
		return false;
	}
});


coreApp.controller('AdminUsuariosController', function ($scope, $log) {
	console.log("AdminUsuariosController");
	$scope.submitted = false;
	$scope.print = function(argument) {
		console.log(argument);
	}
});

coreApp.controller('EmpresaController', function ($scope, $log) {
	console.log("EmpresaController");

	
});

