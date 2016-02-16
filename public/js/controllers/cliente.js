coreApp.controller('ClienteController', function ($scope, $log) {
	console.log("cliente");
	$scope.submitted = false;
	$scope.cliente = {};

	$scope.mensaje_emilinar = "¿Esta seguro que desea eliminar este cliente?,  todos los proyectos a los que esté asociado también serán eliminados.";

	$scope.eliminar = function(url_eliminar){
		console.log(url_eliminar);
		$scope.eliminar_url = url_eliminar;
	};
	
});