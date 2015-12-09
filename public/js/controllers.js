// Declare use of strict javascript
'use strict';

coreApp.controller('ClienteController', function ($scope, $log) {
	console.log("cliente");
	$scope.cliente = {};
});

coreApp.controller('DominioController', function ($scope, $log) {
	console.log("dominio");
	$scope.dominio={};

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
	$scope.proveedor={};
});

coreApp.controller('AvanceController', function ($scope, $log) {
	console.log("Avance");
	$scope.avance={};
	$scope.check=0;
});

coreApp.controller('ProyectoController', function ($scope, $log) {
	console.log("Proyecto");

	$scope.personas=[];
	$scope.cantidad=0;
	$scope.proyecto={};

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
		$scope.personas.push(1);
		$scope.cantidad = $scope.personas.length;
	};

	$scope.eliminar_integrantes= function(argument) {
		$scope.personas.pop();
		$scope.cantidad = $scope.personas.length;
	};
});

coreApp.controller('PerfilController', function ($scope, $log) {
	console.log("perfil");
	$scope.perfil={};
});

coreApp.controller('PlantillasController', function ($scope, $log) {
	console.log("plantillas");
	$scope.plantilla={};
});


coreApp.controller('AdminUsuariosController', function ($scope, $log) {
	console.log("AdminUsuariosController");
	$scope.print = function(argument) {
		console.log(argument);
	}
});

coreApp.controller('GrupoEtapasController', function ($scope, $log) {
	console.log("Grupo de etapas");
	$scope.etapas=[];
	$scope.cantidad=0;
	$scope.GrpEtapas={};
	
	$scope.agregar_etapa= function(argument) {
		$scope.etapas.push(1);
		$scope.cantidad = $scope.etapas.length;
	};

	$scope.eliminar_etapa= function(argument) {
		$scope.etapas.pop();
		$scope.cantidad = $scope.etapas.length;
	};
});