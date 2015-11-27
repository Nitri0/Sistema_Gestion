// Declare use of strict javascript
'use strict';

coreApp.controller('SidebarController', function ($scope, $log) {
	$scope.proyecto = true; 

	$scope.proyecto_active = function() {
        $scope.proyecto = !$scope.proyecto;
        $scope.usuario = !$scope.usuario;
    };

    $scope.usuario = false;

    $scope.usuario_active = function() {
        $scope.usuario = !$scope.usuario;
        $scope.proyecto = !$scope.proyecto;
    };
});