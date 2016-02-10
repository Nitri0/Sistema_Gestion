// Declare use of strict javascript
'use strict';

coreApp.controller('AvanceController', function ($scope, $log, $http, $window) {
	console.log("Avance");
	$scope.submitted = false;
	$scope.avance={};
	$scope.check=0;
	$scope.enviando = false;
	$scope.snipper  = false;
	$scope.submit= function(formValid) {
		console.log('PRUEBA');
		$scope.submitted=true;
		$scope.snipper = true;
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
			    $scope.snipper  = false;
			  }, function errorCallback(response) {
			  	console.log("error");
			  	$scope.snipper  = false;
			  });    		
		}
		else{
			$scope.snipper  = false;
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


coreApp.controller('AdminUsuariosController', function ($scope, $log) {
	console.log("AdminUsuariosController");
	$scope.submitted = false;
	$scope.setSelectAll = function(argument) {
		// body...
	};
	$scope.selectAll = function(value, modulo) {
		
		// if (value){
		// 	$scope[modulo+]
		// }else{

		// }
		// console.log("probando ", modulo,value);
	}
});

coreApp.controller('EmpresaController', function ($scope, $log) {
	console.log("EmpresaController");

	
});

