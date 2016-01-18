// Declare use of strict javascript
'use strict';

coreApp.controller('ClienteController', function ($scope, $log) {
	console.log("cliente");
	$scope.submitted = false;
	$scope.cliente = {};
});

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

});

coreApp.controller('ProveedorController', function ($scope, $log) {
	console.log("proveedor");
	$scope.submitted = false;
	$scope.proveedor={};
});

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

coreApp.controller('GrupoEtapasController', function ($scope, $log, $http, $window) {
	console.log("Grupo de etapas");
	$scope.etapas=[];
	$scope.cantidad_etapas=0;
	$scope.GrpEtapas={};
	$scope.submitted = false;
	$scope.enviando=false;
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
				  }, function errorCallback(response) {
				  	//$window.location.href = "/proyectos";
				    // called asynchronously if an error occurs
				    // or server returns response with an error status.
				  });    		
			}
		};
		return false;
	}
	
});

coreApp.controller('EmpresaController', function ($scope, $log) {
	console.log("EmpresaController");

	
});

