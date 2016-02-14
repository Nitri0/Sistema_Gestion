coreApp.controller('ProyectoDetalleController',function($scope, $log, $http, $window) {
	console.log("ProyectoDetalleController");

	$scope.mensaje_emilinar = "¿Esta seguro que desea eliminar este proyecto?, no podrá ser recuperado";

	$scope.eliminar = function(url_eliminar){
		$scope.url_eliminar = url_eliminar;
	};
});