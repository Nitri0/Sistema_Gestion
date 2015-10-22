// Declare use of strict javascript
'use strict';

coreApp.controller('ClienteController', function ($scope, $log) {
	console.log("cliente");
	$scope.cliente = {};
});

coreApp.controller('DominioController', function ($scope, $log) {
	console.log("dominio");
	$scope.dominio={};
});

coreApp.controller('ProveedorController', function ($scope, $log) {
	console.log("proveedor");
	$scope.proveedor={};
});

coreApp.controller('AvanceController', function ($scope, $log) {
	console.log("Avance");
	$scope.avance={};
});

coreApp.controller('ProyectoController', function ($scope, $log) {
	console.log("Proyecto");
	$scope.proyecto={};
});

coreApp.controller('PerfilController', function ($scope, $log) {
	console.log("perfil");
	$scope.perfil={};
});